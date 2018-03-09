<?php

namespace stradivari\model\scheme\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;

class DateTime extends ABase
{
    protected $message = 'can\'t convert to DateTime';

    public function __invoke($value)
    {
        try {
            $format = $this->verificator;
            $value = $value instanceof \DateTime ? $value->format($format) : $value;
            $dateTimeClass = ClassMap::map('adapter.DateTime');
            $dateTime = $dateTimeClass::createFromFormat($format, $value);
            return new Result($dateTime);
        } catch (\Throwable $e) {
            return new Result(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
