<?php

namespace Magenest\Junior\Observer;

class AddMessage implements \Magento\Framework\Event\ObserverInterface
{
    protected $_request;
    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->_request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $data = $observer->getEvent()->getData();
        if(isset($data['data_object'])){
            $messageEmai = array();
            $dataMessage = $data['data_object'];
            $quote = $dataMessage->getQuote();
            $buyRequest = $this->_request->getParams();
            $messageEmai['emai'] = $buyRequest['email-custom'];
            $messageEmai['message'] = $buyRequest['message-custom'];
            $messageEmai = \Zend_Json::encode($messageEmai);
            $quote->setData('email_message',$messageEmai);
            $quote->save();
        }
    }
}
