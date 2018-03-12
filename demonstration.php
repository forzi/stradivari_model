<?php

include __DIR__ . "/vendor/autoload.php";

use stradivari\dic\Injection_Class;
use stradivari\dic\Injection_Value;
use stradivari\dic\Injection_Callable;
use stradivari\dic\Injection_Object;
use stradivari\dic\Injection_Pool;
use stradivari\dic\Injection_Singleton;

use stradivari\dic\Container;

class Dic extends Container {}

class A extends ArrayObject {}
$obj = new A;

$dicClass       = new Dic(Injection_Class::class);
$dicSingleton   = new Dic(Injection_Singleton::class);
$dicPool        = new Dic(Injection_Pool::class);
$dicObject      = new Dic(Injection_Object::class);
$dicValue       = new Dic(Injection_Value::class);
$dicCallable    = new Dic(Injection_Callable::class);

$dicClass
    ->set('class.ArrayObject', ArrayObject::class)
    ->set('class.DateTime', DateTime::class);

$dicSingleton
    ->set('singleton.ArrayObject', ArrayObject::class)
    ->set('singleton.DateTime', DateTime::class);

$dicPool
    ->set('pool.ArrayObject', ArrayObject::class)
    ->set('pool.DateTime', DateTime::class);

$dicObject
    ->set('object.ArrayObject', new ArrayObject)
    ->set('object.DateTime', new DateTime);

$dicCallable
    ->set('var_dump', 'var_dump')
    ->set('json_encode', function ($data) {
        try {
            return json_encode($data);
        } catch (\Exception $e) {
            logger()->exception($e);
        }
    });

$dicValue
    ->set('number', 100500)
    ->set('text', 'ololo');

(new Dic)->get('var_dump')->call('---------------------');

var_dump((new Dic)->get('text.value'));
var_dump((new Dic)->get('number.value'));
var_dump((new Dic)->get('json_encode')->call([1,2,3]));

(new Dic)->get('var_dump')->call('---------------------');
sleep(2);

var_dump((new Dic)->get('object.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('class.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('singleton.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('pool.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('singleton.DateTime')->cast('2001-01-01')->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('pool.DateTime')->cast('2001-01-01')->format("Y-m-d H:i:s"));

(new Dic)->get('var_dump')->call('---------------------');
sleep(2);

var_dump((new Dic)->get('object.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('class.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('singleton.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('pool.DateTime')->cast()->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('singleton.DateTime')->cast('2001-01-01')->format("Y-m-d H:i:s"));
var_dump((new Dic)->get('pool.DateTime')->cast('2001-01-01')->format("Y-m-d H:i:s"));

(new Dic)->get('var_dump')->call('---------------------');
var_dump((new Dic)->get('pool.ArrayObject')->isSubclassOfInjection(IteratorAggregate::class));
var_dump((new Dic)->get('pool.ArrayObject')->isInjectionSubclassOf($obj));
var_dump((new Dic)->get('pool.DateTime')->staticCallable('createFromFormat')->call('U', 0));
