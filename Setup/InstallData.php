<?php

namespace PinpointDesigns\CustomerTestimonial\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class InstallData implements InstallDataInterface
{
    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable(CustomerTestimonialInterface::TABLE_NAME)
        )->addColumn(CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID, Table::TYPE_INTEGER, null, [
            'identity' => true,
            'nullable' => false,
            'primary' => true,
            'unsigned' => true,
        ])->addColumn(CustomerTestimonialInterface::FULLNAME, Table::TYPE_TEXT, 255, [
            'nullable' => false,
        ])->addColumn(CustomerTestimonialInterface::CONTENT, Table::TYPE_TEXT, 500, [
            'nullable' => false,
        ])->addColumn(CustomerTestimonialInterface::IS_PUBLISHED, Table::TYPE_BOOLEAN, null, [
            'nullable' => false,
            'default' => true,
        ])->addColumn(CustomerTestimonialInterface::CREATED_AT, Table::TYPE_TIMESTAMP, null, [
            'nullable' => false,
            'default' => Table::TIMESTAMP_INIT,
        ]);

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
