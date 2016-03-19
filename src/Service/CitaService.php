<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 18/03/16
 * Time: 13:25
 */
namespace Aoa\Service;
use Aoa\Entity\Cita;

/**
 * Class CitaService
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class CitaService extends AbstractService implements CitaServiceInterface
{
    /**
     * Find all ocurrences of Cita
     *
     * @return Cita[]
     */
    public function findAll()
    {
        return $this->em->getRepository(Cita::class)->findAll();
    }

    /**
     * Find one cita by id
     *
     * @param $id
     * @return Cita
     */
    public function findOneById($id)
    {
        return $this->em->getRepository(Cita::class)->find($id);
    }
}
