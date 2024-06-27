<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Entités
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Numéro Fiscal</th>
                            <th>Adresse</th>
                            <th>Pays</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($entities as $entity)
                        <tr>
                            <td>{{ $entity->name }}</td>
                            <td>{{ $entity->tax_number }}</td>
                            <td>{{ $entity->address }}</td>
                            <td>{{ $entity->country }}</td>
                            <td>
                                <a href="{{ route('entities.edit', $entity->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                <form action="{{ route('entities.destroy', $entity->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entité ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
