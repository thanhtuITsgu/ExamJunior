<?php

namespace Magenest\Junior\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class UpgradeSchema
 * @package Magenest\MultipleWishlist\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    protected $productMetadataInterface;
    protected $rulesCollectionFactory;
    protected $rulesResource;
    protected $logger;

    public function __construct(
        \Magento\Framework\App\ProductMetadataInterface $productMetadataInterface,
        \Magenest\Junior\Model\ResourceModel\MagenestRules\CollectionFactory $rulesCollectionFactory,
        \Magenest\Junior\Model\ResourceModel\MagenestRules $rulesResource,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->productMetadataInterface = $productMetadataInterface;
        $this->rulesCollectionFactory = $rulesCollectionFactory;
        $this->rulesResource = $rulesResource;
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.4') < 0) {
            $this->createTableMagenestRules($installer);
            $this->convert();
        }
        if (version_compare($context->getVersion(), '1.0.5') < 0) {
            $this->addColumn($installer);
        }
        $installer->endSetup();
    }

    public function createTableMagenestRules(SchemaSetupInterface $installer)
    {
        //Install new database table
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_rules')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null, [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ],
            'Id'
        )->addColumn(
            'last_added',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null, [
            'nullable' => true,
            'default' =>
                \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
        ],
            'Last Added'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            50,
            ['nullable' => true],
            'Rule Title'
        )->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            10,
            ['nullable' => true],
            'Rule Status'
        )->addColumn(
            'rule_type',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            11,
            ['nullable' => true],
            'Rule Type'
        )->addColumn(
            'conditions_serialized',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            64,
            ['nullable' => true],
            'Conditions Serialized'
        );
        $installer->getConnection()->createTable($table);
    }

    public function addColumn(SchemaSetupInterface $installer)
    {
        //Install new database table
        $installer->getConnection()->addColumn(
            $installer->getTable( 'magenest_rules'),
            'last_after_load',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                'comment' => 'last_after_load'
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable( 'magenest_rules'),
            'last_after_save',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                'comment' => 'last_after_save'
            ]
        );
    }

    public function convert()
    {
        $versionModule = $this->productMetadataInterface->getVersion();
        $value = explode('.',$versionModule);
        $collectionRules = $this->rulesCollectionFactory->create();
        if(count($value)){
            if($value[1] >= 2){
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $serialize = $objectManager->create('Magento\Framework\Serialize\Serializer\Serialize');
                $serializeJson = $objectManager->create('Magento\Framework\Serialize\Serializer\Json');
                foreach ($collectionRules as $value)
                {
                    $condition = $value->getConditionsSerialized();
                    $conditionUnserialize = $serialize->unserialize($condition); //unserialize cac cot.
                    $value = $value->setConditionsSerialized($serializeJson->serialize($conditionUnserialize)); //json_encode cac cot.
                    $this->rulesResource->save($value);
                }
            }else{
                foreach ($collectionRules as $value)
                {
                    $condition = $value->getConditionsSerialized();
                    $conditionJsonDecode = json_decode($condition,true);
                    $value = $value->setConditionsSerialized(serialize($conditionJsonDecode));
                    $this->rulesResource->save($value);
                }
            }
        }
    }
}