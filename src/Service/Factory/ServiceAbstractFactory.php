<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 21:15
 */
namespace Aoa\Service\Factory;

use Aoa\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

/**
 * Class ServiceAbstractFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class ServiceAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Can the factory create an instance for the service?
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (! class_exists($requestedName) || ! is_subclass_of($requestedName, AbstractService::class)) {
            return false;
        }

        // Any service which constructor has only one argument ($entityManager) can be created by this factory
        $reflection = new \ReflectionClass($requestedName);
        $constructor = $reflection->getConstructor();
        return $constructor->getNumberOfParameters() === 1;
    }

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
        /** @var EntityManager $em */
        $em = $container->get(EntityManager::class);
        return new $requestedName($em);
    }
}
