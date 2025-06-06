<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RealEstate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RealEstateController extends Controller
{
    private array $cities = ['Beograd', 'Novi Sad', 'Čačak', 'Niš'];

    public function index(Request $request)
    {
        $location = $request->query('location');
        $query = RealEstate::query();

        if ($location) {
            $query->where('location', $location);
        }

        $realEstates = $query->latest()->paginate(10);

        return view('real-estates.index', [
            'realEstates' => $realEstates,
            'locations' => $this->cities,
            'location' => $location,
        ]);
    }

    public function create()
    {
        return view('real-estates.create', [
            'cities' => $this->cities,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'location'    => 'required|in:' . implode(',', $this->cities),
            'image'       => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('real-estates', 'public');

        RealEstate::create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'location'    => $validated['location'],
            'image'       => $path,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('real-estates.index')->with('success', 'Property successfully added.');
    }

    public function edit(RealEstate $realEstate)
    {
        if ($realEstate->user_id !== Auth::id()) {
            abort(403);
        }

        return view('real-estates.edit', [
            'realEstate' => $realEstate,
            'cities' => $this->cities,
        ]);
    }

    public function update(Request $request, RealEstate $realEstate)
    {
        if ($realEstate->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'location'    => 'required|in:' . implode(',', $this->cities),
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($realEstate->image);
            $validated['image'] = $request->file('image')->store('real-estates', 'public');
        } else {
            $validated['image'] = $realEstate->image;
        }

        $realEstate->update($validated);

        return redirect()->route('real-estates.index')->with('success', 'The property has been updated.');
    }

    public function destroy(RealEstate $realEstate)
    {
        if ($realEstate->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($realEstate->image);
        $realEstate->delete();

        return redirect()->route('real-estates.index')->with('success', 'Property successfully deleted.');
    }
}
