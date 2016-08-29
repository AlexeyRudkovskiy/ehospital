<?php

namespace App\Traits;

/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 28.07.16
 * Time: 12:35
 */
trait EncryptionTrait
{

    public function __get($key)
    {
        $value = $this->getAttribute($key);
        if (in_array($key, $this->encrypted ?? [])) {
            $value = \Crypt::decrypt($value);
        }
        return $value;
    }

    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
        if (in_array($key, $this->encrypted ?? [])) {
            $this->attributes[$key] = \Crypt::encrypt($this->attributes[$key]);
        }
        return $this;
    }

}