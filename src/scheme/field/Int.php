<?php

namespace stradivari\model\scheme\field;

use Package\Model\ClassMap;

class Int extends ANumber
{
    public function __construct(array $field) {
        $this->auditors['int'] = ClassMap::cast('mutator.int');
        parent::__construct($field);
    }
}
