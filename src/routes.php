<?php

/**
 * Package routing file specifies all of this package routes.
 */

use Illuminate\Support\Facades\View;
use Jojoramadhan\Skalamusic\Models\Menu;

if (Schema::hasTable('menus')) {
    $menus = Menu::with('children')->where('menu_type', '!=', 0)->orderBy('position')->get();
    View::share('menus', $menus);
    if (! empty($menus)) {
        Route::group([
            'middleware' => ['web', 'auth', 'role'],
            'prefix'     => config('skalamusic.route'),
            'as'         => config('skalamusic.route') . '.',
            'namespace'  => 'App\Http\Controllers',
        ], function () use ($menus) {
            foreach ($menus as $menu) {
                switch ($menu->menu_type) {
                    case 1:
                        Route::post(strtolower($menu->name) . '/massDelete', [
                            'as'   => strtolower($menu->name) . '.massDelete',
                            'uses' => 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@massDelete'
                        ]);
                        Route::resource(strtolower($menu->name),
                            'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller', ['except' => 'show']);
                        break;
                    case 3:
                        Route::get(strtolower($menu->name), [
                            'as'   => strtolower($menu->name) . '.index',
                            'uses' => 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@index',
                        ]);
                        break;
                }
            }
        });
    }
}

Route::group([
    'namespace'  => 'Jojoramadhan\Skalamusic\Controllers',
    'middleware' => ['web', 'auth']
], function () {
    // Dashboard home page route
    Route::get(config('skalamusic.homeRoute'), 'SkalamusicController@index');
    Route::group([
        'middleware' => 'role'
    ], function () {
        // Menu routing
        Route::get(config('skalamusic.route') . '/menu', [
            'as'   => 'menu',
            'uses' => 'SkalamusicMenuController@index'
        ]);
        Route::post(config('skalamusic.route') . '/menu', [
            'as'   => 'menu',
            'uses' => 'SkalamusicMenuController@rearrange'
        ]);

        Route::get(config('skalamusic.route') . '/menu/edit/{id}', [
            'as'   => 'menu.edit',
            'uses' => 'SkalamusicMenuController@edit'
        ]);
        Route::post(config('skalamusic.route') . '/menu/edit/{id}', [
            'as'   => 'menu.edit',
            'uses' => 'SkalamusicMenuController@update'
        ]);

        Route::get(config('skalamusic.route') . '/menu/crud', [
            'as'   => 'menu.crud',
            'uses' => 'SkalamusicMenuController@createCrud'
        ]);
        Route::post(config('skalamusic.route') . '/menu/crud', [
            'as'   => 'menu.crud.insert',
            'uses' => 'SkalamusicMenuController@insertCrud'
        ]);

        Route::get(config('skalamusic.route') . '/menu/parent', [
            'as'   => 'menu.parent',
            'uses' => 'SkalamusicMenuController@createParent'
        ]);
        Route::post(config('skalamusic.route') . '/menu/parent', [
            'as'   => 'menu.parent.insert',
            'uses' => 'SkalamusicMenuController@insertParent'
        ]);

        Route::get(config('skalamusic.route') . '/menu/custom', [
            'as'   => 'menu.custom',
            'uses' => 'SkalamusicMenuController@createCustom'
        ]);
        Route::post(config('skalamusic.route') . '/menu/custom', [
            'as'   => 'menu.custom.insert',
            'uses' => 'SkalamusicMenuController@insertCustom'
        ]);

        Route::get(config('skalamusic.route') . '/actions', [
            'as'   => 'actions',
            'uses' => 'UserActionsController@index'
        ]);
        Route::get(config('skalamusic.route') . '/actions/ajax', [
            'as'   => 'actions.ajax',
            'uses' => 'UserActionsController@table'
        ]);
    });
});

// @todo move to default routes.php
Route::group([
    'namespace'  => 'App\Http\Controllers',
    'middleware' => ['web']
], function () {
    // Point to App\Http\Controllers\UsersController as a resource
    Route::group([
        'middleware' => 'role'
    ], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
    });
    Route::auth();
});
