<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = Avatar::all();
        return view('avatar', compact('avatars'));
    }

    // Proses pembelian avatar
    public function purchase(Request $request, $id)
    {
        $user = Auth::user();
        $avatar = Avatar::findOrFail($id);

        if ($user->balance >= $avatar->price) {
            // Kurangi balance pengguna
            $user->balance -= $avatar->price;

            // Update foto profil dengan path avatar
            $user->profile_path = $avatar->image_path;

            // Simpan perubahan
            $user->save();

            return redirect()->route('avatars.index')->with('success', 'Avatar purchased and set as profile picture!');
        } else {
            return redirect()->route('avatars.index')->with('error', 'Insufficient balance to purchase this avatar.');
        }
    }
}
