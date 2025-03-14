<x-side-bare>
@if(session('success'))
    <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-md">
        {{ session('success') }}
    </div>
@endif
    
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Ajouter un Nouveau Tag</h1>
        <form action="{{ route('tags.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Nom Input -->
            <div>
                <label for="nom" class="block text-lg font-medium text-gray-700">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" 
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Nom du tag" required>
                @error('nom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            Description Input
            <!-- <div> -->
                <!-- <label for="description" class="block text-lg font-medium text-gray-700">Description</label> -->
                <!-- <textarea id="description" name="description" rows="4"  -->
                    <!-- class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" -->
                    <!-- placeholder="Description du tag">{{ old('description') }}</textarea> -->
                <!-- @error('description') -->
                    <!-- <p class="text-red-500 text-sm mt-1">{{ $message }}</p> -->
                <!-- @enderror -->
            <!-- </div> -->

            <!-- Submit Button -->
            <div class="flex justify-start">
                <button type="submit" 
                    class="bg-blue-500 text-white font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition duration-300">
                    Ajouter le Tag
                </button>
            </div>
        </form>
    </div>
</x-side-bare>