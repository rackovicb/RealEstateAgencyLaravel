<x-layout>
    <x-slot name="heading">Add New Real Estate</x-slot>

    <form action="{{ route('real-estates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" required class="mt-1 block w-full rounded border-gray-300 shadow-sm"></textarea>
        </div>

        <div>
            <label for="price" class="block font-medium text-gray-700">Price (€)</label>
            <input type="number" name="price" id="price" required class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        </div>

        <div>
            <label for="location" class="block font-medium text-gray-700">Location</label>
            <select name="location" id="location" required class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                <option value="">-- Choose City --</option>
                <option value="Beograd">Beograd</option>
                <option value="Novi Sad">Novi Sad</option>
                <option value="Čačak">Čačak</option>
                <option value="Niš">Niš</option>
            </select>
        </div>

        <div>
            <label for="image" class="block font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image" accept="image/*" required class="mt-1 block w-full">
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Property</button>
        </div>
    </form>
</x-layout>
