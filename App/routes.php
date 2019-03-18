<?php

$appRoutes = [
    '/' => 'Controller/DefaultController@indexAction',
    '/@d' => 'Controller/DefaultController@paramAction',
    '/firstUrlSegmentParam/secondUrlSegmentParam' => 'Controller/DefaultController@testAction'
];

return $appRoutes;