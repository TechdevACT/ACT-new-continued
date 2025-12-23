<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'quote' => 'required|string',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('avatar')) {
            $path = '/storage/' . $request->file('avatar')->store('images/testimonials', 'public');
        }

        Testimonial::create([
            'name' => $request->name,
            'title' => $request->title,
            'quote' => $request->quote,
            'avatar' => $path,
        ]);

        return redirect()->back()->with('message', 'Testimonial added successfully');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'quote' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus gambar lama jika ada
            if ($testimonial->avatar) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $testimonial->avatar));
            }
            $path = '/storage/' . $request->file('avatar')->store('images/testimonials', 'public');
            $testimonial->avatar = $path;
        }

        $testimonial->update([
            'name' => $request->name,
            'title' => $request->title,
            'quote' => $request->quote,
        ]);

        return redirect()->back()->with('message', 'Testimonial updated successfully');
    }
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $testimonial->avatar));
        }
        $testimonial->delete();

        return redirect()->back()->with('message', 'Testimonial deleted successfully');
    }
}
