<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Societe;
use App\Models\Tag;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::with(['societe', 'tags'])->get();
        return view("admin.admin-annonces", compact("annonces"));
    }

    public function create()
    {
        $societes = Societe::all();
        $tags = Tag::all();
        return view('admin.create-annonce', compact('societes', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required|max:1000',
            'societe_id' => 'required|exists:societes,id',
            'prix' => 'nullable|numeric',
            'date_publication' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $annonce = Annonce::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'societe_id' => $validated['societe_id'],
            'prix' => $validated['prix'] ?? null,
            'date_publication' => $validated['date_publication'] ?? now(),
        ]);

        if (isset($request->tags)) {
            $annonce->tags()->sync($request->tags);
        }

        return redirect()->back()->with('success', 'Annonce créée avec succès!');
    }

    public function edit($id)
    {
        $annonce = Annonce::with('tags')->findOrFail($id);
        $societes = Societe::all();
        $tags = Tag::all();
        return view('admin.annonce-edit', compact('annonce', 'societes', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required|max:1000',
            'societe_id' => 'required|exists:societes,id',
            'prix' => 'nullable|numeric',
            'date_publication' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $annonce = Annonce::findOrFail($id);
        
        $annonce->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'societe_id' => $validated['societe_id'],
            'prix' => $validated['prix'] ?? $annonce->prix,
            'date_publication' => $validated['date_publication'] ?? $annonce->date_publication,
        ]);

        $annonce->tags()->sync($request->tags ?? []);

        return redirect()->back()->with('success', 'Annonce mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->route("annonces")->with('success', 'Annonce supprimée avec succès!');
    }
}