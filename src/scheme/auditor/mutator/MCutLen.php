<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MCutLen extends ABase {
    protected $messageName = 'mutator.tpl.cutLen';

    public function __invoke($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        $creatorMutator = (new Dic)->get('function.substr');
        if (empty($this->verificator)) {
            return $creatorResult->cast($value);
        }
        try {
            $value = $creatorMutator->call($value, 0, $this->verificator);
            return $creatorResult->cast($value);
        } catch (\Throwable $e) {
            return $creatorResult->cast(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
