<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RealEstate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RealEstateController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->query('location');
    
         $query = RealEstate::query();

    if ($location) {
        $query->where('location', $location);
    }

    $realEstates = $query->latest()->paginate(10);
    $locations = ['Beograd', 'Novi Sad', 'Čačak', 'Niš'];

    return view('real-estates.index', compact('realEstates', 'locations', 'location'));

    }

    public function create()
    {
        $cities = ['Beograd', 'Novi Sad', 'Čačak', 'Niš'];
        return view('real-estates.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|in:Beograd,Novi Sad,Čačak,Niš',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('real-estates', 'public');

        RealEstate::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'location' => $validated['location'],
            'image' => $path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('real-estates.index')->with('success', 'Nekretnina uspešno dodata.');
    }

    public function edit(RealEstate $realEstate)
    {
        if ($realEstate->user_id !== Auth::id()) {
            abort(403);
        }
        $cities = ['Beograd', 'Novi Sad', 'Čačak', 'Niš'];
        return view('real-estates.edit', compact('realEstate', 'cities'));
    }

    public function update(Request $request, RealEstate $realEstate)
    {
        if ($realEstate->user_id !== Auth::id()) {
        abort(403);
    }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|in:Beograd,Novi Sad,Čačak,Niš',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($realEstate->image);
            $validated['image'] = $request->file('image')->store('real-estates', 'public');
        } else {
            $validated['image'] = $realEstate->image; // zadrži staru
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

        return redirect()->route('real-estates.index')->with('success', 'Nekretnina uspešno obrisana.');
    }

}
