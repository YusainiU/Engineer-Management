<?php

namespace Simplydigital\EngineerManagement\Provider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Simplydigital\EngineerManagement\Http\Components\BladeEngineerManagementComponent;
use Simplydigital\EngineerManagement\Http\Components\BladeSkillComponent;
use Simplydigital\EngineerManagement\Livewire\AddUpdateEngineerModalComponent;
use Simplydigital\EngineerManagement\Livewire\AddUpdateSkillModalComponent;
use Simplydigital\EngineerManagement\Livewire\SkillsComponent;
use Simplydigital\EngineerManagement\Livewire\EngineerManagementComponent;
use Simplydigital\EngineerManagement\Livewire\AddUpdateEngineerSkillsModalComponent;

class EngineerManagementServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any package services.
    * @return void  
    */
    public function boot()
    {
        //Load views
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'engineermanagement');

        $this->loadViewComponentsAs('engineermanagement-ui',[\Simplydigital\EngineerManagement\View\Components\Icon::class]);

        //Publish migrations
        $this->publishes([
            __DIR__ . '/../Database/migrations/create_engineer_management_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_engineer_management_table.php'),
            __DIR__ . '/../Database/migrations/create_skills_table.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 1) . '_create_skills_table.php'),
            __DIR__ . '/../Database/migrations/create_engineer_skills_table.stub' => database_path('migrations/' . date('Y_m_d_His', time() + 2) . '_create_engineer_skills_table.php'),            
        ], 'engineer-management-migrations');
        
        //Publis config
        $this->publishes([
            __DIR__ . '/../Config/engineer-management.stub' => config_path('engineer-management.php'),
        ], 'engineer-management-config');

        $this->publishes([
            __DIR__.'/../Resources/icons' => resource_path('Simplydigital/EngineerManagement/icons')
        ], 'simplydigital-resources');

        //Publish routes if exists
        if (file_exists(__DIR__ . '/../Routes/web.php')) {
            $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        }
        
        //Register Livewire components
        Livewire::component('engineermanagement-component', EngineerManagementComponent::class);

        //Register Livewire AddUopdateEngineerModalComponent
        Livewire::component('addupdateengineermodal-component', AddUpdateEngineerModalComponent::class);

        //Register Livewire AddUpdateSkillModalComponent
        Livewire::component('addupdateskillmodal-component', AddUpdateSkillModalComponent::class);

        //Register Livewire SkillsComponent
        Livewire::component('skills-component', SkillsComponent::class);

        //Register Blade directive for Engineer Management Component
        Blade::component('blade-engineermanagement', BladeEngineerManagementComponent::class);
        
        //Register Blade directive for Skill Component
        Blade::component('blade-skill', BladeSkillComponent::class);

        //Register livewire AddUpdateEngineerSkillsModalComponent
        Livewire::component('addupdateengineerskillsmodal-component', AddUpdateEngineerSkillsModalComponent::class);
     
    }

    public function register(): void
    {
        
    }    

}