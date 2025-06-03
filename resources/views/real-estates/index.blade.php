<x-layout>
    <x-slot name="heading">All estates</x-slot>

    @auth
        <div class="flex justify-end mb-4">
            <a href="{{ route('real-estates.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Add a new property
            </a>
        </div>
    @endauth

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($realEstates as $estate)
            <div class="bg-white shadow rounded p-4">
                <img src="{{ asset('storage/' . $estate->image) }}" alt="Real estate image" class="w-full h-48 object-cover rounded mb-4">
                
                <h2 class="text-xl font-bold mb-2">{{ $estate->name }}</h2>
                <p class="text-gray-600 mb-1"><strong>Location:</strong> {{ $estate->location }}</p>
                <p class="text-gray-700 mb-2">{{ $estate->description }}</p>
                <p class="font-semibold text-blue-600 mb-4">{{ number_format($estate->price, 2) }} €</p>

                @auth
                    @if ($estate->user_id === auth()->id())
                        <a href="{{ route('real-estates.edit', $estate) }}"
                           class="inline-block bg-red-600 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                            Edit
                        </a>
                    @endif
                @endauth
            </div>
        @empty
            <p>No properties entered.</p>
        @endforelse
    </div>
</x-layout>
