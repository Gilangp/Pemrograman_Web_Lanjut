<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    // Tambah Data
    public function create()
    {
        return view('user.create');
    }

    public function createAdd(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->namaUser,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->idLevel
        ]);

        return redirect('/user');
    }

    // Edit Data
    public function edit($id)
    {
        $user = UserModel::find($id);
        return view('user.edit', ['data' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->namaUser;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->idLevel;

        $user->save();

        return redirect('/user');
    }

    // Hapus Data
    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
}
