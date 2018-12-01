<?php
namespace <%= packageName %>;


use <%= packageName %>\Controller\<%= className %>Controller;

return [
    'router' => [
        'routes' => [
            //<%=(_.replace(_.snakeCase(className),"_","-")).toLowerCase()%> routers
            '<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>' => [
                'type' => 'Segment',
                'options' => [
                    'route'    => '/<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => <%= className %>::class,
                    ],
                ],
            ],
            '<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>Index' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>',
                    'defaults' => [
                        'controller' => <%= className %>::class,
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
		'strategies' => [
			'ViewJsonStrategy',
		],
	],
    'strategies' => [
        'ViewJsonStrategy',
    ],
];
