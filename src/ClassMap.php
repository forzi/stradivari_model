<?php

namespace Package\Model;

use Carbon\Carbon;

use Package\Model\Scheme\Collection     as Scheme_Collection;
use Package\Model\Scheme\Field\Bool     as Scheme_Bool;
use Package\Model\Scheme\Field\DateTime as Scheme_DateTime;
use Package\Model\Scheme\Field\Float    as Scheme_Float;
use Package\Model\Scheme\Field\Int      as Scheme_Int;
use Package\Model\Scheme\Field\Str      as Scheme_Str;

use Package\Model\Scheme\Validator\Bool     as Mutator_Bool;
use Package\Model\Scheme\Validator\CutLen   as Mutator_CutLen;
use Package\Model\Scheme\Validator\DateTime as Mutator_DateTime;
use Package\Model\Scheme\Validator\Float    as Mutator_Float;
use Package\Model\Scheme\Validator\Int      as Mutator_Int;
use Package\Model\Scheme\Validator\Str      as Mutator_Str;

use Package\Model\Scheme\Validator\CanBeEmpty   as Validator_CanBeEmpty;
use Package\Model\Scheme\Validator\In           as Validator_In;
use Package\Model\Scheme\Validator\Max          as Validator_Max;
use Package\Model\Scheme\Validator\MaxLen       as Validator_MaxLen;
use Package\Model\Scheme\Validator\Min          as Validator_Min;
use Package\Model\Scheme\Validator\MinLen       as Validator_MinLen;
use Package\Model\Scheme\Validator\NotIn        as Validator_NotIn;
use Package\Model\Scheme\Validator\Regexp       as Validator_Regexp;

class ClassMap
{
    protected static $map = [
        'adapter.DateTime' => Carbon::class,

        'validator.canBeEmpty'  => Validator_CanBeEmpty::class,
        'validator.in'          => Validator_In::class,
        'validator.notIn'       => Validator_NotIn::class,
        'validator.min'         => Validator_Min::class,
        'validator.max'         => Validator_Max::class,
        'validator.minLen'      => Validator_MinLen::class,
        'validator.maxLen'      => Validator_MaxLen::class,
        'validator.regexp'      => Validator_Regexp::class,

        'mutator.bool'          => Mutator_Bool::class,
        'mutator.float'         => Mutator_Float::class,
        'mutator.int'           => Mutator_Int::class,
        'mutator.str'           => Mutator_Str::class,
        'mutator.cutLen'        => Mutator_CutLen::class,
        'mutator.DateTime'      => Mutator_DateTime::class,

        'scheme.Collection' => Scheme_Collection::class,
        'scheme.bool'       => Scheme_Bool::class,
        'scheme.float'      => Scheme_Float::class,
        'scheme.int'        => Scheme_Int::class,
        'scheme.str'        => Scheme_Str::class,
        'scheme.DateTime'   => Scheme_DateTime::class
    ];

    public static function cast($name, array $params = [])
    {
        $instanceType = static::map($name) ?: $name;
        if (!class_exists($instanceType)) {
            return null;
        }
        $reflector = new \ReflectionClass($instanceType);
        return $reflector->newInstanceArgs($params);
    }

    public static function map($name)
    {
        return isset(static::$map[$name]) ? static::$map[$name] : null;
    }
}
