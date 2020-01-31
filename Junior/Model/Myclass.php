<?php

namespace Magenest\Junior\Model;
use Magento\Framework\Exception\NoSuchEntityException;
class Myclass implements \Magenest\Junior\Api\JuniorInterFace
{
    public function check($data)
    {
       print_r('My Check Interface');
    }
}