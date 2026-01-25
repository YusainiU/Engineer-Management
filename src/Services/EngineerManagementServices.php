<?php

Namespace Simplydigital\EngineerManagement\Services;

use Simplydigital\EngineerManagement\Models\EngineerManagement;
use Simplydigital\EngineerManagement\Models\EngineerCertifications;
use Simplydigital\EngineerManagement\Models\Skills;
use Simplydigital\EngineerManagement\Models\Certificates;

class EngineerManagementServices
{
    // Service class for Engineer Management functionalities
    public function getAllEngineers()
    {
        return EngineerManagement::all();
    }

    public function getAllCertificates()
    {
        return Certificates::all();
    }

    public function getAllSkills()
    {
        return Skills::all();
    }

}