<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

class Str extends APrimitive {
    public function __construct(array $field) {
        $this->auditors['str'] = (new Dic)->get('mutator.str')->cast();
        parent::__construct($field);
        $this->addAuditor('regexp', $field);
        if (isset($field['cutLen'])) {
            $this->auditors['cutLen'] = (new Dic)->get('mutator.cutLen')->cast($field['cutLen']);
        }
        $this->addAuditor('maxLen', $field);
        $this->addAuditor('minLen', $field);
    }
}
