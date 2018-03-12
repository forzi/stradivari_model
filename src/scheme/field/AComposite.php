<?php

namespace stradivari\model\scheme\field;

use stradivari\model\Dic;
use stradivari\model\scheme\Collection;

abstract class AComposite extends ABase {
    protected function castField(array $field) {
        $type = $field['type'];
        if (strtolower(strstr($type, '__collection'))) {
            /** @var Collection $collection */
            $collection = (new Dic)->get('scheme.Collection')->cast($field);
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
        $constructorField = (new Dic)->get('scheme.' . $type);
        $obj = $constructorField->cast($field);
        $obj->parent = $this;
        return $obj;
    }
    public static function castByClassName($name, $field = []) {
        $constructorScheme = (new Dic)->get('scheme.' . $name);
        if (!$constructorScheme) {
            return null;
        }
        if (!$constructorScheme->isSubclassOf(self::class)) {
            return null;
        }
        return $constructorScheme->cast($field);
    }
}
