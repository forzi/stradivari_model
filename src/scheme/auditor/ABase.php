<?php

namespace stradivari\model\scheme\auditor;

use stradivari\model\Dic_Scheme;

/**
 * Class ABase
 *
 * @property mix $verificator
 * @property string $message
 */
abstract class ABase
{
    protected $verificator;

    public function __construct($verificator)
    {
        $this->verificator = $verificator;
    }

    abstract public function __invoke($value);

    protected function getMessage()
    {
        return sprintf($this->message, (new Dic_Scheme)->get('adapter.json_encode')->call([$this->verificator]));
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return parent::__get($name);
    }
}
