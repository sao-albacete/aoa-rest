<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 20:32
 */
namespace Aoa\Service;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class AbstractService
 * @author Wonnova
 * @link http://www.wonnova.com
 */
abstract class AbstractService implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
