<?php

namespace stradivari\model\scheme\field;

abstract class ANumber extends APrimitive
{
    public function __construct(array $field)
    {
        parent::__construct($field);
        $this->addAuditor('min', $field);
        $this->addAuditor('max', $field);
    }
}
