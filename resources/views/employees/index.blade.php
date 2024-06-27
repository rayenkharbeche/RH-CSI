<!-- resources/views/employees/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('employees.create') }}" class="btn btn-success">Create Employee</a>
                    </div>
                    <form action="{{ route('employees.export') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary">Export Employees</button>
                    </form>
                    <div class="mb-4">
                        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Choose Excel File</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Import Employees</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Date de naissance</th>
                                <th>Email professionnel</th>
                                <th>Email personnel</th>
                                <th>Matricule</th>
                                <th>Téléphone</th>
                                <th>Adresse</th>
                                <th>Code postal</th>
                                <th>Ville</th>
                                <th>Pays</th>
                                <th>Situation familiale</th>
                                <th>Nombre d'enfants</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->nom }}</td>
                                <td>{{ $employee->prenom }}</td>
                                <td>{{ $employee->date_naissance }}</td>
                                <td>{{ $employee->email_professionnel }}</td>
                                <td>{{ $employee->email_personnel }}</td>
                                <td>{{ $employee->matricule }}</td>
                                <td>{{ $employee->telephone }}</td>
                                <td>{{ $employee->adresse }}</td>
                                <td>{{ $employee->code_postal }}</td>
                                <td>{{ $employee->ville }}</td>
                                <td>{{ $employee->pays }}</td>
                                <td>{{ $employee->situation_familiale }}</td>
                                <td>{{ $employee->nombre_enfants }}</td>
                                <td>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
