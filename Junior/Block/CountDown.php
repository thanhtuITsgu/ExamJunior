<?php
namespace Magenest\Junior\Block;
use Magento\Framework\View\Element\Template;
class CountDown extends Template
{
    protected $_resource;
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    public function getTitleClock()
    {
        $titleClock = $this->_scopeConfig->getValue('clockconfiguation/clock/title_clock', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $titleClock;
    }

    public function getColorTitle()
    {
        $titleClock = $this->_scopeConfig->getValue('clockconfiguation/clock/text_clock', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $titleClock;
    }

    public function getColerClock()
    {
        $colorClock = $this->_scopeConfig->getValue('clockconfiguation/clock/color_clock', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $colorClock;
    }

}