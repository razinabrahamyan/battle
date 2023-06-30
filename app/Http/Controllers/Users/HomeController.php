<?php

namespace App\Http\Controllers\Users;

use App\Battle;
use App\Category;
use App\Chat;
use App\Events\PlayerConfiguration;
use App\Http\Controllers\Controller;
use App\Mail\BattleAlarm;
use App\Message;
use App\ServerNote;
use App\Slider;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {

    }
    private function slider(){
        $admin_added = Slider::where('country_id',11)->get();
        $admin_added = $this->toArray($admin_added,'slide');

        $featured_battles = \App\Request::featured();
        $featured_battles->splice(2);
        $featured_battles = $this->toArray($featured_battles,'battle');

        $latest_battle =  Battle::latest()->first();
        $latest_battle = $this->toArray($latest_battle,'battle',true);

        $upcoming_battles = Battle::upcoming()->limit(2)->get();
        $upcoming_battles = $this->toArray($upcoming_battles,'battle');

        $merged = array_merge($featured_battles,$upcoming_battles,$latest_battle,$admin_added);
        shuffle($merged);

        return $merged;
    }

    public function toArray($obj,$type,$latest = false){
        if ($latest){
            $obj = [$obj];
        }
        $array = [];
        if($obj){
            for($i = 0; $i<count($obj);$i++){
                if($obj[$i]){
                    $array[] = (object)(['slide' => $obj[$i], 'type' => $type]);
                }
            }
        }

        return $array;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guestIndex()
    {
        $slider = $this->slider();
        $categories = Category::get();
        $trending_battles = Battle::where('verified','1')->with('category')->get()
            ->groupBy('category_id')
            ->map(function($battles, $id) {
                return [
                    'id'    => $id,
                    'count' => $battles->count(),
                    'name' => $battles->first()->category->title['en'],
                ];
            })
            ->sortBy('count',-1)
            ->values()->toArray();
        $trending_battles = array_reverse($trending_battles);
        $trending_battles = array_slice($trending_battles,0,3);
        return view('user_dashboard.home', ['categories' => $categories,'slider' => $slider,'trending_categories' => $trending_battles]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $slider = $this->slider();
        $categories = Category::get();
        $trending_battles = Battle::where('verified','1')->with('category')->get()
            ->groupBy('category_id')
            ->map(function($battles, $id) {
                return [
                    'id'    => $id,
                    'count' => $battles->count(),
                    'name' => $battles->first()->category->title['en'],
                ];
            })
            ->sortBy('count',-1)
            ->values()->toArray();
        $trending_battles = array_reverse($trending_battles);
        $trending_battles = array_slice($trending_battles,0,3);

        return view('user_dashboard.home', ['categories' => $categories,'slider' => $slider ,'trending_categories' => $trending_battles]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {

        $categories = Category::get();
        return view('user_dashboard.categories', ['categories' => $categories]);
    }


    public function battle($battle_id)
    {

    }

    public function chat($user)
    {
        $user = User::where('nickname',$user)->where('id','!=',auth()->id())->first();
        if($user){
            $current_chat = Chat::where('from',auth()->id())->where('to',$user->id)->orWhere('to',auth()->id())->where('from',$user->id)->first();
            Message::where('to',auth()->id())->where('from',$user->id)->where('read_at',null)->update([
                'read_at' => Date::now()
            ]);
            $messages = Message::where('from',auth()->id())->where('to',$user->id)->orWhere('to',auth()->id())->where('from',$user->id)->with('sender')->orderBy('created_at','desc')->limit(20)->get();
            $messages = $messages->reverse();
            $chats = Chat::where('from',auth()->id())->orWhere('to',auth()->id())->with(['fromUser','toUser','lastMessage' => function($query){
                $query->with('sender');
            }])->get()->sortBy(function($message){
                return $message->lastMessage ? $message->lastMessage->created_at : '';
            },0,'desc');
            if($current_chat){
                $current_chat = $current_chat->id;
            }
            return view('user_dashboard.chat',['opponent' => $user,'messages' => $messages,'chats' => $chats,'current_chat' => $current_chat]);
        }else{
            return redirect()->route('guest.home');
        }

    }


    public function security(){
        return view('user_dashboard.account_security',['page'=>'security']);
    }


    public function battlePage(){

        $categories = Category::all();
        return view('user_dashboard.create_battle',['page'=>'battle','categories'=>$categories])->with('success','akjshdkjsahd');
    }
    public function publicProfile(){
        $user = Auth::user();
        return view('user_dashboard.profile',['page'=>'public_profile', 'user' => $user]);
    }

    public function profile($nickname){
        $user = User::where('nickname',$nickname)->first();
        if($user ){
            if($user->id === auth()->id()){
                return redirect()->route('front.public.profile');
            }
            $followed = auth()->check()?auth()->user()->followings->contains($user) : null;
            $followers = $user->followers->count();
            $followings = $user->followings->count();
            return view('user_dashboard.public_profile',[ 'user' => $user, 'followed' => $followed ,'followers' => $followers, 'followings' => $followings]);
        }
        return back();

    }

    public function mainSearch(Request $request){
        $battles = Battle::where('title', 'like', '%'.$request->text.'%')->with(['creator','joiner'])->limit(10)->get();
        $players = User::where('nickname', 'like', '%'.$request->text.'%')->where('id','!=',auth()->id())->limit(10)->get();
        return response()->json([
            'success'=>'success',
            'battles'=>$battles,
            'users'=>$players
        ]);
    }

    public function test(){

       dd(123);
    }
    public function testPost(Request $request){
        ServerNote::create([
            'data' => $request->all()
        ]);
       return $request->all();
    }

    public function battles(Request $request,$category = null)
    {
        $filter = $request->filter;
        $current_category = null;
        $battles = null;
        if($category){
            $current_category = Category::where('title->en',ucwords($category))->first();
            if ($current_category){
                $current_category = $current_category->id;
            }
        }
        $battles = Battle::with('category')->with(['request'=>function($query){
            $query->with('creator', 'joiner');
        }]);
        if ($current_category){
            $battles = $battles->where('category_id',$current_category);
        }
        if (!$filter){
            $data =  Battle::with('category')->with(['request'=>function($query){
                $query->with('creator', 'joiner');
            }]);
        }elseif ($filter == 'latest'){
            $data = Battle::with('category')->with(['request'=>function($query){
                $query->with('creator', 'joiner');
            }])->orderBy('created_at', 'desc');
        }elseif ($filter = 'upcoming'){
            $data = Battle::where('start_date', '<=', Carbon::now())->with('category')->with(['request'=>function($query){
                $query->with('creator', 'joiner');
            }])->orderBy('start_date', 'desc');
        }else{
            abort(404);
        }
        $categories = Category::all();
        Session::put(['filter' => $filter]);
        return view('user_dashboard.battles', ['battles' => $battles->paginate(16),'categories' => $categories,'current_category' => $current_category]);
    }
    public function players(){
        $categories = Category::all();
        $players = User::has('player')->with(['createdEndedBattles','joinedEndedBattles','wins'])->paginate(15);
        $players->map(function ($player){
            $player->allBattlesCount = $player->createdEndedBattles->count() + $player->joinedEndedBattles->count();
            $player->wonBattlesCount = $player->wins->count();
            $player->lostBattlesCount = $player->allBattlesCount - $player->wonBattlesCount;

        });
        return view('user_dashboard.players',['page' => 'sdfdsf','players' => $players,'categories' => $categories]);
    }

    public function whoWon(){
        $battles = Battle::where('current_status','ended')->get();
        $wins = [];
        foreach ($battles as $battle){
            $creatorWins = $battle->votes($battle->request->creator->id)->get()->count();
            $joinerWins = $battle->votes($battle->request->joiner->id)->get()->count();
            if($creatorWins>$joinerWins){
                array_push($wins,['battle_id' => $battle->id,'user_id' => $battle->request->creator->id]);
            }else{
                array_push($wins,['battle_id' => $battle->id,'user_id' => $battle->request->joiner->id]);
            }
        }

        DB::table('results')->insert($wins);
        return view('mail.battle_alert',['data' => ['title' => 'Battle Title', 'id' => 5]]);
    }

}
