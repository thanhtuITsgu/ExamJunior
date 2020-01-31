<?php

namespace Magenest\Junior\Observer\Quote;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;


class AfterPlaceOrder implements ObserverInterface
{
    protected $quoteFactory;

    public function __construct(
        \Magento\Quote\Model\QuoteFactory $quoteFactory
    )
    {
        $this->quoteFactory = $quoteFactory;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getData('order');
        $quoteId = $order->getQuoteId();
        $quote = $this->quoteFactory->create()->load($quoteId);
        $message = $quote->getEmailMessage();
        $order->setEmailMessage($message);
        $order->save();
    }
}
