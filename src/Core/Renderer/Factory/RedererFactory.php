<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 14/03/16
 * Time: 0:20
 */
namespace Aoa\Core\Renderer\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Slim\Views\PhpRenderer;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class RedererFactory
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class RedererFactory implements FactoryInterface
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
        new PhpRenderer([
            'template_path' => __DIR__ . '/../../../../templates/',
        ]);
    }
}
