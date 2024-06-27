

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>{{ $employee->nom }} {{ $employee->prenom }}</h3>
                    <p><strong>Date of Birth:</strong> {{ $employee->date_naissance }}</p>
                    <p><strong>Professional Email:</strong> {{ $employee->email_professionnel }}</p>
                    <p><strong>Personal Email:</strong> {{ $employee->email_personnel }}</p>
                    <p><strong>Matricule:</strong> {{ $employee->matricule }}</p>
                    <p><strong>Phone Number:</strong> {{ $employee->telephone }}</p>
                    <p><strong>Postal Code:</strong> {{ $employee->code_postal }}</p>
                    <p><strong>City:</strong> {{ $employee->ville }}</p>
                    <p><strong>Country:</strong> {{ $employee->pays }}</p>
                    <p><strong>Address:</strong> {{ $employee->adresse }}</p>
                    <p><strong>Marital Status:</strong> {{ $employee->situation_familiale }}</p>
                    <p><strong>Number of Children:</strong> {{ $employee->nombre_enfants }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
