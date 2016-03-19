<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 19/03/16
 * Time: 11:35
 */
namespace Aoa\Controller\Factory;
use Aoa\Controller\CitaController;
use Aoa\Service\CitaService;
use Aoa\Service\CitaServiceInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use League\Fractal\Manager as FractalManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CitaControllerFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class CitaControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return CitaController
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var CitaServiceInterface $citaService */
        $citaService = $container->get(CitaService::class);
        /** @var FractalManager $fractalManager */
        $fractalManager = $container->get(FractalManager::class);

        return new CitaController($citaService, $fractalManager);
    }
}
