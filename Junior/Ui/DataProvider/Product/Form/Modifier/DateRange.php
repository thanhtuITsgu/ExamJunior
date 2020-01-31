<?php
namespace Magenest\Junior\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class DateRange extends AbstractModifier
{
    public function modifyMeta(array $meta)
    {
        // Color attribute
        $code = 'pick_date';
        // Change component js
        $meta['product-details']['children']['container_' . $code]['children'] = array_replace_recursive(
            $meta['product-details']['children']['container_' . $code]['children'], [
            $code => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'component' => 'Magenest_Junior/js/form/element/picker',
                        ]
                    ]
                ]
            ]
        ]);
        return $meta;
    }

    public function modifyData(array $data)
    {
        return $data;
    }
}