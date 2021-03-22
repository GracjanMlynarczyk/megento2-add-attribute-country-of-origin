<?php


namespace Ghratzoo\AttributeCountryOfOrigin\Setup;


use Ghratzoo\AttributeCountryOfOrigin\Model\Backend\Backend;
use Ghratzoo\AttributeCountryOfOrigin\Model\Config\CountryOfOriginOptions;
use Ghratzoo\AttributeCountryOfOrigin\Model\Frontend\Frontend;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }


    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'country_of_origin',
            [
                'group' => 'General',
                'type' => 'text',
                'label' => 'Country of origin',
                'input' => 'select',
                'source' => CountryOfOriginOptions::class,
                'frontend' => Frontend::class,
                'backend' => Backend::class,
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true,
            ]
        );

        $setup->endSetup();
    }
}
