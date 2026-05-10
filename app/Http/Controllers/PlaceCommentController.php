<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceCommentController extends Controller
{
    public function store(Request $request, Place $place)
    {
        $validated = $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        $place->comments()->create([
            'user_id' => $request->user()->id,
            'rating' => $validated['rating'] ?? null,
            'comment' => $validated['comment'],
        ]);

        return redirect()
            ->route('places.show', $place)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
