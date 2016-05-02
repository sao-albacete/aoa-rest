<?php
namespace Aoa\Core\Doctrine\Repository;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface EntityRepositoryInterface
 * @author Wonnova
 * http://www.wonnova.com
 */
interface EntityRepositoryInterface extends ObjectRepository
{
    /**
     * Return a count by conditions
     *
     * @param array $conditions
     * @param array $parameters
     * @return int
     */
    public function countBy(array $conditions, array $parameters);

    /**
     * Get an array of fields by conditions
     *
     * @param array $fields
     * @param array $conditions
     * @param array $parameters
     * @return array
     */
    public function findFieldsBy(array $fields, array $conditions, array $parameters);
}
