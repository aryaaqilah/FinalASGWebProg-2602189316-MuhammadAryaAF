<?php

namespace App\Http\Controllers;

use App\Models\Mutual;
use App\Models\Thumb;
use App\Models\User;
use App\Notifications\ThumbAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MutualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserID = Auth::user()->id;
        $dataFriend = Mutual::where('id_usr_a', '=', $currentUserID)->join('users', 'users.id', '=', 'mutuals.id_usr_b')->get(['users.*']);

        return view('mutual', compact('dataFriend'));
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
        $currentUserID = Auth::user()->id;
        $friendID = $request->input('friend_id');
        $request_id = $request->input('request_id');

        // Create the friendship
        $friend = Mutual::create([
            'id_usr_a' => $currentUserID,
            'id_usr_b' => $friendID
        ]);

        // Create the reciprocal friendship
        $friend2 = Mutual::create([
            'id_usr_a' => $friendID,
            'id_usr_b' => $currentUserID
        ]);

        // Update the friend request status
        $updateRequest = Thumb::find($request_id);
        $updateRequest->status = 'accepted';
        $updateRequest->save();

        // Notify the user whose request was accepted
        $receiver = User::find($friendID);
        $receiver->notify(new ThumbAccepted($currentUserID));

        return redirect()->route('friend-request.index')->with('success', 'Friend request accepted and notification sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mutual $mutual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutual $mutual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutual $mutual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mutual $mutual)
    {
        //
    }
}
