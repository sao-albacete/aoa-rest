<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 20:32
 */
namespace Aoa\Service;
use Aoa\Entity\Familia;

/**
 * Class FamiliaService
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class FamiliaService extends AbstractService implements FamiliaServiceInterface
{
    /**
     * Find all ocurrences of Familia
     *
     * @return Familia[]
     */
    public function findAll()
    {
        return $this->em->getRepository(Familia::class)->findAll();
    }
}
