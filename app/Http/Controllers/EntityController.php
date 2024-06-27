<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    // Afficher la liste des entités
    public function index()
    {
        $entities = Entity::all();
        return view('entities.index', compact('entities'));
    }

    // Afficher le formulaire de création d'une entité
    public function create()
    {
        return view('entities.create');
    }

    // Enregistrer une nouvelle entité
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'tax_number' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'contact_information' => 'required|string',
            'employer_name' => 'required|string',
            'employer_address' => 'required|string',
            'siret_number' => 'required|string',
            'ape_code' => 'required|string',
            'collective_agreement' => 'required|string',
            'establishment_id' => 'required|string',
        ]);

        Entity::create($request->all());

        return redirect()->route('entities.index')->with('success', 'Entité créée avec succès.');
    }

    // Afficher le formulaire d'édition d'une entité
    public function edit(Entity $entity)
    {
        return view('entities.edit', compact('entity'));
    }

    // Mettre à jour les informations d'une entité
    public function update(Request $request, Entity $entity)
    {
        $request->validate([
            'name' => 'required|string',
            'tax_number' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'contact_information' => 'required|string',
            'employer_name' => 'required|string',
            'employer_address' => 'required|string',
            'siret_number' => 'required|string',
            'ape_code' => 'required|string',
            'collective_agreement' => 'required|string',
            'establishment_id' => 'required|string',
        ]);

        $entity->update($request->all());

        return redirect()->route('entities.index')->with('success', 'Informations de l\'entité mises à jour avec succès.');
    }

    // Supprimer une entité
    public function destroy(Entity $entity)
    {
        $entity->delete();
        return redirect()->route('entities.index')->with('success', 'Entité supprimée avec succès.');
    }
}
