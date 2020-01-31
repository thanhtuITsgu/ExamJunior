<?php
namespace Magenest\Junior\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
class Options extends AbstractSource
{
    protected $customerGroup;

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup
    )
    {
        $this->customerGroup = $customerGroup;
    }

    public function getAllOptions()
    {
        $customerGroups = $this->customerGroup->toOptionArray();
        array_unshift($customerGroups, array('value'=>'', 'label'=>'Any'));
        return $customerGroups;
    }
}