<?php

use System\Route\Route;

/*
$appRoutes = [
    '/' => 'Controller/DefaultController@indexAction',
    '/@d' => 'Controller/DefaultController@paramAction',
    '/firstUrlSegmentParam/secondUrlSegmentParam' => 'Controller/DefaultController@testAction'
];
*/
Route::get('/', 'Controller/DefaultController@indexAction');
Route::get('/@d', 'Controller/DefaultController@paramAction');
Route::get('/firstUrlSegmentParam/secondUrlSegmentParam', 'Controller/DefaultController@testAction');

//return $appRoutes;