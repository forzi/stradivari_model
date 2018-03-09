<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;

class NotIn extends ABase
{
    protected $message = 'is in deprecated list %s';

    public function __invoke($value)
    {
        if (empty($this->verificator)) {
            return new Result($value);
        }
        if (!in_array($value, $this->verificator)) {
            return new Result($value);
        }
        return new Result(null, [$this->getMessage()]);
    }
}
