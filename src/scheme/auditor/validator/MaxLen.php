<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MaxLen extends ABase {
    protected $messageName = "validator.tpl.maxLen";

    public function __invoke($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        $creatorValidator = (new Dic)->get('function.strlen');
        if (empty($this->verificator)) {
            return $creatorResult->cast($value);
        }
        if ($creatorValidator->call($value) > $this->verificator) {
            return $creatorResult->cast(null, [$this->getMessage()]);
        }
        return $creatorResult->cast($value);
    }
}
