<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;

class Str extends ABase
{
    protected $message = 'can\'t convert to string';

    public function __invoke($value)
    {
        try {
            return new Result(strval($value));
        } catch (\Throwable $e) {
            return new Result(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
