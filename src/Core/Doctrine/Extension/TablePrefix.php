<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 12/03/16
 * Time: 19:13
 */
namespace Aoa\Core\Doctrine\Extension;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Class TablePrefix
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class TablePrefix
{
    /**
     * @var string
     */
    protected $prefix = '';

    public function __construct($prefix)
    {
        $this->prefix = (string) $prefix;
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $classMetadata */
        $classMetadata = $eventArgs->getClassMetadata();

        if (! $classMetadata->isInheritanceTypeSingleTable()|| $classMetadata->getName() === $classMetadata->rootEntityName) {
//            $classMetadata->setTableName($this->prefix . $classMetadata->getTableName());
            $classMetadata->setPrimaryTable(['name' => $this->prefix . $classMetadata->getTableName()]);
        }

        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            if ($mapping['type'] == \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_MANY && $mapping['isOwningSide']) {
                $mappedTableName = $mapping['joinTable']['name'];
                $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix . $mappedTableName;
            }
        }
    }
}
