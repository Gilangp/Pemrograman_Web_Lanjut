<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', ['user' => $user]);
    }

    // Menampilkan form untuk edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $id = auth()->user()->user_id;

        $rules = [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|max:100',
            'password' => 'nullable|min:6|max:20',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }

        $user = UserModel::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Data pengguna tidak ditemukan.'
            ]);
        }

        $data = [
            'username' => $request->username,
            'nama' => $request->nama
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            // menghapus foto lama
            if (!empty($user->photo) && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // upload foto baru
            $photo = $request->file('photo');
            $fileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)
                . '_' . date('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('uploads/foto_user', $fileName, 'public');

            $data['photo'] = $photoPath;
        }

        $user->update($data);

        return redirect('/');
    }
}
