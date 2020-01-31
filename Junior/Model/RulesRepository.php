<?php

namespace Magenest\Junior\Model;
use Magento\Framework\Exception\NoSuchEntityException;
class RulesRepository implements \Magenest\Junior\Api\RulesRepositoryInterface
{
    protected $productFactory;
    protected $rulesFactory;
    protected $instancesById = [];
    public function __construct(
        \Magenest\Junior\Model\MagenestRulesFactory $rulesFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->rulesFactory = $rulesFactory;
        $this->productFactory = $productFactory;
    }

    /**
     * Save test data.
     */
    public function save(\Magenest\Junior\Api\Data\RulesInterface $rules)
    {
        $rules->getResource()->save($rules);
        return $rules;
    }

    /**
     * Retrieve test data.
     */
    public function getById($ruleId)
    {
        if (!isset($this->instancesById[$ruleId])){
            $ruleModel = $this->rulesFactory->create();
            $ruleModel->load($ruleId);
            if(!$ruleModel->getId()){
                throw new NoSuchEntityException(__('Unable to find My Entity with ID "%1"', $ruleId));
            }
            $this->instancesById[$ruleModel->getId()] = $ruleModel;
        }
        return $this->instancesById[$ruleId];
    }

    /**
     * Delete test.
     */
    public function delete(\Magenest\Junior\Api\Data\RulesInterface $rules)
    {
        $rules->getResource()->delete($rules);
    }

    /**
     * Delete test by test ID.
     */
    public function deleteById($ruleId)
    {
        $obj = $this->getById($ruleId);
        $obj->delete();
    }
}