<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 14/03/16
 * Time: 10:36
 */
namespace Aoa\Core\Logger\Initializer;

use Aoa\Core\Logger\Logger;
use Interop\Container\ContainerInterface;
use Psr\Log\LoggerAwareInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class LoggerAwareInitializer
 * @author Wonnova
 * @link http://www.wonnova.com
 *
 * The use of initializers are highly discourage, but at this moment I think this is the better option
 * @see http://zendframework.github.io/zend-servicemanager/configuring-the-service-manager/#initializers
 */
class LoggerAwareInitializer implements InitializerInterface
{
    /**
     * Initialize the given instance
     *
     * @param  ContainerInterface $container
     * @param  object $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if (! $instance instanceof LoggerAwareInterface) {
            return;
        }
        $instance->setLogger($container->get(Logger::class));
    }
}
