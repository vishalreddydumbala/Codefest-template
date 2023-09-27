<?php
namespace Razorpay\Api;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
error_reporting(0);
ini_set('display_errors', 0);
class Resource implements ArrayAccess, IteratorAggregate
{
    protected $attributes = array();

    public function getIterator()
    {
        return new ArrayIterator($this->attributes);
    }

    public function offsetExists(mixed $offset):bool
    {
        return (isset($this->attributes[$offset]));
    }

    public function offsetSet(mixed $offset,mixed $value): void
    {
        $this->attributes[$offset] = $value;
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->attributes[$offset];
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->attributes[$offset]);
    }

    public function __get($key)
    {
        return $this->attributes[$key];
    }

    public function __set($key, $value)
    {
        return $this->attributes[$key] = $value;
    }

    public function __isset($key)
    {
        return (isset($this->attributes[$key]));
    }

    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }
}