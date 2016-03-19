<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 22:29
 */
namespace Aoa\Controller\Factory;

use Aoa\Controller\FamiliaController;
use Aoa\Service\FamiliaService;
use Aoa\Service\FamiliaServiceInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use League\Fractal\Manager as FractalManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class FamiliaControllerFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class FamiliaControllerFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return FamiliaController
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var FamiliaServiceInterface $familiaService */
        $familiaService = $container->get(FamiliaService::class);
        /** @var FractalManager $fractalManager */
        $fractalManager = $container->get(FractalManager::class);

        return new FamiliaController($familiaService, $fractalManager);
    }
}
