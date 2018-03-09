<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;

class Regexp extends ABase
{
    protected $message = 'does not match the regular expression %s';

    public function __invoke($value)
    {
        if (empty($this->verificator)) {
            return new Result($value);
        }
        if (!preg_match($this->verificator, $value)) {
            return new Result($value);
        }
        return new Result(null, [$this->getMessage()]);
    }
}
