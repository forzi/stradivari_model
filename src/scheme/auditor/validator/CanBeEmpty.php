<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;

class CanBeEmpty extends ABase {
    protected $message = 'is empty';

    public function __invoke($value)
    {
        if ($this->verificator) {
            return new Result($value);
        }
        return new Result(null, [$this->getMessage()]);
    }
}
