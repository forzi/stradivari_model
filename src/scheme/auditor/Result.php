<?php

namespace stradivari\model\scheme\auditor;

/**
 * \Eloquent\CleanupVersions
 *
 * @property mixed $value
 * @property array $errors
 * @property bool $isValid
 *
 * @package model
 */
class Result
{
    protected $value;
    protected $errors;

    public function __construct($value, array $errors = null)
    {
        $this->value = $value;
        $this->errors = $errors;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'value':
                return $this->value;
            case 'errors':
                return $this->errors;
            case 'isValid':
                return !$this->errors;
        }
        return parent::__get($name);
    }
}
