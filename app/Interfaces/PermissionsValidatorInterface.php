<?php

namespace App\Interfaces;

interface PermissionsValidatorInterface{

    public function belongs_to_coordinator($coordinator_id, $subordinate_id);
}