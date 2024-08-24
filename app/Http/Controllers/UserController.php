<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use App;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register');
    }

    public function index2(Request $request)
{

    $loc = session()->get('locale');
        App::setLocale($loc);


    if (!Auth::check()) {
        return redirect('/login'); // Redirect to the login page if the user is not authenticated
    }

    $currentUserID = Auth::user()->id;
    $searchTerm = $request->input('search');
    $genderFilter = $request->input('gender');
    $hobbiesFilter = $request->input('hobby'); // Retrieve the hobby filter from the request

    // Subquery to get the list of users who have sent a request to the current user
    $sentRequestUserIDs = DB::table('thumbs')
        ->where('id_usr_a', '=', $currentUserID)
        ->pluck('id_usr_b');

    // Subquery to get the list of users who are already friends with the current user
    $friendUserIDs = DB::table('mutuals')
        ->where('id_usr_a', '=', $currentUserID)
        ->pluck('id_usr_b');

    // Query to get users who have not sent a friend request to the current user
    $dataUser = User::whereNotIn('id', $sentRequestUserIDs)
        ->whereNotIn('id', $friendUserIDs)
        ->where('id', '!=', $currentUserID)
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%');
        })
        ->when($genderFilter, function ($query, $genderFilter) {
            return $query->where('gender', $genderFilter);
        })
        ->when($hobbiesFilter, function ($query, $hobbiesFilter) {
            foreach ($hobbiesFilter as $hobby) {
                $query->where('hobbies', 'like', '%' . $hobby . '%');
            }
            return $query;
        })
        ->get();

    return view('home', compact('dataUser'));
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
        // dd($request);
        $rules = [
            "username" => "required",
            "name" => "required",
            "instagram" => "required|url|regex:/^https?:\/\/(www\.)?instagram\.com\/[A-Za-z0-9_.]+\/?$/",
            "password" => "required|min:3|max:255",
            "gender" => "required",
            "hobby" => "required|array|min:3",
        ];


        $message = [
            'required' => ':attribute wajib diisi',
            'password.min' => ':attribute minimal berisi :min karakter',
            'password.max' => ':attribute maksimal berisi :max karakter',
            'hobby.min' => ':attribute harus memilih :min hobby',
            'regex' => ':attribute harus berawalan http://www.instagram.com/'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
            ->withInput()
            ->withErrors($validator)
            ->with('danger', 'Pastikan semua field diisi');
        }else {
            //Store
            $simpanProfile = User::create([
                'email' => $request->username,
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'insta_username' => $request->instagram,
                'gender' => $request->gender,
                'hobbies' => implode(',', (array) $request->input('hobby')),
                'register_price' => rand(100000,125000)
            ]);
        }
        // dd($request);
        $user = User::where('email', $request['username'])->first();
        Auth::login($user);
        return redirect()->route('pay');
    }

    public function payment(){

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function language(Request $request, string $lang)
    {
        // Set locale
        App::setLocale($lang);
        // dd($lang);

        // Store language preference in session
        $request->session()->put('locale', $lang);

        // Redirect to the home page after changing language
        return redirect('/home');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Menambah balance sebanyak 100
    public function addBalance(Request $request)
    {
        $user = Auth::user();
        $user->balance += 100;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Balance increased by 100!');
    }

    public function toggleVisibility(Request $request)
    {
        $user = Auth::user();
        $cost = 100; // Biaya untuk menyembunyikan profil

        if ($user->balance >= $cost) {
            // Kurangi saldo pengguna
            $user->balance -= $cost;

            // Jika profil saat ini terlihat, sembunyikan dan ganti foto profil
            if ($user->is_visible) {
                $user->is_visible = false;
                $user->profile_path = 'images/bear.png';
            } else {
                // Jika profil saat ini tidak terlihat, tampilkan kembali
                $user->is_visible = true;
                $user->profile_path = null; // Atur ke nilai default atau avatar yang sudah dipilih
            }

            // Simpan perubahan
            $user->save();

            return redirect()->route('profile.show')->with('success', $user->is_visible ? 'Profile is now visible!' : 'Profile is now hidden and balance has been deducted.');
        } else {
            return redirect()->route('profile.show')->with('error', 'Insufficient balance to change profile visibility.');
        }
    }
}
