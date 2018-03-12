<?php

namespace stradivari\model\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MFloat extends ABase {
    protected $messageName = 'mutator.tpl.float';

    public function __invoke($value) {
        $creatorMutator = (new Dic)->get('function.doubleval');
        return $this->mutate($value, $creatorMutator);
    }
}
