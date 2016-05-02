<?php
namespace Aoa\Service;

use Aoa\Entity\Cita;

/**
 * Interface CitaServiceInterface
 * @author Wonnova
 * http://www.wonnova.com
 */
interface CitaServiceInterface
{
    /**
     * Find all ocurrences of Cita
     *
     * @param null|array $order
     * @return Cita[]
     */
    public function findAll(array $order = null);

    /**
     * Find one cita by id
     *
     * @param $id
     * @return Cita
     */
    public function findOneById($id);
}
