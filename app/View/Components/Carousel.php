<?php

namespace App\View\Components;

use App\Battle;
use App\Category;
use App\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class Carousel extends Component
{
    private $category;
    private $user;
    private $type;
    private $trending;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category = null, $user = null,$type = null,$trending = null)
    {
        $this->category = $category;
        $this->user = $user;
        $this->type = $type;
        $this->trending = $trending;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $battles = null;
        if($this->user){
            if($this->type === 'upcoming'){
                $battles = Request::where('creator_id',$this->user)
                    ->orwhere('assignee_id',$this->user)
                    ->with('battle')
                    ->get()->pluck('battle','id')->where('start_date','>',Carbon::now(4));
            }elseif ($this->type === 'previous'){
                $battles = Request::where('creator_id',$this->user)
                    ->orwhere('assignee_id',$this->user)
                    ->with('battle')
                    ->get()->pluck('battle','id')->where('start_date','<',Carbon::now(4));
            }elseif ($this->type === 'subscribed'){
                $battles = auth()->user()->subscriptions;
            }elseif($this->type === 'all'){
                $battles = $battles = Request::where('creator_id',$this->user)
                    ->orwhere('assignee_id',$this->user)
                    ->with('battle')
                    ->orderBy('created_at','desc')
                    ->get()->pluck('battle','id');
            }

        }
        elseif($this->category){
            $category = Category::where('id',$this->category)->with(['acceptedBattles' => function($query){
                $query->with('reminder');
            }])->first();
            $battles = $category->acceptedBattles;
            $this->category = $category;
        }
        elseif($this->trending){
            $followings = auth()->user()->followings
                ->map(function($following, $id) {
                    return $following->id;
                })->values()
                ->toArray();
            $battles = Request::whereIn('assignee_id',$followings)->orWhereIn('creator_id',$followings)->where('answer','accepted')->with('battle')->get()->pluck('battle')->where('verified','1');
        }
        return view('components.carousel',['category'=>$this->category,'carousel_user' => $this->user,'battles'=>$battles, 'type' => $this->type]);
    }
}
