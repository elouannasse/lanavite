<x-side-bare>

    @if(session('success'))
        <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Modifier la Société</h1>

        <!-- Edit Form -->
        <form action="{{ route('societes.update', $societe->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <!-- Name Input -->
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $societe->name) }}" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Nom de la société" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Description de la société" required>{{ old('description', $societe->description) }}</textarea>
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
