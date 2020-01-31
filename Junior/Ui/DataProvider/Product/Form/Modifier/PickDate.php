<?php

namespace Magenest\Junior\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;

class PickDate extends AbstractModifier
{
    private $locator;

    public function __construct(
        LocatorInterface $locator
    )
    {
        $this->locator = $locator;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'custom_fieldset' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Custom Fieldset'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product.custom_fieldset',
                                'collapsible' => true,
                                'sortOrder' => 1,
                            ],
                        ],
                    ],
                    'children' => [
                        'custom_fieldV2' => $this->getCustomFieldV2(),
                        'custom_field' => $this->getCustomField(),
                        'custom_fieldV1' => $this->getCustomFieldV3(),
                    ],
                ]
            ]
        );
        return $meta;
    }

    public function getCustomField()
    {
        return [

            'arguments' => [

                'data' => [

                    'config' => [

                        'label' => __('Custom Field'),

                        'componentType' => Field::NAME,

                        'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,

                        'dataScope' => 'enabled',

                        'dataType' => Text::NAME,

                        'sortOrder' => 10,

                        'default' => 'Magento',
                    ],
                ],
            ],
        ];
    }

    public function getCustomFieldV2()
    {
        return [

            'arguments' => [

                'data' => [

                    'config' => [

                        'label' => __('Custom Field'),

                        'componentType' => Field::NAME,

                        'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,

                        'dataScope' => 'enabled',

                        'dataType' => Text::NAME,

                        'sortOrder' => 10,

                        'default' => 'Magento',
                        'notice' => 'Note hereeeeeee',
                    ],
                ],
            ],
        ];
    }

    public function getCustomFieldV3()
    {
        return [

            'arguments' => [

                'data' => [

                    'config' => [

                        'label' => __('Custom Field'),

                        'componentType' => Field::NAME,

                        'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,

                        'dataScope' => 'enabled',

                        'dataType' => Text::NAME,

                        'sortOrder' => 10,

                        'default' => 'Magento',
                    ],
                ],
            ],
        ];
    }
}