<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;

class Bool extends ABase
{
    protected $message = 'can\'t convert to bool';

    public function __invoke($value)
    {
        try {
            return new Result(boolval($value));
        } catch (\Throwable $e) {
            return new Result(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
