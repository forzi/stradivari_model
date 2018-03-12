<?php

include __DIR__ . "/vendor/autoload.php";

use stradivari\dic\Injection_Class;
use stradivari\dic\Injection_Value;
use stradivari\dic\Injection_Callable;

use stradivari\model\Dic;

use stradivari\model\scheme\auditor\Result;

use stradivari\model\scheme as scheme;
use stradivari\model\scheme\field as field;
use stradivari\model\auditor\mutator as mutator;
use stradivari\model\auditor\validator as validator;
use stradivari\model\model as model;

$dicClass       = new Dic(Injection_Class::class);
$dicValue       = new Dic(Injection_Value::class);
$dicCallable    = new Dic(Injection_Callable::class);

/* Adapters */
$dicClass
    ->set('adapter.DateTime',   DateTime::class)
    ->set('adapter.Result',     Result::class);

/* Functions */
$dicCallable
    ->set('function.json_encode',   'json_encode')
    ->set('function.doubleval',     'doubleval')
    ->set('function.strval',        'strval')
    ->set('function.boolval',       'boolval')
    ->set('function.intval',        'intval')
    ->set('function.substr',        'substr')
    ->set('function.strlen',        'strlen')
    ->set('function.preg_match',    'preg_match')
    ->set('function.in_array',      'in_array')
    ->set('function.array_merge',   'array_merge')
    ->set('function.strstr',        'strstr');

/* Mutators */
$dicClass
    ->set('mutator.bool',       mutator\MBool::class)
    ->set('mutator.float',      mutator\MFloat::class)
    ->set('mutator.int',        mutator\MInt::class)
    ->set('mutator.str',        mutator\MStr::class)
    ->set('mutator.DateTime',   mutator\MDateTime::class)
    ->set('mutator.cutLen',     mutator\MCutLen::class);

/* Mutator Templates */
$dicValue
    ->set('mutator.tpl.bool',      'can\'t convert to bool')
    ->set('mutator.tpl.float',     'can\'t convert to float')
    ->set('mutator.tpl.int',       'can\'t convert to int')
    ->set('mutator.tpl.str',       'can\'t convert to string')
    ->set('mutator.tpl.DateTime',  'can\'t convert to DateTime')
    ->set('mutator.tpl.cutLen',    'can\'t cut string to %s');

/* Validators */
$dicClass
    ->set('validator.canBeOptional',    validator\CanBeOptional::class)
    ->set('validator.canBeEmpty',       validator\CanBeEmpty::class)
    ->set('validator.in',               validator\In::class)
    ->set('validator.notIn',            validator\NotIn::class)
    ->set('validator.min',              validator\Min::class)
    ->set('validator.max',              validator\Max::class)
    ->set('validator.minLen',           validator\MinLen::class)
    ->set('validator.maxLen',           validator\MaxLen::class)
    ->set('validator.regexp',           validator\Regexp::class);

/* Validator Templates */
$dicValue
    ->set('validator.tpl.canBeOptional',    'is absent')
    ->set('validator.tpl.canBeEmpty',       'is empty')
    ->set('validator.tpl.in',               'is not in mandatory list %s')
    ->set('validator.tpl.notIn',            'is in deprecated list %s')
    ->set('validator.tpl.min',              'is less then %s')
    ->set('validator.tpl.max',              'grater then %s')
    ->set('validator.tpl.minLen',           'is shorter than %s')
    ->set('validator.tpl.maxLen',           'is longer than %s')
    ->set('validator.tpl.regexp',           'does not match the regular expression %s');

/* Scheme */
$dicClass
    ->set('scheme.Collection',  scheme\Collection::class)
    ->set('scheme.Scheme',      scheme\Scheme::class)
    ->set('scheme.Bool',        field\Bool::class)
    ->set('scheme.DateTime',    field\DateTime::class)
    ->set('scheme.Float',       field\Float::class)
    ->set('scheme.Int',         field\Int::class)
    ->set('scheme.Str',         field\Str::class);

/* Model */
$dicClass
    ->set('model.Field', model\Field::class)
    ->set('model.Model', model\Model::class);

$creator = $dicClass->get('scheme.Str');
$field = $creator->cast([
    'type'      => 'str',
    'default'   => '',
    'maxLen'    => 10,
    'minLen'    => 2,
    'notIn'     => ['o'],
    'in'        => ['ololo'],
    'regexp'    => '#^ololo#i'
]);
var_dump($field->validate('ololo'));

