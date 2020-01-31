<?php
namespace Magenest\Junior\Plugin;

class FinalPriceBox
{
    protected $productFactory;

    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->productFactory = $productFactory;
    }

    function aroundToHtml($subject, callable $proceed)
    {
        $product = $subject->getSaleableItem();
        $product = $this->productFactory->create()->load($product->getId());
        if($product->getHidePrice() == 1){
            return '';
        }else{
            return $proceed();
        }
    }
}
