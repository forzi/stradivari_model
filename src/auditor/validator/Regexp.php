<?php

namespace stradivari\model\auditor\validator;

use stradivari\model\Dic;
use stradivari\model\scheme\auditor\ABase;

class Regexp extends ABase {
    protected $messageName = 'validator.tpl.regexp';

    public function __invoke($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        $creatorValidator = (new Dic)->get('function.preg_match');
        if (empty($this->verificator)) {
            return $creatorResult->cast($value);
        }
        if ($creatorValidator->call($this->verificator, $value)) {
            return $creatorResult->cast($value);
        }
        return $creatorResult->cast(null, [$this->getMessage()]);
    }
}
