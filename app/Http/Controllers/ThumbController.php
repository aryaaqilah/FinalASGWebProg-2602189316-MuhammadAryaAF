<?php

namespace App\Http\Controllers;

use App\Models\Thumb;
use App\Models\User;
use App\Notifications\ThumbAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ThumbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loc = session()->get('locale');
        App::setLocale($loc);
        $currentUserID = Auth::user()->id;
        $friendRequest = Thumb::where('thumbs.id_usr_b', '=', $currentUserID)->where('thumbs.status', '=', 'pending')->join('users', 'users.id', '=', 'thumbs.id_usr_a')->get(['thumbs.id as request_id', 'users.*']);

        return view('request', compact('friendRequest'));

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
    public function store(Request $request)
    {
        $sender_id = Auth::user()->id;
        $receiver_id = $request->input('receiver_id');

        $friendRequest = Thumb::create([
            'id_usr_a' => $sender_id,
            'id_usr_b' => $receiver_id
        ]);

        if ($friendRequest) {
            return redirect()->route('user.index2')->with('success', 'Friend request sent');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Thumb $thumb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thumb $thumb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thumb $thumb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $thumb)
    {
        // dd($thumb);
        $deleteRequest = Thumb::destroy($thumb);

        return redirect()->route('friend-request.index')->with('success', 'Succesfully Delete');

    }

    public function accept(Request $request, $id)
    {
        $friendRequest = Thumb::find($id);

        if ($friendRequest && $friendRequest->id_usr_b == Auth::user()->id) {
            // Update status menjadi accepted
            $friendRequest->status = 'accepted';
            $friendRequest->save();

            // Mengambil pengguna pengirim permintaan
            $sender = User::find($friendRequest->id_usr_a);

            // Mengirim notifikasi ThumbAccepted kepada pengirim permintaan
            $sender->notify(new ThumbAccepted());

            return redirect()->route('friend-request.index')->with('success', 'Friend request accepted');
        }

        return redirect()->route('friend-request.index')->with('error', 'Friend request not found or not authorized');
    }
}
