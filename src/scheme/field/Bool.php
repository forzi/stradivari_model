<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

class Bool extends APrimitive {

    public function __construct(array $field) {
        $this->auditors['bool'] = (new Dic)->get('mutator.bool')->cast();
        parent::__construct($field);
    }
}
