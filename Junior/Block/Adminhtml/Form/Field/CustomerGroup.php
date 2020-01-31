<?php
namespace Magenest\Junior\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class CustomerGroup extends Select
{
    protected $customerGroupColl;

    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroupColl,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->customerGroupColl = $customerGroupColl;
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param $value
     * @return $this
     */
    public function setInputId($value)
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    private function getSourceOptions()
    {

        $customerGroups = $this->customerGroupColl->toOptionArray();
        return $customerGroups;
    }
}