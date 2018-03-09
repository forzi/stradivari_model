<?php

namespace stradivari\model\scheme\field;

use Package\Model\Scheme\Validator\Result;

abstract class APrimitive extends ABase
{
    protected $scheme;
    protected $isOptional;
    protected $default;

    public function __construct(array $field)
    {
        $this->isOptional = isset($field['default']);
        if ($this->isOptional) {
            $this->default = $field['default'];
        }
        $this->scheme = $field;
        parent::__construct($field);
        $this->addAuditor('in', $field);
        $this->addAuditor('notIn', $field);
    }

    /**
     * @param $value
     * @return Result $result
     */
    public function validate($value)
    {
        $value = ($value === null && $this->isOptional) ? $this->default : $value;
        $errors = [];
        /** @var callable $validator */
        foreach ($this->auditors as $validator) {
            /** @var Result $result */
            $result = $validator($value);
            if ($result->isValid) {
                $value = $result->value;
            } else {
                $errors = array_merge($result->errors);
            }
        }
        return new Result($value, $errors);
    }

}
