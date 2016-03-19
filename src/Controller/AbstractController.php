<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 21:47
 */
namespace Aoa\Controller;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class AbstractController
 * @author Wonnova
 * @link http://www.wonnova.com
 */
abstract class AbstractController implements LoggerAwareInterface
{
    use LoggerAwareTrait;
}
