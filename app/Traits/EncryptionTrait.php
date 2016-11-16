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
        if (!in_array($key, $this->encrypted)) {
            return $this->getAttribute($key);
        }

        if (method_exists($this, 'granted')) {
            if (!$this->granted()) {
                abort(403);
            }
        }

        try {
            $var = $this->attributes[$key];
            $encrypter = null;
            if (method_exists($this, 'getEncrypter')) {
                $encrypter = $this->getEncrypter();
            } else {
                $encrypter = auth()->user()->getEncrypter();
            }
            $value = $encrypter->decrypt($var);
        } catch (\Exception $e) {
            throw new \Exception("Can't decrypt data");
        }
        return $value;
    }

    public function __set($key, $value)
    {
        if (!in_array($key, $this->encrypted)) {
            return $this->setAttribute($key, $value);
        }

        if (method_exists($this, 'granted')) {
            if (!$this->granted()) {
                abort(403);
            }
        }

        $encrypter = null;
        if (method_exists($this, 'getEncrypter')) {
            $encrypter = $this->getEncrypter();
        } else {
            $encrypter = auth()->user()->getEncrypter();
        }
        $this->attributes[$key] = $encrypter->encrypt($value);
        return $this;
    }

    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;
    }

    public function encrypt($attributes = null)
    {
        $canBeEncrypted = $this->encrypted;
        if ($attributes !== null && is_array($attributes)) {
            $attributes = collect($attributes);
        }
        foreach ($canBeEncrypted as $item) {
            if ($attributes != null && $attributes->count() > 0) {
                if ($attributes->contains($item)) {
                    $val = $this->attributes[$item];
                    $this->{$item} = $val;
                }
            } else {
                $val = $this->attributes[$item];
                $this->{$item} = $val;
            }
        }
    }

}