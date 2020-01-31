<?php

namespace Magenest\Junior\Observer;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ModelSaveAfter implements \Magento\Framework\Event\ObserverInterface
{
    protected $rulesResource;
    protected $timezone;
    protected $registry;

    public function __construct(
        \Magenest\Junior\Model\ResourceModel\MagenestRules $rulesResource,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Registry $registry
    )
    {
        $this->rulesResource = $rulesResource;
        $this->timezone = $timezone;
        $this->registry = $registry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $object = $observer->getData('object');
        if($this->registry->registry('Saved'))
        {
            $this->registry->unregister('Saved');
            return $object;
        }
        if($object->getResourceName()==="Magenest\Junior\Model\ResourceModel\MagenestRules")
        {
            $todayDate = $this->timezone->date()->format('Y-m-d H:i:s');
            $object->setLastAfterSave($todayDate);
            $this->registry->register('Saved', true);
            $this->rulesResource->save($object);
            return $object;
        }
    }
}
