<?php

namespace stradivari\model\scheme\auditor\validator;

use stradivari\model\scheme\auditor\ABase;

class MaxLen extends ABase
{
    protected $message = "is longer than %s";

    public function __invoke($value)
    {
        if (empty($this->verificator)) {
            return new Result($value);
        }
        if (strlen($value) > $this->verificator) {
            return new Result(null, [$this->getMessage()]);
        }
        return new Result($value);
    }
}
