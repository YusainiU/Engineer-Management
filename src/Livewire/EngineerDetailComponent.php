<?php

Namespace Simplydigital\EngineerManagement\Livewire;

use Livewire\Component;
use Simplydigital\EngineerManagement\Models\EngineerManagement;

Class EngineerDetailComponent extends Component
{
    public $engineerId;
    public $engineer;
    public $engSkills;
    public $engCertifications;

    public function mount($engineerId)
    {
        $this->engineerId = $engineerId;
        $this->engineer = $this->getEngineerDetail();
        $this->engSkills = $this->getEngineerSkills();
        $this->engCertifications = $this->getEngineerCertifications();   
    }


    public function getEngineerDetail()
    {
        return EngineerManagement::find($this->engineerId);
    }   

     public function getEngineerSkills()
    {
        return EngineerManagement::where('id', $this->engineerId)
            ->with('skills')
            ->whereHas('skills', function ($query) {
                $query->where('active', true);
            })
            ->get()->first()->skills;
    }

    public function getEngineerCertifications()
    {
        return EngineerManagement::where('id', $this->engineerId)
            ->with('certifications')
            ->whereHas('certifications', function ($query) {
                $query->where('active', true);
            })
            ->get()->first()->certifications;
    }   

    public function render()
    {
        return view('engineermanagement::livewire.engineer-detail-component');
    }

}
