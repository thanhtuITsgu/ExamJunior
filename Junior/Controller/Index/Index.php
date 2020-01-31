<?php

namespace Magenest\Junior\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $juniorInterFace;

    public function __construct(
        Context $context,
        \Magenest\Junior\Api\JuniorInterFace $juniorInterFace
    )
    {
        $this->juniorInterFace = $juniorInterFace;
        parent::__construct($context);
    }

    public function execute()
    {
        $string = "";
        $this->juniorInterFace->check($string);
    }
}