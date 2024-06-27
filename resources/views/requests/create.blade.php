<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une demande administrative') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employé</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->prenom }} {{ $employee->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de demande</label>
                            <select name="type" id="type" class="form-select mt-1 block w-full">
                                @foreach (\App\Models\AdministrativeRequest::TYPES as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer la demande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
