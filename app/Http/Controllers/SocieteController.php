<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
    public function index(){
        $societes = Societe::all();
        return view("admin.admin-societes", compact("societes"));
    }

        public function create()
        {
            return view('admin.create-societe');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required|max:500',
            ]);

            Societe::create($validated);

            return redirect()->back()->with('success', 'Société créée avec succès!');;
        }

    public function edit($id)
    {
        $societe = Societe::findOrFail($id); 
        return view('admin.societe-edit', compact('societe')); 
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:500',
        ]);

        $societe = Societe::findOrFail($id);
        $societe->update($validated);
        return redirect()->back()->with('success', 'Société mise à jour avec succès!');
    }

    public function destroy($id)
{
    $societe = Societe::findOrFail($id);
    $societe->delete();

    return redirect()->route("societes")->with('success', 'Société supprimée avec succès!');
}

    
}