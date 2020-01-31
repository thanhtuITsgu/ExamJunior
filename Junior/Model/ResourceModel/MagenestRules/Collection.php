<?php
namespace Magenest\Junior\Model\ResourceModel\MagenestRules;
/**
 * Subscription Collection
 */
class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\
    AbstractCollection {
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct() {
        $this->_init('Magenest\Junior\Model\MagenestRules',
            'Magenest\Junior\Model\ResourceModel\MagenestRules');
    }
    public function getItems()
    {
        return $this->addFieldToFilter('status','pending');
    }
}