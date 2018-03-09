<?php

namespace stradivari\model\scheme\field;

use Package\Model\ClassMap;

class Float extends ANumber
{
    public function __construct(array $field) {
        $this->auditors['float'] = ClassMap::cast('mutator.float');
        parent::__construct($field);
    }
}
