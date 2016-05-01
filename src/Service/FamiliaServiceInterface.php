<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 13/03/16
 * Time: 20:37
 */
namespace Aoa\Service;

use Aoa\Entity\Familia;

/**
 * Class FamiliaService
 * @author Wonnova
 * @link http://www.wonnova.com
 */
interface FamiliaServiceInterface
{
    /**
     * Find all ocurrences of Familia
     *
     * @param null|array $orderBy
     * @return Familia[]
     */
    public function findAll(array $orderBy = null);
}