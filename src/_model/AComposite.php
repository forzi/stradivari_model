<?php

namespace stradivari\model\model;

abstract class AComposite extends ABase implements \IteratorAggregate, \ArrayAccess
{
    protected $value;

    public function getIterator()
    {
        $iterator = function () {
            foreach ($this->value as $key => $val) {
                yield $key => $this[$key];
            }
        };
        return $iterator();
    }
}