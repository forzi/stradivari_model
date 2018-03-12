<?php

namespace stradivari\model\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MStr extends ABase {
    protected $messageName = 'mutator.tpl.str';

    public function __invoke($value) {
        $creatorMutator = (new Dic)->get('function.strval');
        return $this->mutate($value, $creatorMutator);
    }
}
