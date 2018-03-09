<?php

use stradivari\dic\OrdinaryInjection;
use stradivari\dic\CallableInjection;

use stradivari\model\Dic_Scheme;
use stradivari\model\Dic_Adapter;
use stradivari\model\Dic_Mutator;
use stradivari\model\Dic_Validator;

use stradivari\model\scheme as scheme;
use stradivari\model\scheme\field as field;
use stradivari\model\scheme\auditor\mutator as mutator;
use stradivari\model\scheme\auditor\validator as validator;

/* adapters */
(new Dic_Adapter)
    ->set('json_encode',    new CallableInjection('json_encode'))
    ->set('DateTime',       new OrdinaryInjection(DateTime::class));

/* mutators */
(new Dic_Mutator)
    ->set('bool',       new OrdinaryInjection(mutator\Bool::class))
    ->set('float',      new OrdinaryInjection(mutator\Float::class))
    ->set('int',        new OrdinaryInjection(mutator\Int::class))
    ->set('str',        new OrdinaryInjection(mutator\Str::class))
    ->set('DateTime',   new OrdinaryInjection(mutator\DateTime::class))
    ->set('cutLen',     new OrdinaryInjection(mutator\CutLen::class));

/* validators */
(new Dic_Validator)
    ->set('canBeEmpty', new OrdinaryInjection(validator\CanBeEmpty::class))
    ->set('in',         new OrdinaryInjection(validator\In::class))
    ->set('notIn',      new OrdinaryInjection(validator\NotIn::class))
    ->set('min',        new OrdinaryInjection(validator\Min::class))
    ->set('max',        new OrdinaryInjection(validator\Max::class))
    ->set('minLen',     new OrdinaryInjection(validator\MinLen::class))
    ->set('maxLen',     new OrdinaryInjection(validator\MaxLen::class))
    ->set('regexp',     new OrdinaryInjection(validator\Regexp::class));

/* Dic_Scheme */
(new Dic_Scheme)
    ->set('adapter',    new Dic_Adapter)
    ->set('mutator',    new Dic_Mutator)
    ->set('validator',  new Dic_Validator);
