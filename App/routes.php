<?php

use System\Route\Route;

Route::get('/', 'Controller/DefaultController@indexAction');
Route::get('/@d', 'Controller/DefaultController@paramAction');
Route::get('/firstUrlSegmentParam/secondUrlSegmentParam', 'Controller/DefaultController@testAction');

