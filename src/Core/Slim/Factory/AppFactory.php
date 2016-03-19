<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 9/03/16
 * Time: 0:27
 */
namespace Aoa\Core\Slim\Factory;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use RKA\ZsmSlimContainer\Container;
use Slim\App;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;


/**
 * Class AppFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class AppFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $settings = require_once __DIR__ . '/../../../../config/settings.php';
        $container = new Container($settings);

        return new App($container);
    }
}
