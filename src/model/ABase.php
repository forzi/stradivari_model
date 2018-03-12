<?php

namespace stradivari\model\model;

/**
 *
 * @param $scheme
 * @param $errors
 * @param $value
 * @param $isValid
 */
abstract class ABase {
    const PRIMITIVES = [
        'bool',
        'float',
        'int',
        'str',
        'DateTime'
    ];
    protected $scheme;
    protected $errors = [];
    protected $value;

    public function resetErrors() {
        $this->errors = [];
        return $this;
    }
    public function __get($name) {
        switch ($name) {
            case 'value':
                return $this->value;
            case 'errors':
                return $this->errors;
            case 'scheme':
                return $this->scheme;
            case 'isValid':
                return !$this->errors;
            default:
                return parent::__get($name);
        }
    }
}