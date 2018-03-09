<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;

class Float extends ABase
{
    protected $message = 'can\'t convert to float';

    public function __invoke($value)
    {
        try {
            return new Result(doubleval($value));
        } catch (\Throwable $e) {
            return new Result(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
