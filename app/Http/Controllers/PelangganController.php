<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Pelanggan;
use App\Sample;
use Carbon\Carbon;
use Hash;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit()
    {
        $user = Auth::user();

        return View('users.profile.edit', ['user' => $user,]);
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'profile' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $time = Carbon::now()->timestamp;
        $profile = $request->file('profile');
        $user = Auth::user();
        if (isset($profile)) {
            if ($user->profile != 'images/profile/default.png') {
                Storage::delete($user->profile);
            }

            $profileUrl = $profile->storeAs("images/profile", "{$user->id}_{$time}.{$profile->extension()}");
            $user->update([
                'profile' => $profileUrl
            ]);
        }
        if ($request->name != $user->name) {
            $user->update([
                'name' => $request->name,
            ]);
        }
        if (isset($user->pelanggan)) {
            Pelanggan::find($user->pelanggan->id)->update([
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);
        } else {

            Pelanggan::create([
                'user_id' => $user->id,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);
        }
        return redirect()->to('/profile')->with('success', 'Profile berhasil diedit');
    }
    public function show_profile()
    {
        $user = Auth::user();
        $total = Sample::where('user_id', $user->id)->count();
        return view('users.profile.profile', [
            'user' => $user,
            'total' => $total,
        ]);
    }
    public function ubahpassword()
    {
        return view('users.profile.ubah_password');
    }
    public function saveUbahpassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $curpass = auth()->user()->password;
        $oldpass = $request->old_password;
        
        if(Hash::check($oldpass, $curpass)){
            auth()->user()->update([
                'password' => bcrypt($request->password)
            ]);

            return redirect()->route('profile')->with('success', 'Password berhasil diubah');
        }else{
            return back()->withErrors(['old_password' => 'Make sure you fill your current password']);
        }

    }
    public function info()
    {
        return view('users.info');
    }
}
