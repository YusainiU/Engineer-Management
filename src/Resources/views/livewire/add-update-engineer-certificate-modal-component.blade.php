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

    $ul = Config::get('engineer-management.listClass.ul');
    $li = Config::get('engineer-management.listClass.li');
    $liLeft = Config::get('engineer-management.listClass.liLeftItem');
    $liRightTop = Config::get('engineer-management.listClass.liRightTopItem');
    $liRightBottom = Config::get('engineer-management.listClass.liRightBottomItem');

@endphp

<div class="{{ $divTopClass }}">
    <x-engineermanagement::modal-form :action="$modalMode" :title="$modalTitle" :save="$modalSave">
        <x-slot name="modalContent">
            <h4 class="text-gray-200 dark:text-gray-900">
                {{ $engineer->user->name }}
            </h4>
            <div class="group">
                @if ($displayList)
                    <span class="cursor-pointer group-hover:hidden">
                        <x-engineermanagement-ui-icon name="addcircle" class="h-6 w-6" />
                    </span>
                    <button class="hidden group-hover:block text-sm text-gray-500 cursor-pointer"
                        wire:click="createNewCertificate">Add Certificate
                    </button>
                @else
                    <span class="cursor-pointer group-hover:hidden">
                        <x-engineermanagement-ui-icon name="left" class="h-6 w-6 text-gray-900" />
                    </span>
                    <button class="hidden group-hover:block text-sm text-gray-500 cursor-pointer"
                        wire:click="backToList">Back to List
                    </button>
                @endif
            </div>
            @if($displayList)
            <ul class="{{ $ul }}">
                @foreach ($certificates as $certificate)
                    <li class="{{ $li }}">
                        <div class="group">
                            <span class="{{ $liLeft }} group-hover:hidden">
                                {{ $loop->iteration }}
                            </span>
                            <span class="hidden group-hover:block">
                                <button class="cursor-pointer" wire:click="updateCertificate({{ $certificate->id }})">
                                    <x-engineermanagement-ui-icon name="edit" class="h-8 w-8 text-gray-900" />
                                </button>
                            </span>
                        </div>
                        <div class="{{ $liRightTop }}">
                            {{ $certificate->certificate->name }}
                        </div>
                        <div class="{{ $liRightBottom }}">
                            @if ($certificate->active)
                                <span class="text-green-500">Active</span>
                            @else
                                <span class="text-red-500">Inactive</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            @else
                <div>
                    <label for="certificateId" class="{{ $inputLabel }}">Certificate</label>
                    <select wire:model="certificateId" id="certificateId"
                        class="{{ $errors->has('certificateId') ? $inputError : $inputNormal }}">
                        <option value="">-- Select Certificate --</option>
                        @foreach ($allCertificates as $cert)
                            <option value="{{ $cert->id }}">{{ $cert->name }}</option>
                        @endforeach
                    </select>
                    @error('certificateId')
                        <span class="{{ $errorMessage }}">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="{{ $checkboxLabel }}">
                        <input type="checkbox" wire:model="active" class="{{ $checkbox }}" />
                        Active
                    </label>
                </div>
                <div class="mt-4">
                    <label class="{{ $checkboxLabel }}">
                        <input type="checkbox" wire:model="expired" class="{{ $checkbox }}" />
                        Expired
                    </label>
                </div>
            @endif

        </x-slot>
    </x-engineermanagement::modal-form>
</div>