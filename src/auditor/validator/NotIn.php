<?php

namespace stradivari\model\auditor\validator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class NotIn extends ABase {
    protected $messageName = 'validator.tpl.notIn';

    public function __invoke($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        $creatorValidator = (new Dic)->get('function.in_array');
        if (empty($this->verificator)) {
            return $creatorResult->cast($value);
        }
        if (!$creatorValidator->call($value, $this->verificator)) {
            return $creatorResult->cast($value);
        }
        return $creatorResult->cast(null, [$this->getMessage()]);
    }
}
