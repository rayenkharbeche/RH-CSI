<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Contrats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('contracts.create') }}" class="btn btn-success mb-2">Ajouter un Contrat</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Classification</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $contract)
                        <tr>
                            <td>{{ $contract->type }}</td>
                            <td>{{ $contract->classification }}</td>
                            <td>
                                <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-primary">Voir</a>
                                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $contracts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
