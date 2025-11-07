<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-start align-items-center">
            <div class="d-flex align-items-center px-3 py-2 bg-dark text-white rounded shadow-sm">
                <span class="fw-bold">UNITRA</span>
            </div>
        </div>
    </x-slot>

    @livewire('renters.renter-list')
</x-app-layout>
