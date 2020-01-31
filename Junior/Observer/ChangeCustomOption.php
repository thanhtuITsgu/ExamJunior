<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Demo
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Magenest\Junior\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class ChangeCustomOption implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    protected $_request;

    protected $serialize;

    protected $timezone;
    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request,
        \Magento\Framework\Serialize\Serializer\Json $serialize,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
    ) {
        $this->_request = $request;
        $this->serialize = $serialize;
        $this->timezone = $timezone;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Check and set information according to your need
        if ($this->_request->getFullActionName() == 'checkout_cart_add') { //checking when product is adding to cart
            $product = $observer->getProduct();
            $todayDate = $this->timezone->scopeTimeStamp();
            $additionalOptions = [];
            $additionalOptions[] = array(
                'label' => "Time Stamp",
                'value' => $todayDate,
            );
            $observer->getProduct()->addCustomOption('additional_options', $this->serialize->serialize($additionalOptions));
        }
    }
}