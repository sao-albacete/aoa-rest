<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 20:40
 */
namespace Aoa\Service\Factory;
use Aoa\Service\FamiliaService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class FamiliaServiceFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class FamiliaServiceFactory implements FactoryInterface
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
        return new FamiliaService($container->get(EntityManager::class));
    }
}
