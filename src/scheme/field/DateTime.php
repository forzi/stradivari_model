<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

class DateTime extends ABase {
    const DEFAULT_FORMAT = \DateTime::ATOM;

    public function __construct(array $field) {
        $format = isset($field['format']) ? $field['format'] : static::DEFAULT_FORMAT;
        $this->auditors['DateTime'] = (new Dic)->get('mutator.DateTime')->cast($format);
        parent::__construct($field);
    }
}
