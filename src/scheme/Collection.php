<?php

namespace Package\Model\Scheme;

class Collection extends Field\AComposite
{
    protected $scheme;

    public function __construct(array $field)
    {
        parent::__construct($field);
        $field['type'] = strstr($field['type'], '__collection', true);
        $this->field = $this->castField($field);
    }
    public function __get($key)
    {
        if ($key == 'scheme') {
            return $this->scheme;
        }
    }
}
