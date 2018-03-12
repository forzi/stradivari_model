<?php

namespace stradivari\model\model;

abstract class ABase {
    protected $scheme;
    protected $parent;

    public function __get($name) {
        switch ($name) {
            case 'scheme':
                return $this->scheme;
        }
        return parent::__get($name);
    }
}
