<x-side-bare>
    @if(session('success'))
        <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Modifier l'Annonce</h1>

        <!-- Edit Form -->
        <form action="{{ route('annonces.update', $annonce->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Titre Input -->
            <div>
                <label for="titre" class="block text-lg font-medium text-gray-700">Titre</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre', $annonce->titre) }}" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Titre de l'annonce" required>
                @error('titre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Société Select -->
            <div>
                <label for="societe_id" class="block text-lg font-medium text-gray-700">Société</label>
                <select id="societe_id" name="societe_id" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="">Sélectionner une société</option>
                    @foreach($societes as $societe)
                        <option value="{{ $societe->id }}" {{ old('societe_id', $annonce->societe_id) == $societe->id ? 'selected' : '' }}>
                            {{ $societe->name }}
                        </option>
                    @endforeach
                </select>
                @error('societe_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prix Input -->
            <div>
                <label for="prix" class="block text-lg font-medium text-gray-700">Prix</label>
                <input type="number" id="prix" name="prix" value="{{ old('prix', $annonce->prix) }}" step="0.01" min="0"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Prix de l'annonce">
                @error('prix')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Publication Input -->
            <div>
                <label for="date_publication" class="block text-lg font-medium text-gray-700">Date de Publication</label>
                <input type="date" id="date_publication" name="date_publication" 
                    value="{{ old('date_publication', $annonce->date_publication ? \Carbon\Carbon::parse($annonce->date_publication)->format('Y-m-d') : '') }}" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('date_publication')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tags Multiselect -->
            <div>
                <label for="tags" class="block text-lg font-medium text-gray-700">Tags</label>
                <select id="tags" name="tags[]" multiple
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $annonce->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $tag->nom }}
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-sm mt-1">Maintenez la touche Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs tags</p>
                @error('tags')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Textarea -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Description de l'annonce" required>{{ old('description', $annonce->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-start">
                <button type="submit" 
                    class="bg-blue-500 text-white font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300">
                    Mettre à Jour
                </button>
            </div>
        </form>
    </div>
</x-side-bare>