<?php

namespace stradivari\model\scheme;

use stradivari\model\Dic;

class Collection extends field\AComposite {
    protected $scheme;

    public function __construct(array $scheme) {
        parent::__construct($scheme);
        $field['type'] = (new Dic)->get('function.strstr')->call($scheme['type'], '__collection', true);
        $this->scheme = $this->castField($scheme);
    }
    public function __get($key) {
        if ($key == 'scheme') {
            return $this->scheme;
        }
    }
}
