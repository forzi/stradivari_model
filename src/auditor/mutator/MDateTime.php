<?php

namespace stradivari\model\auditor\mutator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class MDateTime extends ABase {
    protected $messageName = 'mutator.tpl.DateTime';

    public function __invoke($value) {
        $dic = new Dic;
        $creatorResult = $dic->get('adapter.Result');
        $creatorDateTime = $dic->get('adapter.DateTime');
        try {
            $format = $this->verificator;
            $value = $value instanceof \DateTime ? $value->format($format) : $value;
            $dateTime = $creatorDateTime->staticCallable('createFromFormat')->call($format, $value);
            if ($dateTime instanceof \DateTime) {
                return $creatorResult->cast($dateTime);
            }
            return $creatorResult->cast(null, [$this->getMessage()]);
        } catch (\Throwable $e) {
            return $creatorResult->cast(null, [$this->getMessage(), $e->getMessage()]);
        }
    }
}
