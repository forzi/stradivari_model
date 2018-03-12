<?php

namespace stradivari\model\auditor\validator;

use stradivari\model\scheme\auditor\ABase;
use stradivari\model\Dic;

class CanBeOptional extends ABase {
    protected $messageName = 'validator.tpl.canBeOptional';

    public function __invoke($value) {
        $scheme = $this->verificator;
        $isOptional = isset($scheme['default']);
        $default = $isOptional ? $scheme['default'] : null;
        $creatorResult = (new Dic)->get('adapter.Result');
        if ($value === null) {
            if (!$isOptional) {
                return $creatorResult->cast(null, [$this->getMessage()]);
            }
            if ($default === null) {
                return $creatorResult->cast(null);
            }
            $value = $default;
        }
        return $creatorResult->cast($value);
    }
}
