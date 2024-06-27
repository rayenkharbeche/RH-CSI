<!-- resources/views/employees/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user_id">User ID</label>
                            <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $employee->user_id }}" readonly style="background-color: #e9ecef;">
                            @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ $employee->nom }}" readonly style="background-color: #e9ecef;">
                            @error('nom')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ $employee->prenom }}" readonly style="background-color: #e9ecef;">
                            @error('prenom')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance" class="form-control" value="{{ $employee->date_naissance }}">
                            @error('date_naissance')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email_professionnel">Adresse email professionnel</label>
                            <input type="email" id="email_professionnel" name="email_professionnel" class="form-control" value="{{ $employee->email_professionnel }}" readonly style="background-color: #e9ecef;">
                            @error('email_professionnel')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email_personnel">Adresse email personnel</label>
                            <input type="email" id="email_personnel" name="email_personnel" class="form-control" value="{{ $employee->email_personnel }}">
                            @error('email_personnel')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="matricule">Matricule</label>
                            <input type="text" id="matricule" name="matricule" class="form-control" value="{{ $employee->matricule }}">
                            @error('matricule')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telephone">Numéro de téléphone</label>
                            <input type="text" id="telephone" name="telephone" class="form-control" value="{{ $employee->telephone }}">
                            @error('telephone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="code_postal">Code postal</label>
                            <input type="text" id="code_postal" name="code_postal" class="form-control" value="{{ $employee->code_postal }}">
                            @error('code_postal')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input type="text" id="ville" name="ville" class="form-control" value="{{ $employee->ville }}">
                            @error('ville')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" id="pays" name="pays" class="form-control" value="{{ $employee->pays }}">
                            @error('pays')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" value="{{ $employee->adresse }}">
                            @error('adresse')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="situation_familiale">Situation familiale</label>
                            <select id="situation_familiale" name="situation_familiale" class="form-control">
                                <option value="Célibataire" {{ $employee->situation_familiale === 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                <option value="Marié(e)" {{ $employee->situation_familiale === 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                                <option value="Divorcé(e)" {{ $employee->situation_familiale === 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                                <option value="Veuf/Veuve" {{ $employee->situation_familiale === 'Veuf/Veuve' ? 'selected' : '' }}>Veuf/Veuve</option>
                            </select>
                            @error('situation_familiale')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre_enfants">Nombre d'enfants</label>
                            <select id="nombre_enfants" name="nombre_enfants" class="form-control">
                                <option value="0" {{ $employee->nombre_enfants === '0' ? 'selected' : '' }}>0</option>
                                <option value="1" {{ $employee->nombre_enfants === '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $employee->nombre_enfants === '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $employee->nombre_enfants === '3' ? 'selected' : '' }}>3</option>
                                <option value="4+" {{ $employee->nombre_enfants === '4+' ? 'selected' : '' }}>4+</option>
                            </select>
                            @error('nombre_enfants')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
