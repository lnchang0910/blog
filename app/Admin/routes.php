<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
   'prefix'        => config('admin.route.prefix'),
   'namespace'     => config('admin.route.namespace'),
   'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

   $router->get('/', 'HomeController@index')->name('admin.home');
   $router->resource('areas', AreaController::class);
   $router->resource('stations', StationController::class);
   $router->resource('stations_banner_image', StationBannerImageController::class);
   $router->resource('stations_view', StationViewController::class);

});
