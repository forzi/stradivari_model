<?php

namespace stradivari\model\scheme\field;

use Package\Model\ClassMap;
use Package\Model\Scheme\Validator\Str as ValidatorStr;
use Package\Model\Scheme\Validator\Regexp as ValidatorStrRegexp;
use Package\Model\Scheme\Validator\MaxLen as ValidatorStrMaxLen;
use Package\Model\Scheme\Validator\MinLen as ValidatorStrMinLen;
use Package\Model\Scheme\Validator\CutLen as ValidatorStrCutLen;

class Str extends APrimitive
{

    public function __construct(array $field) {
        $this->auditors['str'] = ClassMap::cast('mutator.str');
        parent::__construct($field);
        $this->addAuditor('regexp', $field);
        if (isset($field['cutLen'])) {
            $this->auditors['cutLen'] = ClassMap::cast('mutator.cutLen', [$field['cutLen']]);
        }
        $this->addAuditor('maxLen', $field);
        $this->addAuditor('minLen', $field);
    }
}
