<?php

namespace Package\Model\Scheme;

/*
 * name
 * description
 * fields
 *     type
 *     canBeEmpty (true by default)
 *     defaultValue (optional | field is optional if set)
 *
 */
class Scheme extends Field\AComposite implements \IteratorAggregate
{
    protected $fields = [];
    protected $canBeEmpty = false;

    public static function cast(array $scheme)
    {
        return new self($scheme);
    }
    public function __construct(array $scheme)
    {
        parent::__construct($scheme);
        foreach ($scheme as $name => $field) {
            $this->fields[$name] = $this->castField($field);
        }
    }
    public function __get($key)
    {
        return $this->fields[$key];
    }
    public function getIterator()
    {
        $iterator = function () {
            foreach ($this->fields as $key => $val) {
                yield $key => $val;
            }
        };
        return $iterator();
    }
}
