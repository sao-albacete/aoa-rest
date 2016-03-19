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
     * @return Cita[]
     */
    public function findAll();
}
