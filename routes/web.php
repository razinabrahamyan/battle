<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Auth::routes();
Broadcast::routes();
//------------Set Locales Route -------------------------------------------------
Route::get('/set-locale/{locale}/{type?}', 'Localization\LanguageController')->name('set.locale');
//-------------------------------------------------------------------------------

//-------------- Users Routes ---------------------------------------------------
Route::group(['middleware' => [ 'local']], function (){
    Route::get('/', 'Users\HomeController@guestIndex')->middleware('auth')->name('guest.home');
    Route::get('/categories', 'Users\HomeController@categories')->name('front.categories');
    Route::get('/profile/{nickname}', 'Users\HomeController@profile')->name('user.profile');
    Route::get('/search', 'Users\HomeController@mainSearch')->name('main.search');
    Route::post('set-view', 'PublisherController@setView')->name('battle.set.view');
    Route::get('/states-by-country', 'Users\ProfileController@getStates')->name('user.get.states');
    Route::get('/cities-by-state', 'Users\ProfileController@getCities')->name('user.get.cities');
    Route::get('/battle/create', 'Users\BattleController@create')->middleware(['auth','status:active'])->name('battle.create');
    Route::resource('battle', 'Users\BattleController',['parameters' => [
        'battle' => 'id',
    ]])->except(['create']);
    Route::get('/battles/{category?}', 'Users\HomeController@battles')->name('battles');
    Route::get('/players', 'Users\HomeController@players')->name('players');



});

//-------------------------------------------------------------------------------
Route::get('/stream/{user}', function (Request $request){
    Log::channel('publish')->info('info',[
        'request' => $request->all()
    ]);
});
Route::post('/post', function (Request $request){
    Log::channel('publish')->info('info',[
        'request' => $request->all()
    ]);
});

//------------Users Authorized Routes Group--------------------------------------
Route::group(['middleware' => ['auth', 'local','status:active']], function (){
    Route::get('/chat/{user}', 'Users\HomeController@chat')->name('chat');
    Route::post('/chat-seen', 'Users\LiveChatController@messageSeen')->name('chat.message.seen');
    Route::get('/home', 'Users\HomeController@index')->name('user.home');
    Route::get('/profile', 'Users\ProfileController@index')->name('front.public.profile');
    Route::get('/basic-info', 'Users\ProfileController@edit')->name('front.basic.info');
    Route::get('/security', 'Users\HomeController@security')->name('front.account.security');
    Route::get('/user-dashboard', 'Users\ProfileController@dashboard')->name('front.dashboard');
    Route::post('/update-profile', 'Users\ProfileController@update')->name('user.profile.update');
    Route::post('/answer-battle-request', 'Users\RequestController@usersAnswer')->name('answer.battle.request');
    Route::get('/nickname-availability', 'Users\ProfileController@checkNickname')->name('user.check.nickname');
    Route::get('/nickname-users', 'Users\ProfileController@getUsersByNickname')->name('get.users.nickname');
    Route::get('/mark-as-read', 'Users\ProfileController@markAsRead')->name('mark.as.read');
    Route::get('/get-notifications', 'Users\ProfileController@getNotifications')->name('user.notifications');
    Route::post('/report-problem', 'Users\ReportController@report')->name('report.battle');
    Route::post('/set-reactions', 'Users\ReactionController@setReaction')->name('set.reaction');
    Route::post('/vote', 'Users\ReactionController@vote')->name('battle.vote');
    Route::post('/subscribe', 'Users\ReactionController@subscribe')->name('battle.subscribe');
    Route::post('/follow', 'Users\ReactionController@follow')->name('battle.follow');
    Route::post('/set-reminder', 'Users\ReminderController@setReminder')->name('set.reminder');
    Route::post('/uninteresting', 'Users\ReactionController@uninteresting')->name('battle.uninteresting');
    Route::post('/invite-to-view', 'Users\RequestController@invite')->name('battle.invite');
    Route::post('/change-status', 'PublisherController@changeStatus')->name('battle.change.status');
    Route::get('/check-status', 'PublisherController@checkStatus')->name('battle.check.status');
    Route::post('/mark_notification', 'PublisherController@markNotification')->name('battle.mark.ready');
    Route::post('/finish-round', 'PublisherController@finishRound')->name('battle.round.finish');
    Route::get('/deactivate-account', 'Users\AccountController@deactivate')->name('user.deactivate');
    Route::get('/delete-account', 'Users\AccountController@delete')->name('user.delete');

});

Route::group(['middleware' => ['auth', 'local']], function (){
    Route::get('/account-info', 'Users\AccountController@account')->name('user.account');
    Route::get('/activate-account', 'Users\AccountController@activate')->name('user.activate');

});
//------------End Users Authorized Routes Group-----------------------------------

//------------Admin Panel Routes Group -------------------------------------------
Route::group(['prefix' => 'dashboard', 'middleware' => ['local', 'auth:admin']], function (){
    Route::get('/','Admin\Dashboard\DashboardController@index')->name('dashboard');
    //-------Admins Routes
    Route::resource('admins', 'Admin\AdminController')->except([
        'index',
        'create'
    ]);
    Route::get('/admin-index/{id}', 'Admin\AdminController@index')->name('admins.view');
    Route::get('/admin-create/{id}', 'Admin\AdminController@create')->name('admins.create');
//    Route::get('/add-slide', 'Admin\Dashboard\DashboardController@sliderPage')->name('slider.add');
//    Route::post('/create-slide', 'Admin\Dashboard\DashboardController@addSlider')->name('slider.store');

    //--------Users Routes
    Route::resource('users', 'Admin\UsersController')->except([
        'index'
    ]);
    Route::get('/user-show/{name}','Admin\UsersController@index')->name('users.index');
    Route::get('/change-status', 'Admin\UsersController@changeStatus')->name('change.user.status');

    //---------Country, State, City Routes
    Route::post('/get-states-by-country', 'Admin\CountriesController@getStates')->name('get.states');
    Route::post('/get-cities-by-states', 'Admin\CountriesController@getCities')->name('get.cities');
    Route::post('/get-state', 'Admin\CountriesController@getState')->name('get.state');
    Route::post('/get-city', 'Admin\CountriesController@getCity')->name('get.city');

    //----------Battle Routes
    Route::resource('battles', 'Admin\BattleController')->except([
        'create',
        'store'
    ]);
    Route::get('/change-battle-verify', 'Admin\BattleController@changeVerify')->name('change.battle.verify');

    Route::post('/filter', 'Admin\BattleController@filter')->name('filter');
    Route::post('/battles-set-entries', 'Admin\Dashboard\SettingsController@setEntries')->name('set.entries');

    //----------Category Routes
    Route::resource('category', 'Admin\CategoryController');

    //test Routes

    Route::get('create-battle', 'TestController@createBattle')->name('create.battle');
    Route::post('store-battle', 'TestController@storeBattle')->name('store.battle');

    Route::get('/permissions', 'Admin\PermissionsController@index')->name('permissions')->middleware('can:permissions.view');
    Route::post('/set-permissions', 'Admin\PermissionsController@setPermissions')->name('set.permissions');
    Route::post('/get-permissions', 'Admin\PermissionsController@getPermissions')->name('get.permissions');

    Route::get('/battle-settings', 'Admin\Dashboard\SettingsController@battleView')->name('battle.settings');
    Route::post('/battle-settings-update', 'Admin\Dashboard\SettingsController@battleUpdate')->name('battle.settings.update');

    //-------------------notifications route
    Route::get('/notifications','Admin\Dashboard\DashboardController@notifications')->name('dashboard.notifications');


    //----------------report routes
    Route::resource('reports', 'Admin\ReportController');

    //----------------slider routes
    Route::resource('slider', 'Admin\SliderController');

});
//------------End Admin Panel Routes Group ---------------------------------------

//--------------Admin Auth Routes-------------------------------------------------
Route::get('/admin', 'Auth\AdminLoginController@showLoginForm')->middleware('local')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.post');
Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
//--------------End Admin Auth Routes --------------------------------------------

//------------Socket Event Routes---------------------------------------

Route::post('/battle/message', 'Users\LiveChatController@sendLiveMessage')->name('battle.send.message');
Route::post('/chat/message', 'Users\LiveChatController@sendMessage')->name('chat.send.message');
Route::post('/chat/typing', 'Users\LiveChatController@typing')->name('chat.typing');
//--------------End Socket Event Routes--------------------------------------------

//----------------------TEST ROUTE ----------------------
Route::get('/test', 'Users\HomeController@test');

