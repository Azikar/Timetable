<?php

namespace App\Interfaces;

interface dateCalculatorInterface{

    public function add_Week($date);
    public function sub_Week($date);
    public function add_Day($date);
}