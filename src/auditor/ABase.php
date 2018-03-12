<?php

namespace stradivari\model\scheme\auditor;

use stradivari\dic\Injection_Callable;
use stradivari\model\Dic;

/**
 * Class ABase
 *
 * @property mix $verificator
 * @property string $messageName
 */
abstract class ABase {
    protected $verificator;

    public function __construct($verificator = null) {
        $this->verificator = $verificator;
    }

    abstract public function __invoke($value);

    protected function mutate($value, Injection_Callable $creatorMutator) {
        $creatorResult = (new Dic)->get('adapter.Result');
        try {
            $value = $creatorMutator->call($value);
            return $creatorResult->cast($value);
        } catch (\Throwable $e) {
            return $creatorResult->cast(null, [$this->getMessage(), $e->getMessage()]);
        }
    }

    protected function getMessage() {
        $message = (new Dic)->get($this->messageName)->get();
        return sprintf($message, (new Dic)->get('function.json_encode')->call($this->verificator));
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return parent::__get($name);
    }
}
