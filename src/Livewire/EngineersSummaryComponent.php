<?php

namespace Simplydigital\EngineerManagement\Livewire;

use Livewire\Component;
use PSpell\Config;
use Simplydigital\EngineerManagement\Models\EngineerManagement;

class EngineersSummaryComponent extends Component
{

    public $engineerId;
    public $skillId;
    public $engineers;
    public $skills;

    public function mount()
    {
        $this->engineers = $this->getAllActiveEngineers();
        $this->skills = config('engineer-management.skill_levels');
    }

    public function getAllActiveEngineers()
    {
        return EngineerManagement::where('active', true)->get();
    }

    public function render()
    {
        return view('engineermanagement::livewire.engineers-summary-component');
    }   

}


