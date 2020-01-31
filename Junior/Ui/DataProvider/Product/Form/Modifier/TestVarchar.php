<?php
namespace Magenest\Junior\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Downloadable\Api\Data\ProductAttributeInterface;
use Magento\Downloadable\Model\Product\Type;

class TestVarchar extends AbstractModifier
{
    protected $authSession;

    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->authSession = $authSession;
    }

    public function modifyMeta(array $meta)
    {
        $userFirstName = $this->authSession->getUser()->getFirstName();
        $check = preg_match('/^[A-M]/',substr($userFirstName,0,1));
        // Color attribute
        if($check == 1){
            $code = 'test_varchar';
            // Change component js
            $meta['product-details']['children']['container_' . $code]['children'] = array_replace_recursive(
                $meta['product-details']['children']['container_' . $code]['children'], [
                $code => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'visible' => 0
                            ]
                        ]
                    ]
                ]
            ]);
        }
        return $meta;
    }

    public function modifyData(array $data)
    {
//        $keyFirst = key($data);
//        if(is_numeric($keyFirst))
//        {
//            $array = explode('+',$data[$keyFirst]['product']['test_varchar']);
//            array_pop($array);
//            $data[$keyFirst]['product']['test_varchar'] = implode('+',$array);
//        }
        return $data;
    }
}