<?php

namespace Simplydigital\EngineerManagement\Livewire;

use LivewireUI\Modal\ModalComponent;
use Simplydigital\EngineerManagement\Models\EngineerSkills;
use Simplydigital\EngineerManagement\Models\EngineerManagement;

class AddUpdateEngineerSkillsModalComponent extends ModalComponent
{

    public $engineerId;
    public $engineerSkills;
    public $engineer;
    public $modalMode='update'; // 'add' or 'update'
    public $modalTitle='Engineer Skills';
    public $modalSave = 'save';

    public static function maxWidth(): string
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
        $this->engineerSkills = $this->engineer->skills;
    }   

    public function getEngineer()
    {
        // Logic to retrieve engineer based on $engineerId
        return EngineerManagement::find($this->engineerId);
    }

    public function retrieveEngineerSkills()
    {
        // Logic to retrieve engineer skills based on $engineerId
        $skills = EngineerSkills::where('engineer_id', $this->engineerId)->get();
        return $skills;
    }

    public function update()
    {
        $this->closedAndRefresh();
    }

    public function save()
    {        
        $this->closedAndRefresh();
    }

    public function closedAndRefresh()
    {
        $this->closeModal();
    }
        
    public function render()
    {
        return view('engineermanagement::livewire.add-update-engineer-skills-modal-component');
    }
}