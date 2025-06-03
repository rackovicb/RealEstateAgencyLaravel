<x-layout>
    <x-slot name="heading">Change property</x-slot>

    <form action="{{ route('real-estates.update', $realEstate) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $realEstate->name) }}" required class="w-full p-2 border rounded" placeholder="Naziv nekretnine">

        <textarea name="description" required class="w-full p-2 border rounded" placeholder="Opis">{{ old('description', $realEstate->description) }}</textarea>

        <input type="number" name="price" value="{{ old('price', $realEstate->price) }}" required class="w-full p-2 border rounded" placeholder="Cena">

        <select name="location" class="w-full p-2 border rounded" required>
            @foreach ($cities as $city)
                <option value="{{ $city }}" {{ old('location', $realEstate->location) == $city ? 'selected' : '' }}>{{ $city }}</option>
            @endforeach
        </select>

        <input type="file" name="image" class="w-full p-2 border rounded">

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Save changes</button>
    </form>
</x-layout>
