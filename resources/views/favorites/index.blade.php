<x-layout>
    <x-slot name="heading">My Favorite Properties</x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($realEstates as $estate)
            <div class="property-card bg-white border rounded shadow p-3 w-full max-w-xs mx-auto text-sm">
                @if ($estate->image)
                    <div class="w-32 h-32 mx-auto mb-2">
                        <img 
                            src="{{ asset('storage/' . $estate->image) }}" 
                            alt="Property image" 
                            class="w-full h-full object-cover rounded"
                        >
                    </div>
                @endif

                <div class="text-center space-y-1">
                    <h2 class="font-semibold text-base text-gray-800">{{ $estate->name }}</h2>
                    <p class="text-gray-600"><strong>Price:</strong> {{ number_format($estate->price, 2) }} €</p>
                    <p class="text-gray-600"><strong>Location:</strong> {{ $estate->location }}</p>
                    <p class="text-gray-500 text-xs"><strong>Description:</strong> {{ Str::limit($estate->description, 60) }}</p>
                </div>

                <button 
                    class="favorite-btn w-full bg-red-500 text-white py-2 text-sm rounded hover:bg-red-600 transition"
                    data-id="{{ $estate->id }}">
                    Remove from Favorites
                </button>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">You have no favorite properties.</p>
        @endforelse
    </div>

    @vite('resources/js/favorites-remove.js')
</x-layout>
