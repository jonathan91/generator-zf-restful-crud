<?php
namespace <%= packageName %>;

use <%= packageName %>\Controller\Factory\<%= className %>ControllerFactory;
use <%= packageName %>\Service\Factory\<%= className %>ServiceFactory;
use <%= packageName %>\Controller\<%= className %>Controller;
use <%= packageName %>\Service\<%= className %>Service;

return [
    'service_manager' => [
        'factories' => [
            <%= className %>Service::class => <%= className %>ServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            <%= className %>Controller::class => <%= className %>ControllerFactory::class
        ],
    ],
];