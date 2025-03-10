<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('annonces')->get();
        return view('admin.admin-tags', compact('tags'));
    }

    public function create()
    {
        return view('admin.create-tag');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|max:255|unique:tags,nom',
            'description' => 'nullable|max:500',
        ]);

        Tag::create($validated);

        return redirect()->route('tags')->with('success', 'Tag créé avec succès!');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag-edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|max:255|unique:tags,nom,' . $tag->id,
            'description' => 'nullable|max:500',
        ]);

        $tag->update($validated);
        return redirect()->route('tags')->with('success', 'Tag mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route("tags")->with('success', 'Tag supprimé avec succès!');
    }
}