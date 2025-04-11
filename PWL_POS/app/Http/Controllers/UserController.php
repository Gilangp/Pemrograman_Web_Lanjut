<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Menampilkan halaman user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar pada sistem'
        ];

        $activeMenu = 'user';
        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

        // Filter data berdasarkan level id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user) {
        $btn = '<button onclick="modalAction(\''.url('/user/' . $user->user_id).'\')" class="btn btn-info btn-sm">Detail</button> ';
        $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';
        $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    // Menampilkan halaman tambah user
    public function create()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create')->with('level', $level);
    }

    // Menyimpan data user baru
    public function store(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama'     => 'required|string|max:100',
                'password' => 'required|min:6'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $photoPath = null;
            if ($request->hasFile('photo'))
            {
                $photo = $request->file('photo');
                $originalName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $photo->getClientOriginalExtension();
                $timestamp = date('Ymd');
                $fileName = $originalName . '_' . $timestamp . '.' . $extension;

                $photoPath = $photo->storeAs('uploads/foto_user', $fileName, 'public');
            }

            UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
                'level_id' => $request->level_id,
                'photo' => $photoPath
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    // Menampilkan detail user
    public function show($id)
    {
        $user = UserModel::with('level')->find($id);

        return view('user.show', ['user' => $user]);
    }

    // Menampilkan halaman edit user
    public function edit($id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.edit', ['user' => $user, 'level' => $level]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,'.$id.',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:6|max:20'
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

            if ($user) {
                $data = [
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'level_id' => $request->level_id
                ];

                if ($request->filled('password')) {
                    $data['password'] = bcrypt($request->password);
                }

                if ($request->hasFile('photo')) {
                    if (!empty($user->photo) && Storage::disk('public')->exists($user->photo)) {
                        Storage::disk('public')->delete($user->photo);
                    }

                    $photo = $request->file('photo');
                    $fileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME) . '_' . date('Ymd') . '.' . $photo->getClientOriginalExtension();
                    $photoPath = $photo->storeAs('uploads/foto_user', $fileName, 'public');

                    $data['photo'] = $photoPath;
                }

                $user->update($data);

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // Menghapus data user
    public function confirm(string $id)
    {
        $user = UserModel::find($id);

        return view('user.confirm', ['user' => $user]);
    }

        public function delete(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);

            if ($user) {
                if (!empty($user->photo) && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }

                $user->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}
