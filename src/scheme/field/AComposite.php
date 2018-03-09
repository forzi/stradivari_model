<?php

namespace stradivari\model\scheme\field;

use Package\Model\ClassMap;
use Package\Model\Scheme\Collection;

abstract class AComposite extends ABase
{
    protected function castField(array $field)
    {
        $type = $field['type'];
        if (strtolower(strstr($type, '__collection'))) {
            /** @var Collection $collection */
            $collection = ClassMap::cast('scheme.Collection', [$field]);
            $collection->parent = $this;
            return $collection;
        }
        $scheme = static::castByClassName($type, $field);
        if ($scheme) {
            $scheme->parent = $this;
            return $scheme;
        }
        $type = ucfirst(strtolower($type));
        /** @var ABase $obj */
        $obj = ClassMap::cast('scheme.' . $type, [$field]);
        $obj->parent = $this;
        return $field;
    }
    public static function castByClassName($name, $field = [])
    {
        $scheme = ClassMap::cast('scheme.' . $name, [$field]);
        if (!$scheme) {
            return null;
        }
        if (!($scheme instanceof self)) {
            return null;
        }
        return $scheme;
    }
}
