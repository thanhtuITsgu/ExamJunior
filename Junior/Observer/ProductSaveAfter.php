<?php

namespace Magenest\Junior\Observer;

class ProductSaveAfter implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getData('product');
        $testVarchar = (string)$product->getTestVarchar();
        $testVarchar = $testVarchar .'+' .'varchar(' . strlen($testVarchar) . ')';
        $product->setTestVarchar($testVarchar);
        $product->save();
    }
}
