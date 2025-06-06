<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
{
    $realEstateId = $request->input('real_estate_id');

    if (!$realEstateId || !is_numeric($realEstateId)) {
        return response()->json(['error' => 'Invalid or missing real_estate_id'], 422);
    }

    $estate = RealEstate::find($realEstateId);
    if (!$estate) {
        return response()->json(['error' => 'Property not found'], 404);
    }

    $user = Auth::user();

    $alreadyFavorited = $user->favorites()->where('real_estate_id', $realEstateId)->exists();

    if ($alreadyFavorited) {
        $user->favorites()->detach($realEstateId);
        return response()->json(['status' => 'removed']);
    } else {
        $user->favorites()->attach($realEstateId);
        return response()->json(['status' => 'added']);
    }
}

    public function index()
    {
        $user = auth()->user();

        //$realEstates = RealEstate::whereIn('id', $user->favorites()->pluck('real_estate_id'))->get();
        $realEstates = $user->favorites()->get();

        return view('favorites.index', compact('realEstates'));
    }
}
