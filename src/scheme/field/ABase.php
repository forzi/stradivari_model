<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;

abstract class ABase
{
    protected $type;
    protected $description;
    protected $parent;
    protected $auditors = [];
    protected $canBeEmpty = true;

    public function __construct(array $field)
    {
        $this->type = $field['type'];
        $this->description = isset($field['description']) ? (string)$field['description'] : null;
        $canBeEmpty = isset($field['canBeEmpty']) ? $field['canBeEmpty'] : $this->canBeEmpty;
        if (!$canBeEmpty) {
            $this->auditors['canBeEmpty'] = (new Dic)->get('validator.canBeEmpty')->cast($canBeEmpty);
        }
    }

    public function addAuditor($name, $field)
    {
        if (!isset($field[$name])) {
            return $this;
        }
        $constructor = (new Dic)->get("validator.{$name}") ?: (new Dic)->get("mutator.{$name}");
        $this->auditors[$name] = $constructor->cast($field[$name]);
        return $this;
    }
}
