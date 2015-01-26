<?php
namespace Migrations;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Migrations\Controller\Index' => 'Migrations\Controller\IndexController'
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'up migration' => array(
                    'options' => array(
                        'route' => 'migrations up --version <VERSION>',
                        'defaults' => array(
                            'controller' => 'Migrations\Controller\Index',
                            'action' => 'up'
                        )
                    )
                ),
                'generate migration' => array(
                    'options' => array(
                        'route' => 'migrations generate',
                        'defaults' => array(
                            'controller' => 'Migrations\Controller\Index',
                            'action' => 'index'
                        )
                    )
                ),
            )
        )
    ),
    'router' => array(       
        'routes' => array(
            'migrations' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/migrations',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Migrations\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array()
                        )
                    )
                )
            )
        )
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'Migrations' => __DIR__ . '/../view'
        )
    )
);
