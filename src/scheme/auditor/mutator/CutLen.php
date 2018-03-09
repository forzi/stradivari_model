<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;

class CutLen extends ABase
{
    protected $message = 'can\'t cut string to %s';

    public function __invoke($value)
    {
        if (empty($this->verificator)) {
            return new Result($value);
        }
        try {
            return new Result(substr($value, 0, $this->verificator));
        } catch (\Throwable $e) {
            return new Result(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
