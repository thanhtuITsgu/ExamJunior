<?php

namespace Magenest\Junior\Observer;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ModelSaveBefore implements \Magento\Framework\Event\ObserverInterface
{
    protected $registry;
    protected $rulesRepository;
    protected $rulesResource;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Registry $registry,
        \Magenest\Junior\Model\RulesRepository $rulesRepository,
        \Magenest\Junior\Model\ResourceModel\MagenestRules $rulesResource
    )
    {
        $this->timezone = $timezone;
        $this->registry = $registry;
        $this->rulesRepository = $rulesRepository;
        $this->rulesResource = $rulesResource;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $object = $observer->getObject();
        if($object->getResourceName()==="Magenest\Junior\Model\ResourceModel\MagenestRules")
        {
            $idRules = $object->getId();
            $obj = $this->rulesRepository->getById($idRules);
            $obj->setStatus('Cancel');
            return $object;
        }
    }
}
