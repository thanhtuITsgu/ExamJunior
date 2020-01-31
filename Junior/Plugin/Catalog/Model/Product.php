<?php

namespace Magenest\Junior\Plugin\Catalog\Model;

class Product
{
    protected $escaper;
    public function __construct(
        \Magento\Framework\Escaper $escaper
    )
    {
        $this->escaper = $escaper;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
     return $result;
    }
}
