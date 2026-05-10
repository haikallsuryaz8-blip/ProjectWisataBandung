<?php

namespace App\Http\Controllers;


use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Validation Rules
     */
    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'visitors' => 'required|integer|min:0',
            'ticket_price' => 'nullable|numeric|min:0',
            'opening_hours' => 'nullable|string|max:255',
            'maps_url' => 'nullable|url|max:2048',
            'video_url' => 'nullable|url|max:2048',

            // FILES
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:place_photos,id',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:10240',
        ];
    }

    /**
     * Upload Image
     */
    private function uploadImage(Request $request, ?string $oldImage = null): ?string
    {
        if (!$request->hasFile('image')) {
            return $oldImage;
        }

        // Delete old image
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        return $request->file('image')->store('places/images', 'public');
    }

    /**
     * Upload Video
     */
    private function uploadVideo(Request $request, ?string $oldVideo = null): ?string
    {
        if (!$request->hasFile('video')) {
            return $oldVideo;
        }

        // Delete old video
        if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
            Storage::disk('public')->delete($oldVideo);
        }

        return $request->file('video')->store('places/videos', 'public');
    }

    /**
     * Upload gallery photos
     */
    private function uploadPhotos(Request $request, Place $place): void
    {
        if (!$request->hasFile('photos')) {
            return;
        }

        foreach ($request->file('photos') as $photo) {
            $place->photos()->create([
                'path' => $photo->store('places/photos', 'public'),
            ]);
        }
    }

    /**
     * Delete selected gallery photos
     */
    private function deleteSelectedPhotos(Request $request, Place $place): void
    {
        if (!$request->filled('delete_photos')) {
            return;
        }

        $photos = $place->photos()
            ->whereIn('id', $request->input('delete_photos', []))
            ->get();

        foreach ($photos as $photo) {
            if (Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }

            $photo->delete();
        }
    }

    /**
     * Display listing
     */
    public function index(Request $request)
    {
        $allowedSort = [
            'id',
            'name',
            'rating',
            'visitors',
            'ticket_price'
        ];

        $sortBy = in_array($request->sort_by, $allowedSort)
            ? $request->sort_by
            : 'id';

        $sortDir = $request->sort_dir === 'asc'
            ? 'asc'
            : 'desc';

        $query = Place::query();

        /**
         * SEARCH
         */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }

        /**
         * FILTER CATEGORY
         */
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $places = $query
    ->orderBy($sortBy, $sortDir)
    ->paginate(12)
    ->appends($request->query());


        return view('places.index', compact('places'));
    }

    /**
     * Create form
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store data
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        /**
         * Upload image
         */
        $imagePath = $this->uploadImage($request);

        if ($imagePath) {
            $validated['image'] = $imagePath;
        }

        /**
         * Upload video
         */
        $videoPath = $this->uploadVideo($request);

        if ($videoPath) {
            $validated['video_path'] = $videoPath;
        }

        /**
         * Remove field video
         */
        unset($validated['video']);

        unset($validated['photos'], $validated['delete_photos']);

        $place = Place::create($validated);
        $this->uploadPhotos($request, $place);

        return redirect()
            ->route('places.index')
            ->with('success', 'Place created successfully.');
    }

    /**
     * Show single data
     */
    public function show(Place $place)
    {
        $place->load([
            'photos',
            'comments.user',
        ]);

        return view('places.show', compact('place'));
    }

    /**
     * Edit form
     */
    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    /**
     * Update data
     */
    public function update(Request $request, Place $place)
    {
        $validated = $request->validate($this->rules());

        /**
         * Upload image
         */
        $imagePath = $this->uploadImage(
            $request,
            $place->image
        );

        if ($imagePath) {
            $validated['image'] = $imagePath;
        }

        /**
         * Upload video
         */
        $videoPath = $this->uploadVideo(
            $request,
            $place->video_path
        );

        if ($videoPath) {
            $validated['video_path'] = $videoPath;
        }

        /**
         * Remove field video
         */
        unset($validated['video'], $validated['photos'], $validated['delete_photos']);

        $place->update($validated);
        $this->deleteSelectedPhotos($request, $place);
        $this->uploadPhotos($request, $place);

        return redirect()
            ->route('places.index')
            ->with('success', 'Place updated successfully.');
    }

    /**
     * Delete data
     */
    public function destroy(Place $place)
    {
        /**
         * Delete image
         */
        if (
            $place->image &&
            Storage::disk('public')->exists($place->image)
        ) {
            Storage::disk('public')->delete($place->image);
        }

        /**
         * Delete video
         */
        if (
            $place->video_path &&
            Storage::disk('public')->exists($place->video_path)
        ) {
            Storage::disk('public')->delete($place->video_path);
        }

        foreach ($place->photos as $photo) {
            if (Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }
        }

        $place->delete();

        return redirect()
            ->route('places.index')
            ->with('success', 'Place deleted successfully.');
    }
}
