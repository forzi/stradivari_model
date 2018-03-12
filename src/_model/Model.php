<?php

namespace stradivari\model\model;

use stradivari\model\scheme\Collection as Scheme_Collection;
use stradivari\model\scheme\field\APrimitive as Scheme_APrimitive;
use stradivari\model\scheme\Scheme;

class Model extends AComposite {
    public function __construct(array $data, Scheme $scheme) {
        $this->scheme = $scheme;
        foreach ($scheme as $name => $field) {
            $value = isset($data['name']) ? $data['name'] : null;
            if ($field instanceof Scheme_APrimitive) {
                $obj = new Field($value, $field);
            } else if ($field instanceof Scheme_Collection) {
                $obj = new Collection($value, $field);
            } else if ($field instanceof Scheme) {
                $obj = new Model($value, $field);;
            }
            $obj->parent = $this;
            $this->value[$name] = $obj;
        }
    }

    public function offsetExists($offset) {
        return true;
    }

    public function offsetUnset($offset) {
        if (!isset($this->value[$offset])) {
            return;
        }
        $field = $this->value[$offset];
        $field->value = null;
    }

    public function offsetGet($offset) {
        if (!isset($this->value[$offset])) {
            return null;
        }
        $field = $this->value[$offset];
        if ($field instanceof ABase) {
            return $field;
        }
        return $field->value;
    }

    public function offsetSet($offset, $value) {
        if (!isset($this->value[$offset])) {
            return;
        }
        $field = $this->value[$offset];
        if (is_object($value) && ($value instanceof ABase) && $value->scheme === $field->scheme) {
            $value = clone $value;
            $value->parent = $this;
            $this->value[$offset] = $value;
        }
        if ($field instanceof APrimitive) {
            $field->value = $value;
            return;
        }
    }

    public function __get($name) {
        if (isset($this->value[$name])) {
            return $this->value[$name];
        }
        return parent::__get($name);
    }
}
