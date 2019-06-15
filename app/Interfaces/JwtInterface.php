<?php

namespace App\Interfaces;

interface JwtInterface{

    public function createJwt($user);

    public function validateJwt($token);

    public function getPayload($token);

    public function validateTime($token);
}
