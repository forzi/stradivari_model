<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

class Float extends ANumber
{
    public function __construct(array $field) {
        $this->auditors['float'] = (new Dic)->get('mutator.float')->cast();
        parent::__construct($field);
    }
}
