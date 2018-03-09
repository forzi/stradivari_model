<?php

namespace stradivari\model\scheme\field;

use Package\Model\ClassMap;

class Bool extends APrimitive {

    public function __construct(array $field) {
        $this->auditors['bool'] = ClassMap::cast('mutator.bool');
        parent::__construct($field);
    }
}
