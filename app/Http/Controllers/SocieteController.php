<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocieteController extends Controller
{
    /**
     * Afficher la liste des sociétés
     */
    public function index()
    {
        $societes = Societe::with('tags')->get();
        return view('admin.societes.index', compact('societes'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.create-societe', compact('tags'));
    }

    /**
     * Enregistrer une nouvelle société
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Créer la société
        $societe = Societe::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Associer les tags si présents
        if ($request->has('tags')) {
            $societe->tags()->attach($request->tags);
        }

        return redirect()->route('societes')->with('success', 'Société créée avec succès');
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $societe = Societe::with('tags')->findOrFail($id);
        $tags = Tag::all();
        return view('admin.societe-edit', compact('societe', 'tags'));
    }

    /**
     * Mettre à jour une société existante
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $societe = Societe::findOrFail($id);
        
        // Mettre à jour les informations de base
        $societe->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Synchroniser les tags (supprime les anciens et ajoute les nouveaux)
        $societe->tags()->sync($request->tags ?? []);

        return redirect()->route('societes')->with('success', 'Société mise à jour avec succès');
    }

    /**
     * Supprimer une société
     */
    public function destroy($id)
    {
        $societe = Societe::findOrFail($id);
        $societe->delete();

        return redirect()->route('societes')->with('success', 'Société supprimée avec succès');
    }
}