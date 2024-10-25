<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;
use App\Models\Jurusan;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;
    public $jurusanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
        $this->jurusanModel =new Jurusan();
    }

    public function index()
    {
        $data = [
            'users' => $this->userModel->getUser(),
        ];

        return view('list_user', $data);
    }

    public function create()
    {
        $kelas = $this->kelasModel->getKelas();
        $jurusan = Jurusan::all();

        $user = new UserModel();

        $data = [
            'kelas' => $kelas,
            'jurusan'=> $jurusan,
            'user' => $user,
        ];

        return view('create_user', $data);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'npm' => 'required|string|max:255|unique:user,npm',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('uploads', $fotoName);
        } else {
            $fotoPath = null; 
        }

        $this->userModel->create([
            'nama' => $validatedData['nama'],
            'npm' => $validatedData['npm'],
            'kelas_id' => $validatedData['kelas_id'],
            'jurusan_id' => $validatedData['jurusan_id'], 
            'foto' => $fotoPath ? $fotoName : null,
        ]);

        return redirect()->to('/')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user' => $user,
        ];

        return view('profile', $data);
    }

    public function edit ($id)
    {
        $user = UserModel::findorFail($id);
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $title = 'Edit User';
        return view('edit_user', compact('user','kelas','title'));
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->kelas_id = $request->kelas_id;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('uploads', $fotoName); 
            $user->foto = $fotoName; 
        }

        $user->save();

        return redirect()->to('/')->with('success', 'User berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete(); 
    
        return redirect()->route('user.list')->with('success', 'User has been deleted successfully');
    }
    
}