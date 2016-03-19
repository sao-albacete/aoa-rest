<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 14/03/16
 * Time: 0:22
 */
namespace Aoa\Core\Logger\Factory;
use Aoa\Core\Logger\Logger;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class LoggerFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class LoggerFactory implements FactoryInterface
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
        $config = $container->get('settings')['logger'];
        return new Logger($config);
    }
}
