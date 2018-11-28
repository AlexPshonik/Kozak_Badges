<?php

namespace Kozak\Badges\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'kozak_badges',
            [
                'group' => 'General',
                'type' => 'text',
                'label' => 'Badge Label',
                'input' => 'multiselect',
                'option' => ['values' => [
                        'Sale',
                        'Free Shipping',
                        'Best Seller',
                    ],
                ],
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'required' => false,
                'sort_order' => 1000,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'searchable' => true,
                'filterable' => true,
            ]
        );
    }
}