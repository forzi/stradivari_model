<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

class Int extends ANumber
{
    public function __construct(array $field) {
        $this->auditors['int'] = (new Dic)->get('mutator.int')->cast();
        parent::__construct($field);
    }
}
