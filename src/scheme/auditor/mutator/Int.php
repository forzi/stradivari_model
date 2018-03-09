<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;

class Int extends ABase
{
    protected $message = 'can\'t convert to int';

    public function __invoke($value)
    {
        try {
            return new Result(intval($value));
        } catch (\Throwable $e) {
            return new Result(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
