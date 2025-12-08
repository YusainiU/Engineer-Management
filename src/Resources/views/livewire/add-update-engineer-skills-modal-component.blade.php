@php
    $tdClass = Config::get('engineer-management.tableClasses.td');
    $thClass = Config::get('engineer-management.tableClasses.th');
    $trThClass = Config::get('engineer-management.tableClasses.colTr');
    $divTopClass = Config::get('engineer-management.tableClasses.divTop');
    $divSeparator = Config::get('engineer-management.tableClasses.divSeparator');
    $tdActionLink = Config::get('engineer-management.buttonClasses.btnGrey');
    $tdActionLinkDelete = Config::get('engineer-management.buttonClasses.btnRed');
    $table = Config::get('engineer-management.tableClasses.table');

    $inputNormal = Config::get('engineer-management.formClasses.input-normal');
    $inputError = Config::get('engineer-management.formClasses.input-error');
    $inputLabel = Config::get('engineer-management.formClasses.label');
    $checkboxLabel = Config::get('engineer-management.formClasses.checkboxLabel');
    $checkbox = Config::get('engineer-management.formClasses.checkbox');
    $errorMessage = Config::get('engineer-management.formClasses.error-message');
@endphp

<div class="{{ $divTopClass }}">

    <x-engineermanagement::modal-form :action="$modalMode" :title="$modalTitle" :save="$modalSave">
        <x-slot name="modalContent">
            <div>
                
            </div>
            <div>
                <label class="{{ $inputLabel }}">Engineer Skills (comma separated):</label>
                <div>
                    <input type="text" class="{{ $inputNormal }} @error('engineerSkills') {{ $inputError }} @enderror"
                        wire:model="engineerSkills" />
                    @error('engineerSkills')
                        <p class="{{ $errorMessage }}">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </x-slot>
    </x-engineermanagement::modal-form>

</div>