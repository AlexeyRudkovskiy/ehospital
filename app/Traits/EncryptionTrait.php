<?php

namespace App\Traits;
use League\Flysystem\Exception;

/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 28.07.16
 * Time: 12:35
 */
trait EncryptionTrait
{

    /**
     * @var \Illuminate\Encryption\Encrypter
     */
    protected $encrypter = null;

    public function __get($key)
    {
        $value = $this->getAttribute($key);
        if (in_array($key, $this->encrypted ?? [])) {
            $value = auth()->user()->getEncrypter()->decrypt($value);
        }
        return $value;
    }

    public function __set($key, $value)
    {
        if (in_array($key, $this->encrypted ?? [])) {
            $this->attributes[$key] = auth()->user()->getEncrypter()->encrypt($value);
        } else {
            $this->setAttribute($key, $value);
        }
        return $this;
    }

    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;
    }

}