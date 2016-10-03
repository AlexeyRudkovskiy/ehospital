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
        if (in_array($key, $this->encrypted ?? [])) {
            try {
                $value = auth()->user()->getEncrypter()->decrypt($this->attributes[$key]);
            } catch (\Exception $e) {
                throw new \Exception("Can't decrypt data");
            }
        } else {
            $value = $this->getAttribute($key);
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