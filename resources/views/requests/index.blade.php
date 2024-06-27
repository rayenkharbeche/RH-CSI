<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des demandes administratives') }}
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
                            <th>Employé</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->employee->prenom }} {{ $request->employee->nom }}</td>
                            <td>{{ $request->type }}</td>
                            <td>{{ $request->status }}</td>
                            <td>
                                <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
