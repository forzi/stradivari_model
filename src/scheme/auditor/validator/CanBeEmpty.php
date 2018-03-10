<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class CanBeEmpty extends ABase {
    protected $messageName = 'validator.tpl.canBeEmpty';

    public function __invoke($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        if ($this->verificator || $value) {
            return $creatorResult->cast($value);
        }
        return $creatorResult->cast(null, [$this->getMessage()]);
    }
}
