<?php

namespace Magenest\Junior\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class TestJunior extends \Magento\Framework\App\Action\Action
{
    protected $productMetadataInterface;
    protected $rulesCollectionFactory;
    protected $rulesResource;
    protected $magenestRulesFactory;
    protected $productFactory;
    protected $resultPageFactory;
    protected $product;

    public function __construct(
        Context $context,
        \Magento\Framework\App\ProductMetadataInterface $productMetadataInterface,
        \Magenest\Junior\Model\ResourceModel\MagenestRules\CollectionFactory $rulesCollectionFactory,
        \Magenest\Junior\Model\ResourceModel\MagenestRules $rulesResource,
        \Magenest\Junior\Model\MagenestRulesFactory $magenestRulesFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product $product,
        PageFactory $resultPageFactory
    )
    {
        $this->productMetadataInterface = $productMetadataInterface;
        $this->rulesCollectionFactory = $rulesCollectionFactory;
        $this->rulesResource = $rulesResource;
        $this->magenestRulesFactory = $magenestRulesFactory;
        $this->productFactory =$productFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->product = $product;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $version = $this->productFactory->create();
        $productResource = $this->product->load($version,1,'sku');
        $version->setStatus('Cancel');
//        $this->rulesResource->save($version,'id','3');
        $rulesCollectionFactory = $this->rulesCollectionFactory->create()->getItems();
        return $resultPage;
    }
}