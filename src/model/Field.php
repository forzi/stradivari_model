<?php

namespace stradivari\model\model;

use stradivari\model\Dic;
use stradivari\model\scheme\auditor\Result;

/**
 *
 * @param $isChanged
 *
 */
class Field extends ABase {
    protected $isChanged;
    protected $auditors = [];

    public function __construct(array $scheme, $data) {
        $this->setScheme($scheme);
        $this->__set('value', $data);
        $this->isChanged = false;
    }
    public function __set($name, $data) {
        if ($name != 'value') {
            return parent::__set($name, $data);
        }
        $result = $this->validate($data);
        if (!$result->isValid) {
            $this->errors = (new Dic)->get('function.array_merge')->call($this->errors, $result->errors);
            return $this;
        }
        $this->isChanged = true;
        $this->value = $result->value;
    }
    public function __get($name) {
        switch ($name) {
            case 'isChanged':
                return $this->isChanged;
            default:
                return parent::__get($name);
        }
    }
    /**
     * @param $value
     * @return Result $result
     */
    protected function validate($value) {
        $creatorResult = (new Dic)->get('adapter.Result');
        $errors = [];
        /** @var callable $auditor */
        foreach ($this->auditors as $auditor) {
            /** @var Result $result */
            $result = $auditor($value);
            if ($result->isValid) {
                $value = $result->value;
            } else {
                $errors = (new Dic)->get('function.array_merge')->call($errors, $result->errors);
            }
        }
        return $creatorResult->cast($value, $errors);
    }
    protected function setScheme(array $scheme) {
        $this->scheme = $scheme;
        $type = ucfirst($scheme['type']);
        $method = "cast{$type}";
        $this->$method();
        $this->addAuditors();
    }
    protected function addAuditors() {
        $scheme = $this->scheme;
        foreach ($scheme['auditors'] as $name => $auditor) {
            $this->auditors[$name] = (new Dic)->get("auditor.{$name}")->cast($auditor);
        }
    }
    protected function addCanBeEmpty() {
        $scheme = $this->scheme;
        $canBeEmpty = isset($scheme['canBeEmpty']) ? $scheme['canBeEmpty'] : true;
        $this->auditors['canBeEmpty'] = (new Dic)->get('validator.canBeEmpty')->cast($canBeEmpty);
    }
    protected function addInNotIn() {
        $this->addValidator('in');
        $this->addValidator('notIn');
    }
    protected function addValidator($name) {
        $scheme = $this->scheme;
        if (isset($scheme[$name])) {
            $this->auditors[$name] = (new Dic)->get("validator.{$name}")->cast($scheme[$name]);
        }
    }
    protected function addMutator($name) {
        $scheme = $this->scheme;
        if (isset($scheme[$name])) {
            $this->auditors[$name] = (new Dic)->get("mutator.{$name}")->cast($scheme[$name]);
        }
    }
    protected function castNumber() {
        $this->addCanBeEmpty();
        $this->addValidator('min');
        $this->addValidator('max');
        $this->addInNotIn();
    }
    protected function castBool() {
        $this->auditors['bool'] =(new Dic)->get('mutator.bool')->cast();
        $this->addCanBeEmpty();
    }
    protected function castFloat() {
        $this->auditors['float'] = (new Dic)->get('mutator.float')->cast();
        $this->castNumber();
    }
    protected function castInt() {
        $this->auditors['int'] = (new Dic)->get('mutator.int')->cast();
        $this->castNumber();
    }
    protected function castStr() {
        $this->auditors['str'] = (new Dic)->get('mutator.str')->cast();
        $this->addCanBeEmpty();
        $this->auditors['cutLen'] = (new Dic)->get('mutator.cutLen')->cast();
        $this->auditors['regexp'] = (new Dic)->get('validator.regexp')->cast();
        $this->auditors['maxLen'] = (new Dic)->get('validator.maxLen')->cast();
        $this->auditors['minLen'] = (new Dic)->get('validator.minLen')->cast();
    }
    protected function castDateTime() {
        $scheme = $this->scheme;
        $this->auditors['DateTime'] = (new Dic)->get('mutator.DateTime')->cast($scheme['format']);
        $this->addCanBeEmpty();
    }
}
