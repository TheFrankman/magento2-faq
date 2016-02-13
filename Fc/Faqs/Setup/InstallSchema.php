<?php namespace Fc\Faqs\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('fc_faqs_faq'))
            ->addColumn(
                'faq_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Faq ID'
            )
            ->addColumn('faq_identifier', Table::TYPE_TEXT, 255, ['nullable' => true, 'default' => null])
            ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Faq Title')
            ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Faq Content')
            ->addColumn('sort_order',Table::TYPE_INTEGER,200,['nullable' => false], 'Sort Order')
            ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Is Faq Active?')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
            ->addIndex($installer->getIdxName('faqs_faq', ['faq_identifier']), ['faq_identifier'])
            ->setComment('Frank Clark FAQs');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}