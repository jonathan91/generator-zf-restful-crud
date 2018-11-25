<?php
namespace <%= packageName %>;

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
                        'controller' => '<%= className %>\Controller\<%= className %>',
                    ],
                ],
            ],
            '<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>Index' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/<%=_.replace(_.snakeCase(className),"_","-").toLowerCase()%>',
                    'defaults' => [
                        'controller' => '<%= className %>\Controller\<%= className %>',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'factories' => [
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ],
    ],
    'controllers' => [
        'invokables' => [
            '<%= className %>\Controller\<%= className %>' => Controller\<%= className %>Controller::class
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
