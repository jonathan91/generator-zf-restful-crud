<?php
namespace <%= packageName %>;

use <%= packageName %>\Service\<%= className %>Service;

return [
    'factories' => [
        '<%= packageName %>\<%= className %>Service' => function ($sm) {
            return new <%= className %>Service($sm);
        },
    ]
];