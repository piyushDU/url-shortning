<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortenedURL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class URLController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function urls($short_url="")
    {
        $url = ShortenedURL::where('short_url', $short_url)->first();
        if($url) { 
            return redirect($url->original_url);
        } 
        return view('dashboard');
    }
    
    public function shortenURL(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url|max:255',
        ]);

        $user = Auth::user();
        if ($user->shortenedURLs()->count() >= 10) {
            return response()->json(['error' => 'You have reached the limit of 10 shortened URLs.'], 422);
        }
        do {
            $short_url = Str::random(6);
        } while (ShortenedURL::where('short_url', $short_url)->exists());

        $shortenedURL = new ShortenedURL();
        $shortenedURL->original_url = $request->original_url;
        $shortenedURL->short_url = $short_url;
        $shortenedURL->user_id = $user->id;
        $shortenedURL->save();

        return response()->json(['shortened_url' => $short_url]);
    }

    public function listURLs()
    {
        $user = Auth::user();
        $urls = $user->shortenedURLs()->latest()->get();
        return view('urls.list', compact('urls'));
    }

    public function editURL($id)
    {
        $url = ShortenedURL::findOrFail($id);
        return view('urls.edit', compact('url'));
    }

    public function updateURL(Request $request, $id)
    {
        $request->validate([
            'original_url' => 'required|url|max:255',
        ]);

        $url = ShortenedURL::findOrFail($id);
        $url->original_url = $request->original_url;
        $url->save();

        return redirect()->route('urls.list');
    }

    public function deleteURL($id)
    {
        $url = ShortenedURL::findOrFail($id);
        $url->delete();

        return redirect()->route('urls.list');
    }

    public function deactivateURL($id, $isActive)
    {
        $url = ShortenedURL::findOrFail($id);
        $url->active = $isActive == 0 ? false: true;
        $url->save();

        return redirect()->route('urls.list');
    }
}
