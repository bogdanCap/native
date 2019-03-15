<?php

namespace System\Request;

interface RequestImplementation {
    
    public function getUrlSegments();
    
    public function getRoutes();
}