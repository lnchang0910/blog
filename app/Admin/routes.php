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
    $router->resource('news', NewsController::class);
    $router->resource('sceneries', SceneryController::class);
    $router->resource('scene-images', SceneImageController::class);
    $router->resource('beacons', BeaconController::class);
    $router->resource('roundviews', RoundviewController::class);
    $router->resource('floors', FloorController::class);
    $router->resource('mainpages', MainpagesController::class);
    $router->resource('spots', SpotController::class);
   //$router->apiResource('post', 'api\QueryModellists');
   //$router->resource('QueryModelLists',  'api\QueryModelLists');
   //$router->apiResource('QueryModelLists', 'api\QueryModelLists');
   $router->apiResource('QueryModelLists', 'api\QueryModelLists');
});

Route::group([
   'prefix'        => config('admin.route.prefix'),
   'namespace'     => config('admin.route.namespace'),
   //'middleware'    => 'auth:api',
], function (Router $router) {
   $router->apiResource('QueryModelLists', 'api\QueryModelLists');
   /*    $router->get('/t', function () {
      return 'ok';
   }); */

});
