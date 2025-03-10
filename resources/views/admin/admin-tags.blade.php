<x-side-bare>
@if(session('success'))
    <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-md">
        {{ session('success') }}
    </div>
@endif

    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Liste des Tags</h1>
        
        <div class="mb-6">
            <a href="{{ route('tags.create') }}" 
               class="bg-blue-500 text-white font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300">
                Ajouter un Tag
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-4 px-6 text-lg">ID</th>
                        <th class="py-4 px-6 text-lg">Nom</th>
                        <th class="py-4 px-6 text-lg">Description</th>
                        <th class="py-4 px-6 text-lg">Annonces</th>
                        <th class="py-4 px-6 text-lg">Créé le</th>
                        <th class="py-4 px-6 text-lg">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr class="border-b hover:bg-gray-50 transition duration-300 ease-in-out">
                            <td class="py-4 px-6 text-gray-700">{{ $tag->id }}</td>
                            <td class="py-4 px-6 text-gray-700">
                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $tag->nom }}</span>
                            </td>
                            <td class="py-4 px-6 text-gray-700">{{ $tag->description ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-gray-700">{{ $tag->annonces_count }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ $tag->created_at->format('d/m/Y') }}</td>
                            <td class="py-4 px-6 space-x-4 flex items-center justify-start">
                                <!-- Edit Button -->
                                <a href="{{ route('tags.edit', $tag->id) }}"
                                   class="inline-block text-blue-600 hover:bg-blue-100 font-semibold px-5 py-2 rounded-lg border border-blue-500 hover:border-blue-700 transition duration-300 ease-in-out">
                                    Modifier
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:bg-red-100 font-semibold px-5 py-2 rounded-lg border border-red-500 hover:border-red-700 transition duration-300 ease-in-out">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-side-bare>