<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

abstract class ABase {
    protected $type;
    protected $description;
    protected $parent;
    protected $auditors = [];
    protected $canBeEmpty = true;
    protected $isOptional;
    protected $default;

    public function __construct(array $field) {
        $this->isOptional = isset($field['default']);
        if ($this->isOptional) {
            $this->default = $field['default'];
        }
        $this->type = $field['type'];
        $this->description = isset($field['description']) ? (string)$field['description'] : null;
        $canBeEmpty = isset($field['canBeEmpty']) ? $field['canBeEmpty'] : $this->canBeEmpty;
        if (!$canBeEmpty) {
            $this->auditors['canBeEmpty'] = (new Dic)->get('validator.canBeEmpty')->cast($canBeEmpty);
        }
    }

    public function addAuditor($name, $field) {
        if (!isset($field[$name])) {
            return $this;
        }
        $constructor = (new Dic)->get("validator.{$name}") ?: (new Dic)->get("mutator.{$name}");
        $this->auditors[$name] = $constructor->cast($field[$name]);
        return $this;
    }

    /**
     * @param $value
     * @return Result $result
     */
    public function validate($value) {
        $constructorResult = (new Dic)->get('adapter.Result');
        if ($value === null) {
            if (!$this->isOptional) {
                $message = (new Dic)->get('validator.tpl.canBeOptional.value');
                return $constructorResult->cast(null, [$message]);
            }
            if ($this->default === null) {
                return $constructorResult->cast(null);
            }
            $value = $this->default;
        }
        $errors = [];
        /** @var callable $auditor */
        foreach ($this->auditors as $auditor) {
            /** @var Result $result */
            $result = $auditor($value);
            var_dump($result);
            if ($result->isValid) {
                $value = $result->value;
            } else {
                $errors = (new Dic)->get('function.array_merge')->call($errors, $result->errors);
            }
        }
        return $constructorResult->cast($value, $errors);
    }
}
