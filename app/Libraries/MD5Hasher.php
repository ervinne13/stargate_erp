<?php

namespace App\Libraries;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MD5Hasher
 *
 * @author Ervinne Sodusta
 */
class MD5Hasher implements Hasher {

    public function check($value, $hashedValue, array $options = array()) {
        return $this->make($value) === $hashedValue;
    }

    public function make($value, array $options = array()) {

        Crypt::setKey('gregster!@#123');
        $hashedValue = md5($value . '123!@#');

        Log::info("Using custom hasher: {$hashedValue}");
//        return hash('md5', $value . '123!@#');

        return $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = array()) {
        return false;
    }

}
