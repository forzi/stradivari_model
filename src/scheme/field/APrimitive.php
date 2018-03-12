<?php

namespace stradivari\model\scheme\field;

abstract class APrimitive extends ABase {
    protected $scheme;

    public function __construct(array $field) {
        $this->scheme = $field;
        parent::__construct($field);
        $this->addAuditor('in', $field);
        $this->addAuditor('notIn', $field);
    }
}
