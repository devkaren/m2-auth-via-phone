<?php

namespace Customer\PhoneAuthentication\Setup;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Customer::ENTITY,
            'phone_number',
            [
                'type'         => 'varchar',
                'label'        => 'Phone Number',
                'input'        => 'text',
                'required'     => true,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0,
            ]
        );
        // Update firstname and lastname field as "no required"
        $eavSetup->updateAttribute(Customer::ENTITY, 'firstname', 'is_required', 'false');
        $eavSetup->updateAttribute(Customer::ENTITY, 'lastname', 'is_required', 'false');

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'phone_number');

        $attribute->setData('used_in_forms', ['adminhtml_customer', 'customer_account_create', 'customer_account_edit']);
        $attribute->addData([
            'attribute_set_id' => 1,
            'attribute_group_id' => 1
        ]);
        $attribute->save();
    }
}
