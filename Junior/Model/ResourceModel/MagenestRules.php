<?php
namespace Magenest\Junior\Model\ResourceModel;
class MagenestRules extends
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct() {
        $this->_init('magenest_rules',
            'id');
    }
}