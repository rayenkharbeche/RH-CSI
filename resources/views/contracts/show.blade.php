<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails du Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <p><strong>Type :</strong> {{ $contract->type }}</p>
                        <p><strong>Classification :</strong> {{ $contract->classification }}</p>
                        <p><strong>Coefficient :</strong> {{ $contract->coefficient }}</p>
                        <p><strong>Période d'Essai Initiale :</strong> {{ $contract->periode_essai_initiale }}</p>
                        <p><strong>Renouvellement :</strong> {{ $contract->renouvellement }}</p>
                        <p><strong>Durée du Contrat :</strong> {{ $contract->duree_contrat }}</p>
                        <p><strong>Limite du Contrat :</strong> {{ $contract->limite_contrat }}</p>
                        <p><strong>Créé le :</strong> {{ $contract->created_at->format('d/m/Y H:i:s') }}</p>
                        <p><strong>Modifié le :</strong> {{ $contract->updated_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
