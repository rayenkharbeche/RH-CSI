<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('employees.store') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="nom" :value="__('Nom')" />
                        <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" autofocus />
                        <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                    </div>

                    <!-- First Name -->
                    <div class="mt-4">
                        <x-input-label for="prenom" :value="__('Prénom')" />
                        <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" />
                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                    </div>

                    <!-- Date of Birth -->
                    <div class="mt-4">
                        <x-input-label for="date_naissance" :value="__('Date de Naissance')" />
                        <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" />
                        <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
                    </div>

                    <!-- Email Address (Professional) -->
                    <div class="mt-4">
                        <x-input-label for="email_professionnel" :value="__('Adresse e-mail professionnel')" />
                        <x-text-input id="email_professionnel" class="block mt-1 w-full" type="email" name="email_professionnel" :value="old('email_professionnel')" />
                        <x-input-error :messages="$errors->get('email_professionnel')" class="mt-2" />
                    </div>

                    <!-- Personal Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email_personnel" :value="__('Adresse e-mail personnel')" />
                        <x-text-input id="email_personnel" class="block mt-1 w-full" type="email" name="email_personnel" :value="old('email_personnel')" />
                        <x-input-error :messages="$errors->get('email_personnel')" class="mt-2" />
                    </div>

                    <!-- Employee Code (Matricule) -->
                    <div class="mt-4">
                        <x-input-label for="matricule" :value="__('Matricule')" />
                        <x-text-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')" />
                        <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
                    </div>

                    <!-- Phone Number with Country Code -->
                    <div class="mt-4">
                        <x-input-label for="telephone" :value="__('Numéro de téléphone avec indicatif du pays')" />
                        <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" />
                        <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                    </div>

                    <!-- Postal Code -->
                    <div class="mt-4">
                        <x-input-label for="code_postal" :value="__('Code postal')" />
                        <x-text-input id="code_postal" class="block mt-1 w-full" type="text" name="code_postal" :value="old('code_postal')" />
                        <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                    </div>

                    <!-- City -->
                    <div class="mt-4">
                        <x-input-label for="ville" :value="__('Ville')" />
                        <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" />
                        <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                    </div>

                    <!-- Country -->
                    <div class="mt-4">
                        <x-input-label for="pays" :value="__('Pays')" />
                        <x-text-input id="pays" class="block mt-1 w-full" type="text" name="pays" :value="old('pays')" />
                        <x-input-error :messages="$errors->get('pays')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="mt-4">
                        <x-input-label for="adresse" :value="__('Adresse')" />
                        <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" />
                        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                    </div>

                    <!-- Marital Status -->
                    <div class="mt-4">
                        <x-input-label for="situation_familiale" :value="__('Situation familiale')" />
                        <select id="situation_familiale" name="situation_familiale" class="block mt-1 w-full">
                            <option value="célibataire" {{ old('situation_familiale') === 'célibataire' ? 'selected' : '' }}>Célibataire</option>
                            <option value="marié(e)" {{ old('situation_familiale') === 'marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                            <option value="divorcé(e)" {{ old('situation_familiale') === 'divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                            <option value="veuf/veuve" {{ old('situation_familiale') === 'veuf/veuve' ? 'selected' : '' }}>Veuf/Veuve</option>
                        </select>
                        <x-input-error :messages="$errors->get('situation_familiale')" class="mt-2" />
                    </div>

                    <!-- Number of Children -->
                    <div class="mt-4">
                        <x-input-label for="nombre_enfants" :value="__('Nombre d’enfants')" />
                        <select id="nombre_enfants" name="nombre_enfants" class="block mt-1 w-full">
                            <option value="0" {{ old('nombre_enfants') === '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ old('nombre_enfants') === '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('nombre_enfants') === '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('nombre_enfants') === '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('nombre_enfants') === '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('nombre_enfants') === '5' ? 'selected' : '' }}>5</option>
                            <!-- Add more options as needed -->
                        </select>
                        <x-input-error :messages="$errors->get('nombre_enfants')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Create Employee') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
