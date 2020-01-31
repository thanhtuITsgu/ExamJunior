<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Junior\Api\Data;

/**
 * @api
 * @since 100.0.2
 */
interface RulesInterface extends \Magento\Framework\Api\CustomAttributesDataInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const LAST_ADDED = 'last_added';

    const TITLE = 'title';

    const STATUS = 'status';

    const RULE_TYPE = 'rule_type';

    const CONDITIONS_SERIALIZED = 'conditions_serialized';

    const LAST_AFTER_LOAD = 'last_after_load';

    const LAST_AFTER_SAVE = 'last_after_save';

    const ATTRIBUTES = [
        self::LAST_ADDED,
        self::TITLE,
        self::STATUS,
        self::RULE_TYPE,
        self::CONDITIONS_SERIALIZED,
        self::LAST_AFTER_LOAD,
        self::LAST_AFTER_SAVE
    ];

    public function getId();

    public function setId($id);

    public function getLastAdded();

    public function setLastAdded($lastadded);

    public function getTitle();

    public function setTitle($title);

    public function getStatus();

    public function setStatus($status);

    public function getRuleType();

    public function setRuleType($ruletype);

    public function getConditionsSerialized();

    public function setConditionsSerialized($condition);

    public function getLastAfterLoad();

    public function setLastAfterLoad($lastafterload);

    public function getLastAfterSave();

    public function setLastAfterSave($lastafterload);
}
