<?php
namespace Magenest\Junior\Block\Adminhtml\Form\Field;

use Magenest\Junior\Block\Adminhtml\Form\Field\TypeClock;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magenest\Junior\Block\Adminhtml\Form\Field\CustomerGroup;

/**
 * Class Ranges
 */
class Ranges extends AbstractFieldArray
{
    /**
     * @var TypeClock
     */
    private $taxRenderer;
    private $customergroup;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('customer_group', [
            'label' => __('Customer'),
            'renderer' => $this->getCustomerGroup()
        ]);
        $this->addColumn('type_clock', [
            'label' => __('Type Clock'),
            'renderer' => $this->getTypeClock()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row)
    {
        $options = [];

        $tax = $row->getTax();
        if ($tax !== null) {
            $options['option_' . $this->getTypeClock()->calcOptionHash($tax)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @return TypeClock
     * @throws LocalizedException
     */
    private function getTypeClock()
    {
        if (!$this->taxRenderer) {
            $this->taxRenderer = $this->getLayout()->createBlock(
                TypeClock::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->taxRenderer;
    }
    private function getCustomerGroup()
    {
        if (!$this->customergroup) {
            $this->customergroup = $this->getLayout()->createBlock(
                CustomerGroup::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->customergroup;
    }
}