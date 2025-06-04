<x-layout>
    <x-slot name="heading">Add New Real Estate</x-slot>

    <form 
        action="{{ route('real-estates.store') }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="max-w-xl mx-auto mt-8 space-y-6 bg-white p-6 rounded-xl shadow-md"
    >
        @csrf

        <div>
            <label for="name" class="block text-lg font-semibold text-gray-700 mb-1">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="description" class="block text-lg font-semibold text-gray-700 mb-1">Description</label>
            <textarea 
                name="description" 
                id="description" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            ></textarea>
        </div>

        <div>
            <label for="price" class="block text-lg font-semibold text-gray-700 mb-1">Price (€)</label>
            <input 
                type="number" 
                name="price" 
                id="price" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="location" class="block text-lg font-semibold text-gray-700 mb-1">Location</label>
            <select 
                name="location" 
                id="location" 
                required 
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">-- Choose City --</option>
                <option value="Beograd">Beograd</option>
                <option value="Novi Sad">Novi Sad</option>
                <option value="Čačak">Čačak</option>
                <option value="Niš">Niš</option>
            </select>
        </div>

        <div>
            <label for="image" class="block text-lg font-semibold text-gray-700 mb-1">Image</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                accept="image/*" 
                required 
                class="w-full"
            >
        </div>

        <div class="text-center">
            <button 
                type="submit" 
                class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-xl text-lg font-semibold border border-gray-700 hover:bg-gray-900 transition"
            >   
                Add Property
            </button>
        </div>
    </form>
</x-layout>
