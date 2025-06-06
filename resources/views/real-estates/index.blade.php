<x-layout>
    <x-slot name="heading">All Estates</x-slot>

    @auth
    <div class="text-left text-sm text-gray-600 mb-4">
        Logged in as: <strong>{{ auth()->user()->email }}</strong>
    </div>
    @endauth

    <form method="GET" class="mb-6 mx-auto w-fit">
        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Filter by location:</label>
        <select name="location" id="location" class="rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Show all</option>
            @foreach ($locations as $city)
                <option value="{{ $city }}" {{ $city === $location ? 'selected' : '' }}>{{ $city }}</option>
            @endforeach
        </select>
        <button type="submit" class="ml-2 px-3 py-1 bg-blue-600 text-white rounded">Filter</button>
    </form>

    @auth
        @if (!request()->routeIs('home'))
            <div class="flex justify-end mb-6">
                <a href="{{ route('real-estates.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                    + Create new estate
                </a>
            </div>
        @endif
    @endauth

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($realEstates as $estate)
            <div class="bg-white border rounded shadow p-3 w-full max-w-xs mx-auto text-sm">

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

                @auth
                    @if (auth()->id() === $estate->user_id && !request()->routeIs('home'))
                        <div class="flex gap-2 mt-3">
                            <a href="{{ route('real-estates.edit', $estate) }}"
                               class="flex-1 text-center bg-yellow-500 text-white py-1 text-xs rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>
                            <form action="{{ route('real-estates.destroy', $estate) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this property?');"
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-600 text-white py-1 text-xs rounded hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
                @auth
                    <button 
                        class="favorite-btn w-full bg-blue-500 text-white py-2 text-sm rounded hover:bg-blue-600 transition"
                        data-id="{{ $estate->id }}">
                        {{ in_array($estate->id, $favoriteIds ?? []) ? 'Remove from Favorites' : 'Add to Favorites' }}
                    </button>
                @endauth
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No properties entered.</p>
        @endforelse
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function () {
                const estateId = this.dataset.id;
                console.log("ID koji se šalje:", estateId);
                const btn = this;

                fetch("/favorites/toggle", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        real_estate_id: estateId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                        btn.innerText = 'Remove from Favorites';
                        btn.classList.remove('bg-blue-500');
                        btn.classList.add('bg-red-500');
                    } else {
                        btn.innerText = 'Add to Favorites';
                        btn.classList.remove('bg-red-500');
                        btn.classList.add('bg-blue-500');
                    }
                });
            });
        });
    });
</script>

</x-layout>
