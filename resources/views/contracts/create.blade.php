<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('contracts.store') }}">
                        @csrf
                        <!-- Pays -->
                        <div class="form-group row">
                            <label for="pays" class="col-md-4 col-form-label text-md-right">{{ __('Pays') }}</label>
                            <div class="col-md-6">
                                <select id="pays" class="form-control @error('pays') is-invalid @enderror" name="pays" required autocomplete="pays" autofocus>
                                    <option value="">Choisir le pays</option>
                                    <option value="Tunisie">Tunisie</option>
                                    <option value="France">France</option>
                                </select>
                                @error('pays')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Type de contrat -->
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type de contrat') }}</label>
                            <div class="col-md-6">
                                <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required autocomplete="type">
                                    <option value="">Choisir le type de contrat</option>
                                    <!-- Options de contrat dynamiques selon le pays sélectionné -->
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Classification -->
                        <div class="form-group row">
                            <label for="classification" class="col-md-4 col-form-label text-md-right">{{ __('Classification') }}</label>
                            <div class="col-md-6">
                                <select id="classification" class="form-control @error('classification') is-invalid @enderror" name="classification" required>
                                    <option value="">Choisir une classification</option>
                                    <option value="ETAM">Employés, Techniciens et Agents de Maîtrise "ETAM"</option>
                                    <option value="Ingénieurs et Cadres">Ingénieurs et Cadres</option>
                                </select>
                                @error('classification')
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Coefficient -->
                        <div class="form-group row">
                            <label for="coefficient" class="col-md-4 col-form-label text-md-right">{{ __('Coefficient') }}</label>

                            <div class="col-md-6">
                                <input id="coefficient" type="number" class="form-control @error('coefficient') is-invalid @enderror" name="coefficient" autocomplete="coefficient">

                                @error('coefficient')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Période d'Essai Initiale -->
                        <div class="form-group row">
                            <label for="periode_essai_initiale" class="col-md-4 col-form-label text-md-right">{{ __('Période d\'Essai Initiale') }}</label>

                            <div class="col-md-6">
                                <input id="periode_essai_initiale" type="text" class="form-control @error('periode_essai_initiale') is-invalid @enderror" name="periode_essai_initiale" autocomplete="periode_essai_initiale">

                                @error('periode_essai_initiale')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Renouvellement -->
                        <div class="form-group row">
                            <label for="renouvellement" class="col-md-4 col-form-label text-md-right">{{ __('Renouvellement') }}</label>

                            <div class="col-md-6">
                                <input id="renouvellement" type="date" class="form-control @error('renouvellement') is-invalid @enderror" name="renouvellement" autocomplete="renouvellement">

                                @error('renouvellement')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Durée du Contrat -->
                        <div class="form-group row">
                            <label for="duree_contrat" class="col-md-4 col-form-label text-md-right">{{ __('Durée du Contrat') }}</label>

                            <div class="col-md-6">
                                <input id="duree_contrat" type="text" class="form-control @error('duree_contrat') is-invalid @enderror" name="duree_contrat" autocomplete="duree_contrat">

                                @error('duree_contrat')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Limite du Contrat -->
                        <div class="form-group row">
                            <label for="limite_contrat" class="col-md-4 col-form-label text-md-right">{{ __('Limite du Contrat') }}</label>

                            <div class="col-md-6">
                                <input id="limite_contrat" type="text" class="form-control @error('limite_contrat') is-invalid @enderror" name="limite_contrat" autocomplete="limite_contrat">

                                @error('limite_contrat')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Liste déroulante pour sélectionner un employé -->
                        <div class="form-group row">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-right">{{ __('Sélectionner un employé') }}</label>
                            <div class="col-md-6">
                                <select id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" name="employee_id">
                                    <option value="">Choisir un employé</option>
                                    @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->nom }} {{ $emp->prenom }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var paysSelect = document.getElementById('pays');

            // Options de contrat par pays
            var contratsParPays = {
                'Tunisie': [
                    { value: 'CDI', label: 'Contrat à Durée Indéterminée (CDI)' },
                    { value: 'CDD', label: 'Contrat à Durée Déterminée (CDD)' },
                    { value: 'CIVP', label: 'Contrat d’Insertion à la Vie Professionnelle (CIVP)' },
                    { value: 'PFE', label: 'Stage / Projet de Fin d’Études (PFE)' },
                    { value: 'Freelance', label: 'Freelance' }
                ],
                'France': [
                    { value: 'CDI', label: 'Contrat à Durée Indéterminée (CDI)' },
                    { value: 'CDD', label: 'Contrat à Durée Déterminée (CDD)' },
                    { value: 'CIVP', label: 'Contrat d’Insertion à la Vie Professionnelle (CIVP)' },
                    { value: 'PFE', label: 'Stage / Projet de Fin d’Études (PFE)' },
                    { value: 'Freelance', label: 'Freelance' },
                    { value: 'Interim', label: 'Contrat de Travail Temporaire (Intérim)' },
                    { value: 'TempsPartiel', label: 'Contrat à Temps Partiel' }
                    // Ajouter d'autres types de contrat pour la France si nécessaire
                ]
            };

            // Fonction pour mettre à jour les options du type de contrat en fonction du pays sélectionné
            function updateTypeOptions(selectedPays) {
                // Nettoyer les options existantes
                typeSelect.innerHTML = '<option value="">Choisir le type de contrat</option>';

                // Obtenir les types de contrat pour le pays sélectionné
                var contrats = contratsParPays[selectedPays] || [];

                // Ajouter les options au menu déroulant
                contrats.forEach(function(contrat) {
                    var option = document.createElement('option');
                    option.value = contrat.value;
                    option.textContent = contrat.label;
                    typeSelect.appendChild(option);
                });
            }

            // Écouter les changements sur la sélection du pays
            paysSelect.addEventListener('change', function() {
                var selectedPays = paysSelect.value;
                updateTypeOptions(selectedPays);
            });

            // Déclencher l'événement 'change' au chargement pour initialiser les options
            paysSelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>
