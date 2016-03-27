<?php
# ------------------ Route patterns---------------------
Route::pattern('id', '[0-9]+');

# ------------------ Page Route ------------------------
//Route::get('/', 'PageController@home');

Route::get('/', [
    'as' => 'home',
//    'uses' => 'PagesController@home',
    'uses' => 'TopicsController@index',
]);

Route::get('/about', [
    'as' => 'about',
    'uses' => 'PagesController@about',
]);

Route::get('/wiki', [
    'as' => 'wiki',
    'uses' => 'PagesController@wiki',
]);

Route::get('/search', [
    'as' => 'search',
    'uses' => 'PagesController@search',
]);

Route::get('/feed', [
    'as' => 'feed',
    'uses' => 'PagesController@feed',
]);

Route::get('/sitemap', 'PagesController@sitemap');
Route::get('/sitemap.xml', 'PagesController@sitemap');

# ------------------ User stuff ------------------------
#用户回复路由 id为用户id
Route::get('/users/{id}/replies', [
    'as' => 'users.replies',
    'uses' => 'UsersController@replies',
]);
#用户文章
Route::get('/users/{id}/topics', [
    'as' => 'users.topics',
    'uses' => 'UsersController@topics',
]);
#获取用户关注
Route::get('/users/{id}/favorites', [
    'as' => 'users.favorites',
    'uses' => 'UsersController@favorites',
]);
//更新用户与github缓存
Route::get('/users/{id}/refresh_cache', [
    'as' => 'users.refresh_cache',
    'uses' => 'UsersController@refreshCache',
]);

Route::get('/users/{id}/access_tokens', [
    'as' => 'users.access_tokens',
    'uses' => 'UsersController@accessTokens',
]);

Route::get('/access_token/{token}/revoke', [
    'as' => 'users.access_tokens.revoke',
    'uses' => 'UsersController@revokeAccessToken',
]);

Route::get('users/regenerate_login_token', [
    'as' => 'users.regenerate_login_token',
    'uses' => 'UsersController@regenerateLoginToken',
]);


Route::post('/favorites/{id}', [
    'as' => 'favorites.createOrDelete',
    'uses' => 'FavoritesController@createOrDelete',
    'before' => 'auth',
]);

Route::get('/notifications', [
    'as' => 'notifications.index',
    'uses' => 'NotificationsController@index',
    'before' => 'auth',
]);

Route::get('/notifications/count', [
    'as' => 'notifications.count',
    'uses' => 'NotificationsController@count',
    'before' => 'auth',
]);

Route::post('/attentions/{id}', [
    'as' => 'attentions.createOrDelete',
    'uses' => 'AttentionsController@createOrDelete',
    'before' => 'auth',
]);

# ------------------ Authentication ------------------------

Route::get('login', [
    'as' => 'login',
    'uses' => 'AuthController@login',
]);

Route::get('login-required', [
    'as' => 'login-required',
    'uses' => 'AuthController@loginRequired',
]);

Route::get('admin-required', [
    'as' => 'admin-required',
    'uses' => 'AuthController@adminRequired',
]);

Route::get('user-banned', [
    'as' => 'user-banned',
    'uses' => 'AuthController@userBanned',
]);

Route::get('signup', [
    'as' => 'signup',
    'uses' => 'AuthController@create',
]);

Route::post('signup',  [
    'as' => 'signup',
    'uses' => 'AuthController@store',
]);

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'AuthController@logout',
]);

Route::get('oauth', 'AuthController@getOauth');

# ------------------ Resource Route ------------------------

Route::resource('nodes', 'NodesController', ['except' => ['index', 'edit']]);

Route::resource('topics', 'TopicsController');
Route::resource('votes', 'VotesController');
Route::resource('users', 'UsersController');

# ------------------ Replies ------------------------

Route::resource('replies', 'RepliesController', ['only' => ['store']]);
Route::delete('replies/delete/{id}',  [
    'as' => 'replies.destroy',
    'uses' => 'RepliesController@destroy',
    'before' => 'auth',
]);

# ------------------ Votes ------------------------

Route::group(['before' => 'auth'], function () {
    Route::post('/topics/{id}/upvote', [
        'as' => 'topics.upvote',
        'uses' => 'TopicsController@upvote',
    ]);

    Route::post('/topics/{id}/downvote', [
        'as' => 'topics.downvote',
        'uses' => 'TopicsController@downvote',
    ]);

    Route::post('/replies/{id}/vote', [
        'as' => 'replies.vote',
        'uses' => 'RepliesController@vote',
    ]);

    Route::post('/topics/{id}/append', [
        'as' => 'topics.append',
        'uses' => 'TopicsController@append',
    ]);
});

# ------------------ Admin Route ------------------------

Route::group(['before' => 'manage_topics'], function () {
    Route::post('topics/recomend/{id}',  [
        'as' => 'topics.recomend',
        'uses' => 'TopicsController@recomend',
    ]);

    Route::post('topics/wiki/{id}',  [
        'as' => 'topics.wiki',
        'uses' => 'TopicsController@wiki',
    ]);

    Route::post('topics/pin/{id}',  [
        'as' => 'topics.pin',
        'uses' => 'TopicsController@pin',
    ]);

    Route::post('topics/sink/{id}',  [
        'as' => 'topics.sink',
        'uses' => 'TopicsController@sink',
    ]);
});
Route::delete('topics/delete/{id}',  [
    'as' => 'topics.destroy',
    'uses' => 'TopicsController@destroy',
]);
Route::delete('account/topics/delete/{id}',  [
    'as' => 'ac.topics.destroy',
    'uses' => 'TopicsController@destroy',
]);
Route::group(['before' => 'manage_users'], function () {
    Route::post('users/blocking/{id}',  [
        'as' => 'users.blocking',
        'uses' => 'UsersController@blocking',
    ]);
});

Route::post('upload_image', [
    'as' => 'upload_image',
    'uses' => 'TopicsController@uploadImage',
    'before' => 'auth',
]);

// Health Checking
Route::get('heartbeat', function () {
    return Node::first();
});

Route::get('/github-api-proxy/users/{username}', [
    'as' => 'users.github-api-proxy',
    'uses' => 'UsersController@githubApiProxy',
]);

Route::get('/github-card', [
    'as' => 'users.github-card',
    'uses' => 'UsersController@githubCard',
]);
#-------------------register System-------------
Route::get('/ow_login', [
    'as' => 'ow_login',
    'uses' => 'ow_AuthController@show_login',
]);
Route::post('/ow_login', [
    'as' => 'Do_Login',
    'uses' => 'ow_AuthController@Do_Login',
]);
Route::get('/ow_register', [
    'as' => 'ow_register',
    'uses' => 'ow_AuthController@show_register',
]);
Route::post('/ow_register', [
    'as' => 'ow_register',
    'uses' => 'ow_AuthController@ow_Auth_register',
]);
Route::get('/activation', [
    'as' => 'activation',
    'uses' => 'ow_AuthController@activation',
]);
Route::get('/SendActivationEmail',[
'as'=>'SendActivationEmail',
    'uses' => 'ow_AuthController@SendActivationEmail',
]);
Route::get('/ow_registerok', [
    'as' => 'ow_registerok',
    'uses' => 'ow_AuthController@ow_registerok',
]);
Route::get('/ow_register_ziliao', [
    'as' => 'ow_register_ziliao',
    'uses' => 'ow_AuthController@ow_register_ziliao',
]);
Route::get('/EditResume', [
    'as' => 'EditResume',
    'uses' => 'UsersController@EditResume',
]);
Route::post('/EditResume', [
    'as' => 'EditResume',
    'uses' => 'UsersController@p_EditResume',
]);
Route::post('/account/EditResume', [
    'as' => 'ac_EditResume',
    'uses' => 'UsersController@p_EditResume',
]);
Route::post('/EditResume/uploadimg','UsersController@avatarUpload');
Route::post('/account/changeheader','UsersController@changeheader');


Route::get('/vaild_email/{id}', [
    'as' => 'vaild_email',
    'uses' => 'UsersController@vaild_email',
]);

Route::post('/vaild_email/{id}', [
    'as' => 'p_vaild_email',
    'uses' => 'UsersController@p_vaild_email',
]);
Route::controller('/password', 'RemindersController');

Route::get('/activation','ow_AuthController@activation');
//
#--------------------个人中心----------------
Route::get('/account/',[
    'as'=>'account',
    'uses'=>'AccountController@index']);

Route::get('/account/notify/replies','AccountController@replies');
Route::get('/account/notify/sysnotify','AccountController@sysnotify');
Route::get('/account/notify',[
    'as' => 'ac_notify',
    'uses' => 'AccountController@notify',
]);
Route::post('/account/notify/delete/{id}',[
    'as'=> 'notify_delete',
    'uses'=>'AccountController@NotifyDelete'
]);
Route::get('/account/personalsettings',
    [
        'as'=>'ac_setting',
        'uses'=>'AccountController@personalsettings'
    ]);
Route::get('/account/changeheader',[
    'as'=>'changeheader',
    'uses'=>'AccountController@changeheader'
]);
Route::get('/account/ac_if_setting',
    [
        'as'=>'ac_if_setting',
        'uses'=>'AccountController@ac_if_setting'
    ]);


Route::get('/account/editresume',[
    'as' => 'acc_editresume',
    'uses' => 'AccountController@editresume',
]);

Route::get('/account/topics',[
    'as' => 'ac_topices',
    'uses' => 'AccountController@topics',
]);
Route::get('/account/editsetting',[
    'as' => 'editsetting',
    'uses' => 'AccountController@editsetting',
]);

Route::get('/account/changepassword',[
    'as'=>'changepassword',
    'uses'=>'AccountController@changepassword'
]);
Route::post('/account/changepassword',[
    'as'=>'p_changepassword',
    'uses'=>'AccountController@post_changepwd'
]);

#---------------------fans-------------------------
Route::get('/users/{id}/fans',[
'as'=>'fans',
    'uses'=>'UsersController@showfans'
]);
Route::get('/users/{id}/focus',[
    'as'=>'ufocus',
    'uses'=>'UsersController@showfocus'
]);

Route::get('job','JobController@index');


#---------------------ajax---------------------------
Route::post('/users/focus',[
        'as'=>'focus',
        'uses'=>'UsersController@postfocus'
    ]
);
Route::get('NotifyTest','TopicsController@NotifyTest');