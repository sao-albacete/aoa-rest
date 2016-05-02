<?php
namespace Aoa\Core\Doctrine\Repository;

use Doctrine\ORM\EntityRepository as DoctrineEntityRepository;
use Doctrine\ORM\Query\Expr\Andx;

/**
 * Class EntityRepository
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class EntityRepository extends DoctrineEntityRepository implements EntityRepositoryInterface
{
    /**
     * Return a count by conditions
     *
     * @param array $conditions
     * @param array $parameters
     * @return int
     */
    public function countBy(array $conditions, array $parameters)
    {
        // Add alias to fields
        $conditions = array_map(function ($field) {
            return 'u.' . $field;
        }, $conditions);

        $qb = $this->createQueryBuilder('u');
        $qb->select('COUNT(*)')
            ->where(new Andx($conditions))
            ->setParameters($parameters);

        return intval($qb->getQuery()->getSingleScalarResult());
    }

    /**
     * Get an array of fields by conditions
     *
     * @param array $fields
     * @param array $conditions
     * @param array $parameters
     * @return array
     */
    public function findFieldsBy(array $fields, array $conditions, array $parameters)
    {
        // Add alias to fields
        $conditions = array_map(function ($field) {
            return 'u.' . $field;
        }, $conditions);
        $fields = array_map(function ($field) {
            return 'u.' . $field;
        }, $fields);

        $qb = $this->createQueryBuilder('u');
        $qb->select($fields)
            ->where(new Andx($conditions))
            ->setParameters($parameters);
        return $qb->getQuery()->getArrayResult();
    }
}
