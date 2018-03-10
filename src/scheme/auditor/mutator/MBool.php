<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MBool extends ABase {
    protected $messageName = 'mutator.tpl.bool';

    public function __invoke($value) {
        $creatorMutator = (new Dic)->get('function.boolval');
        return $this->mutate($value, $creatorMutator);
    }
}
