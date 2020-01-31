<?php

namespace Magenest\Junior\Api;

interface RulesRepositoryInterface
{
    public function save(\Magenest\Junior\Api\Data\RulesInterface $rules);

    public function getById($ruleId);

    public function delete(\Magenest\Junior\Api\Data\RulesInterface $rules);

    public function deleteById($ruleId);
}