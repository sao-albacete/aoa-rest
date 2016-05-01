<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 20:44
 */
namespace Aoa\Core\Doctrine\Factory;

use Aoa\Core\Doctrine\Extension\TablePrefix;
use Aoa\Core\Doctrine\Repository\EntityRepository;
use Aoa\Core\Dotenv\EnvironmentVariables;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class EntityManagerFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class EntityManagerFactory implements FactoryInterface
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
        // database configuration parameters
        $dbParams = $container->get('settings')['database'];

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $entitiesPaths = $dbParams['entitiesPaths'];
        $config = Setup::createAnnotationMetadataConfiguration($entitiesPaths, $isDevMode);
        $config->setDefaultRepositoryClassName(EntityRepository::class);

        // Set events
        $evm = new \Doctrine\Common\EventManager;

        // Table Prefix
        $tablePrefix = new TablePrefix(getenv(EnvironmentVariables::TABLE_PREFIX));
        $evm->addEventListener(\Doctrine\ORM\Events::loadClassMetadata, $tablePrefix);

        // obtaining the entity manager
        return EntityManager::create($dbParams, $config, $evm);
    }
}
