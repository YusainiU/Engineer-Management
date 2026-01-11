<?php

namespace Simplydigital\EngineerManagement\Livewire;

use Simplydigital\EngineerManagement\Models\EngineerCertifications;
use Simplydigital\EngineerManagement\Models\EngineerManagement;
use LivewireUI\Modal\ModalComponent;

class AddUpdateEngineerCertificateModalComponent extends ModalComponent
{

    public $engineerId;
    public $engineer;
    public $engineerCertificateId = null;
    public $expiryDate = null;
    public $expired = false;
    public $active = true;

    public $modalMode='closedAndRefresh'; // 'add' or 'update'
    public $modalTitle='Engineer Certificates';
    public $modalSave = 'save';
    public $certificates;
    public $engineerCertificate;
    public $allCertificates;
    public $displayList = true;

    public function rules()
    {
        return [
            'certificateId' => 'required|integer',
            'engineerId' => 'required|integer',
            'active' => 'boolean',
            'expired' => 'boolean',
            'expiryDate' => 'nullable|date',
        ];
    }

    public function maxWidth(): string
    {           
        // Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
        return '6xl';
    }

    public function mount()
    {
        $this->initialise();        
    }

    public function initialise()
    {
        $this->engineer = $this->getEngineer();
        $this->certificates = $this->engineer->certifications;
        $this->allCertificates = $this->getAllActiveCertificates();
        if($this->engineerCertificateId)
        {
            $this->engineerCertificate = $this->getEngineerCertificate();

        }
    }

    public function getEngineerCertificate()
    {
        return EngineerCertifications::find($this->engineerCertificateId);
    }
    
    public function getEngineer()
    {
        return EngineerManagement::find($this->engineerId);
    }

    public function getAllActiveCertificates()
    {
        return EngineerCertifications::where('active', true)->get();
    }

    public function update()
    {
        $this->validate();
        $input = [
            'engineer_id' => $this->engineerId,
            'certificate_id' => $this->certificateId,
            'expiry_date' => $this->expiryDate,
            'expired' => $this->expired,
        ];
        $this->engineerCertificate->update($input);
        session()->flash('message', 'Engineer Certificate updated successfully.');
        $this->resertForm();
        $this->closedAndRefresh();
    }

    public function save()
    {
        $this->validate();
        $input = [
            'engineer_id' => $this->engineerId,
            'certificate_id' => $this->certificateId,
            'expiry_date' => $this->expiryDate,
            'expired' => $this->expired,
            'active' => $this->active,
        ];
        EngineerCertifications::create($input);
        session()->flash('message', 'Engineer Certificate added successfully.');
        $this->resertForm();
        $this->closedAndRefresh();
    }   

    public function closedAndRefresh()
    {
        $this->closeModal();
    }

    public function resertForm()
    {
        $this->engineerCertificateId = null;
        $this->expiryDate = null;
        $this->expired = false;
        $this->active = true;
    }

    public function createNewCertificate()
    {
        $this->modalSave = 'save';
        $this->displayList = false; 
    }

    public function updateCertificate($certificateId)
    {
        $this->engineerCertificateId = $certificateId;
        $this->engineerCertificate = $this->getEngineerCertificate();
        $this->displayList = false;    
    }

    public function backToList()
    {
        $this->displayList = true;
    }
    
    public function render()
    {
        return view('engineermanagement::livewire.add-update-engineer-certificate-modal-component');
    }

}
    