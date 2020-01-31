<?php

namespace Magenest\Junior\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Magenest\MultipleWishlist\Controller\Adminhtml\Report
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $rulesRepository;

    protected $rulesFactory;

    protected $productRepository;

    protected $rulesResource;
    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magenest\Junior\Model\RulesRepository $rulesRepository,
        \Magenest\Junior\Model\MagenestRulesFactory $rulesFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magenest\Junior\Model\ResourceModel\MagenestRules $rulesResource
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->rulesRepository = $rulesRepository;
        $this->rulesFactory = $rulesFactory;
        $this->productRepository = $productRepository;
        $this->rulesResource = $rulesResource;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $obj = $this->rulesRepository->getById(2);
        $obj->setTitle('Check');
        $this->rulesResource->save($obj);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Magenest Rules'));
        return $resultPage;
    }
}