<?php

namespace stradivari\model\auditor\validator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class Min extends ABase {
    protected $messageName = 'validator.tpl.min';

    public function __invoke($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        if ($value < $this->verificator) {
            return $creatorResult->cast(null, [$this->getMessage()]);
        }
        return $creatorResult->cast($value);
    }
}
