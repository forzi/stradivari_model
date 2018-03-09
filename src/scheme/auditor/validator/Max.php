<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;

class Max extends ABase
{
    protected $message = 'grater then %s';

    public function __invoke($value)
    {
        if ($value > $this->verificator) {
            return new Result(null, [$this->getMessage()]);
        }
        return new Result($value);
    }
}
