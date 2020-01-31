<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\Junior\Api;

/**
 * Interface for serializing
 *
 * @api
 * @since 101.0.0
 */
interface JuniorInterFace
{
    /**
     * Serialize data into string
     *
     * @param string|int|float|bool|array|null $data
     * @return string|bool
     * @throws \InvalidArgumentException
     * @since 101.0.0
     */
    public function check($data);
}
