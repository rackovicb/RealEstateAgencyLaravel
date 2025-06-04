<x-layout>
    <x-slot name="heading">Change Property</x-slot>

    @if ($errors->any())
        <div class="max-w-xl mx-auto bg-red-100 text-red-800 p-4 rounded-md mb-4 border border-red-300 shadow">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        action="{{ route('real-estates.update', $realEstate) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-6"
    >
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-lg font-semibold text-gray-700 mb-1">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name', $realEstate->name) }}" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Property name"
            >
        </div>

        <div>
            <label for="description" class="block text-lg font-semibold text-gray-700 mb-1">Description</label>
            <textarea 
                name="description" 
                id="description" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Property description"
            >{{ old('description', $realEstate->description) }}</textarea>
        </div>

        <div>
            <label for="price" class="block text-lg font-semibold text-gray-700 mb-1">Price (€)</label>
            <input 
                type="number" 
                name="price" 
                id="price" 
                value="{{ old('price', $realEstate->price) }}" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Price in Euros"
            >
        </div>

        <div>
            <label for="location" class="block text-lg font-semibold text-gray-700 mb-1">Location</label>
            <select 
                name="location" 
                id="location" 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                @foreach ($cities as $city)
                    <option value="{{ $city }}" {{ old('location', $realEstate->location) == $city ? 'selected' : '' }}>
                        {{ $city }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="image" class="block text-lg font-semibold text-gray-700 mb-1">Change Image</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                class="w-full"
            >
        </div>

        @if ($realEstate->image)
            <div>
                <p class="text-gray-600 mb-1">Current Image:</p>
                <img src="{{ asset('storage/' . $realEstate->image) }}" class="w-48 h-auto rounded shadow">
            </div>
        @endif

        <div class="text-center">
            <button 
                type="submit" 
                class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-xl text-lg font-semibold hover:bg-gray-800 transition"
            >
                Save Changes
            </button>
        </div>
    </form>
</x-layout>
