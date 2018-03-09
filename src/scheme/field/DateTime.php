<?php

namespace stradivari\model\scheme\field;

use Package\Model\ClassMap;

class DateTime extends ABase
{
    const DEFAULT_FORMAT = \DateTime::ATOM;

    public function __construct(array $field) {
        $format = isset($field['format']) ? $field['format'] : static::DEFAULT_FORMAT;
        $this->auditors['DateTime'] = ClassMap::cast('mutator.DateTime', [$format]);
        parent::__construct($field);
    }
}
