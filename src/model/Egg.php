<?php

namespace stradivari\model\model;

use stradivari\model\Dic;

class Egg extends ABase {
    public function __construct($scheme, $data) {
        $this->scheme = $scheme;
        $this->value = $data;
    }
    public function cast() {
        $schemeName = is_array($this->scheme) ? $this->castScheme() : $this->scheme;
        $scheme = (new Dic)->get("SchemeModel.{$schemeName}")->cast();
        $this->errors = $scheme->errors;
        if (!$this->isValid) {
            return null;
        }
        if (in_array($scheme['type'], static::PRIMITIVES)) {
            return new Field($scheme->value, $this->value);
        }
        return new Model($scheme, $this->value);
    }
    protected function castScheme(array $scheme) {

    }
}
