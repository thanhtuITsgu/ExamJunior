<?php
namespace Magenest\Junior\Block\Sales\Order;

use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\OrderFactory;

class Info extends Template
{
    protected $orderFactory;
    public function __construct(Template\Context $context, array $data = [], OrderFactory $orderFactory)
    {
        $this->orderFactory = $orderFactory;
        parent::__construct($context, $data);
    }

    public function getMessageData(){
        $orderId = $this->getOrderId();
        $message = $this->orderFactory->create()->load($orderId)->getEmailMessage();
        $message = \Zend_Json::decode($message);
        return $message;
    }
    public function getOrderId(){
        $orderId = $this->getRequest()->getParam('order_id');
        return $orderId;
    }
}
