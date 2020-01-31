<?php

namespace Magenest\Junior\Setup;

use Magento\Framework\Setup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;

class UpgradeData implements Setup\UpgradeDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    protected $_eavSetupFactory;

    protected $salesSetupFactory;

    protected $quoteSetupFactory;
    /**
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        SalesSetupFactory $salesSetupFactory,
        \Magento\Quote\Setup\QuoteSetupFactory $quoteSetupFactory
    )
    {
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    public function upgrade(
        Setup\ModuleDataSetupInterface $setup,
        Setup\ModuleContextInterface $context
    )
    {
        $setup->startSetup();
        /** @var EavSetup $eavSetup */

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
        $salesInstaller = $this->salesSetupFactory->create(['resourceName' => 'sales_setup', 'setup' => $setup]);
        $quoteInstaller = $this->quoteSetupFactory->create(['resourceName' => 'quote_setup', 'setup' => $setup]);
        /**
         * Add attributes to the eav/attribute
         */
        if (version_compare($context->getVersion(), '1.1.1') < 0) {
           $this->addAttributeCustomerGroup($eavSetup);
        }

        if (version_compare($context->getVersion(), '1.1.1') < 0) {
            $this->addAttributeVarchar($eavSetup);
        }

        if (version_compare($context->getVersion(), '1.1.2') < 0) {
            $this->addAttributeForBookingProductType($eavSetup);
        }

        if (version_compare($context->getVersion(), '1.1.4') < 0) {
            $this->addAttributeHidePrice($eavSetup);
        }

        if (version_compare($context->getVersion(), '1.1.5') < 0) {
            $salesInstaller->addAttribute('order', 'email_message', ['type' => 'text']);
        }
        if (version_compare($context->getVersion(), '1.1.6') < 0) {
            $quoteInstaller->addAttribute('quote', 'email_message', ['type' => 'text']);
        }
        $setup->endSetup();
    }

    public function addAttributeCustomerGroup($eavSetup){
        $eavSetup->addAttribute(

            \Magento\Catalog\Model\Product::ENTITY,

            'customer_group',

            [

                'group' => 'General',

                'type' => 'varchar',

                'label' => 'Customer_Group',

                'input' => 'select',

                'source' => 'Magenest\Junior\Model\Config\Source\Options',

                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,

                'visible' => true,

                'required' => false,

                'user_defined' => true,

                'visible_on_front' => true,

                'is_used_in_grid' => true,

            ]

        );
    }

    public function addAttributeVarchar($eavSetup)
    {
        $eavSetup->addAttribute(

            \Magento\Catalog\Model\Product::ENTITY,

            'test_varchar',

            [
                'group' => 'General',

                'type' => 'varchar',

                'label' => 'Test_Varchar',

                'input' => 'text',

                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,

                'visible' => true,

                'required' => false,

                'user_defined' => true,

                'visible_on_front' => true,

                'is_used_in_grid' => true,
            ]
        );
    }

    public function addAttributeHidePrice($eavSetup)
    {
        $eavSetup->addAttribute(

            \Magento\Catalog\Model\Product::ENTITY,

            'hide_price',

            [
                'group' => 'General',

                'type' => 'int',

                'label' => 'Hide Price',

                'input' => 'boolean',

                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,

                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,

                'visible' => true,

                'required' => false,

                'user_defined' => true,

                'visible_on_front' => true,

                'is_used_in_grid' => true,
            ]
        );
    }

    private function addAttributeForBookingProductType($eavSetup){
        /** @var EavSetup $eavSetup */
        $attributes = [
            'price'
        ];

        foreach ($attributes as $attributeCode) {
            $relatedProductTypes = explode(
                ',',
                $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $attributeCode, 'apply_to')
            );
            if (!in_array('maximus_product', $relatedProductTypes)) {
                $relatedProductTypes[] = 'maximus_product';
                $eavSetup->updateAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $attributeCode,
                    'apply_to',
                    implode(',', $relatedProductTypes)
                );
            }
        }
    }
}