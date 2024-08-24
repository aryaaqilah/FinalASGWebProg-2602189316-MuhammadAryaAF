<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Cari user berdasarkan username
    $user = User::where('email', $credentials['username'])->first();

    // Verifikasi password
    if ($user && Hash::check($credentials['password'], $user->password)) {
        // Login user jika autentikasi berhasil
        Auth::login($user);

        return redirect('/home')->with('success', 'Login berhasil!');
    }

    // Jika login gagal, kembali ke halaman login dengan pesan error
    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
}

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('/login');
    }

    public function update_paid(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'price' => 'required|numeric',
        ]);

        $paymentAmount = $validatedData['payment_amount'];
        $price = $validatedData['price'];
        $difference = $paymentAmount - $price;

        $user = Auth::user();

        if ($difference < 0) {
            // User underpaid
            return redirect()->back()->with('error', 'You are still underpaid $' . number_format(-$difference, 2));
        } elseif ($difference > 0) {
            // User overpaid
            return redirect()->route('handle.overpayment', [
                'amount' => $difference,
                'payment_amount' => $paymentAmount,
                'price' => $price
            ]);
        } else {
            // Payment is exact
            // Mark payment as successful and handle business logic
            $user->has_paid = true;
            // $user->save();
            return redirect()->route('user.index2');
        }
    }

    public function handleOverpayment(Request $request)
    {
        $amount = $request->input('amount');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');

        // Show a view or dialog to handle overpayment
        return view('overpayment', [
            'amount' => $amount,
            'payment_amount' => $paymentAmount,
            'price' => $price
        ]);
    }

    public function processOverpayment(Request $request)
    {
        $action = $request->input('action');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');
        $user = Auth::user();

        if ($action === 'accept') {
            // Add the overpaid amount to the user's wallet balance
            $amount = $request->input('amount');
            // Assume a wallet balance attribute exists on the user
            $user->coins += $amount;
            $user->has_paid = true;
            // $user->save();


            return redirect()->route('user.index2')->with('success', 'The excess amount has been added to your wallet.');
        } else {
            // Redirect back to the payment form to correct the amount
            return redirect()->route('pay')->with('error', 'Please enter the correct payment amount.');
        }
    }
}
