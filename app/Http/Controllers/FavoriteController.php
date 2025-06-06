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

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('real_estate_id', $realEstateId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'real_estate_id' => $realEstateId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function index()
    {
        $user = auth()->user();

        // Uzimamo samo nekretnine iz omiljenih
        $realEstates = RealEstate::whereIn('id', $user->favorites()->pluck('real_estate_id'))->get();

        return view('favorites.index', compact('realEstates'));
    }
}
