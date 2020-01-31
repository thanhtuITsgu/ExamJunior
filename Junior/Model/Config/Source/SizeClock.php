<?php
namespace Magenest\Junior\Model\Config\Source;
class SizeClock implements
    \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => '1',
                'label' => __('Big')
            ],
            [
                'value' => '2',
                'label' => __('Small')
            ],
        ];
    }
}