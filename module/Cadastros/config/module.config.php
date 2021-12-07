<?php

declare(strict_types=1);

namespace Cadastros;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Cadastros\Controller\CorretorControllerFactory;
use Cadastros\Controller\ImoveisControllerFactory;

return [
    'router' => [
        'routes' => [
            'cadastros' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cadastro[/:controller[/:action[/:matricula]]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cadastrosImoveis' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cadastros[/:controller[/:action[/:registro]]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'aliases' => [
            'corretor' => Controller\CorretorController::class,
            'imoveis' => Controller\ImoveisController::class
        ],
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\CorretorController::class => CorretorControllerFactory::class,
            Controller\ImoveisController::class => ImoveisControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'cadastros/corretor/index'      => __DIR__ . '/../view/cadastros/corretor/index.phtml',
            'cadastros/imoveis/index'      => __DIR__ . '/../view/cadastros/imoveis/index.phtml',
            'error/404'                     => __DIR__ . '/../view/error/404.phtml',
            'error/index'                   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'CorretorTable' => Model\CorretorTableFactory::class,
            'ImoveisTable' => Model\ImoveisTableFactory::class
            

        ]
    ]
];
