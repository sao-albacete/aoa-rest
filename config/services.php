<?php

use Aoa\Controller\CitaController;
use Aoa\Controller\Factory\CitaControllerFactory;
use Aoa\Controller\Factory\ControllerAbstractFactory;
use Aoa\Controller\Factory\FamiliaControllerFactory;
use Aoa\Controller\FamiliaController;
use Aoa\Core\Doctrine\Factory\EntityManagerFactory;
use Aoa\Core\Logger\Factory\LoggerFactory;
use Aoa\Core\Logger\Initializer\LoggerAwareInitializer;
use Aoa\Core\Logger\Logger;
use Aoa\Core\Renderer\Factory\RedererFactory;
use Aoa\Core\Slim\Factory\AppFactory;
use Aoa\Service\Factory\ServiceAbstractFactory;
use Doctrine\ORM\EntityManager;
use League\Fractal\Manager;
use Slim\App;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Created by PhpStorm.
 * User: victor
 * Date: 9/03/16
 * Time: 0:02
 */
return [
    'services'           => [],
    'factories'          => [
        // Common
        App::class => AppFactory::class,
        EntityManager::class => EntityManagerFactory::class,
        'renderer' => RedererFactory::class,
        Logger::class => LoggerFactory::class,
        Manager::class => InvokableFactory::class,
        // Controllers
        FamiliaController::class => FamiliaControllerFactory::class,
        CitaController::class => CitaControllerFactory::class,
    ],
    'abstract_factories' => [
        ServiceAbstractFactory::class,
        ControllerAbstractFactory::class,
    ],
    'delegators'         => [],
    'shared'             => [],
    'shared_by_default'  => true,
    /**
     * The use of initializers are highly discourage, but at this moment I think this is the better option
     *
     * @see http://zendframework.github.io/zend-servicemanager/configuring-the-service-manager/#initializers
     */
    'initializers' => [
        LoggerAwareInitializer::class,
    ],
];
