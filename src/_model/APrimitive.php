<?php

namespace stradivari\model\model;

use stradivari\model\scheme\field\APrimitive as Scheme_APrimitive;

class APrimitive extends ABase {
    private $value;
    protected $isChanged = false;
    protected $errors = [];

    public function __construct($data, Scheme_APrimitive $scheme) {
        $this->scheme = $scheme;
        $this->__set('value', $data);
    }

    public function __get($name) {
        if ($name == 'value') {
            return $this->value;
        }
        return parent::__get($name);
    }

    public function __set($name, $value) {
        if ($name == 'value') {
            $result = $this->scheme->validate($value);
            if ($result->isValid) {
                $this->value = $result->value;
                $this->errors = [];
            } else {
                $this->errors = $result->errors;
            }
            return;
        }
        return parent::__set($name, $value);
    }
}
