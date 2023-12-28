<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            "review" => "required|string|max:255",
            "rating" => "required|numeric|between:1,5",
            "image" => "image|file|max:10000",
        ], [
            'review.required' => 'Review wajib diisi!',
            'review.string' => 'Review wajib berupa karakter!',
            'review.max' => 'Maksimal :max karakter!',
            'rating.required' => 'Rating wajib diisi!',
            'rating.numeric' => 'Rating wajib berupa angka!',
            'rating.between' => 'Rating wajib berada dalam rentang 1 sampai 5!',
            'image.image' => 'File wajib berupa gambar!',
            'image.max' => 'Maksimal ukuran gambar 10MB!',
        ]);

        $user_id = Auth::user()->id;
        $date = now();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('foto_ulasan', ['disk' => 'public']);
            Testimony::create([
                'user_id' => $user_id,
                'product_id' => $id,
                'review' => $validatedData['review'],
                'rating' => $validatedData['rating'],
                'image' => $validatedData['image'],
                'date' => $date
            ]);
        } else {
            Testimony::create([
                'user_id' => $user_id,
                'product_id' => $id,
                'review' => $validatedData['review'],
                'rating' => $validatedData['rating'],
                'date' => $date
            ]);
        }
        return back()->with('addTestimony_success', 'Ulasan anda berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimony $testimony)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "review" => "required|string|max:255",
            "rating" => "required|numeric|between:1,5",
            "image" => "image|file|max:10000",
        ], [
            'review.required' => 'Review wajib diisi!',
            'review.string' => 'Review wajib berupa karakter!',
            'review.max' => 'Maksimal :max karakter!',
            'rating.required' => 'Rating wajib diisi!',
            'rating.numeric' => 'Rating wajib berupa angka!',
            'rating.between' => 'Rating wajib berada dalam rentang 1 sampai 5!',
            'image.image' => 'File wajib berupa gambar!',
            'image.max' => 'Maksimal ukuran gambar 10MB!',
        ]);

        $date = now();

        $testimony = Testimony::where('product_id', $id)->first();

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('foto_ulasan', ['disk' => 'public']);

            $testimony->update([
                'review' => $validatedData['review'],
                'rating' => $validatedData['rating'],
                'image' => $validatedData['image'],
                'date' => $date
            ]);
        } else {
            $testimony->update([
                'review' => $validatedData['review'],
                'rating' => $validatedData['rating'],
                'date' => $date
            ]);
        }

        return back()->with('updateTestimony_success', 'Ulasan anda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimony = Testimony::where('id', $id)->first();
        if ($testimony->image != null) {
            Storage::disk('public')->delete($testimony->image);
        }
        $testimony->delete();
        return back()->with('deleteTestimony_success', 'Ulasan anda berhasil dihapus!');
    }
}
