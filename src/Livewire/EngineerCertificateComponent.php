<?php

Namespace Simplydigital\EngineerManagement\Livewire;

use Livewire\Component;
use Simplydigital\EngineerManagement\Models\Certificates;
use Simplydigital\EngineerManagement\Models\EngineerCertifications;
use Livewire\Attributes\On;

class EngineerCertificateComponent extends Component
{

    public $certificateId;
    public $engineerCertificateId;
    public $engineers;
    public $certificate;
    public $openCertificateModal = false;

    public function mount()
    {
        $this->initialise();
    }

    public function initialise()
    {
        $this->engineers = $this->getEngineersWithCertificate();
        $this->certificate = $this->getCertificate();
    }

    public function getEngineersWithCertificate()
    {
        return EngineerCertifications::where('certificate_id', '=',$this->certificateId)->get(); 
    }

    public function getCertificate()
    {
        return Certificates::find($this->certificateId);
    }

    public function closeComponent()
    {
        $this->dispatch('closeEngineerSummaryComponent');
    }    

    public function render()
    {
        return view('engineermanagement::livewire.engineer-certificate-component');
    }

}