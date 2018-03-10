<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MInt extends ABase {
    protected $messageName = 'mutator.tpl.int';

    public function __invoke($value) {
        $creatorMutator = (new Dic)->get('function.intval');
        return $this->mutate($value, $creatorMutator);
    }
}
