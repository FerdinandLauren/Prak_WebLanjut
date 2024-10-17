<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index() 
    { 
        $users = $this->userModel->getUser(); // Ambil data user dari model
        
        $data = [ 
            'title' => 'Create User', 
            'users' => $users,
            'kelas' => $this->userModel->getUser(), // Kirim variabel $users ke view
        ]; 

        return view('list_user', $data); 
    }


    // public function index() 
    // { 
    //     $data = [ 
    //         'title' => 'Create User', 
    //         'kelas' => $this->userModel->getUser(), 
    //     ]; 
    
    //     return view('list_user', $data); 
    // }

    public function create(){

        $kelas = $this->kelasModel->getKelas();

        // $kelasModel = new Kelas ();

        // $kelas = $kelasModel->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
        // return view('create_user', [
        //     'kelas' => Kelas::all(),
        // ]);
    }

    public function store(Request $request) 
    { 
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')){
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->move(public_path('upload/img'), $fotoName); // Pindahkan ke folder upload/img dengan nama yang baru
            // $fotoPath = $foto->move (('upload/img'), $foto);
        } else {
            $fotoPath = null;
        }

        $this->userModel->create([ 
        'nama' => $request->input('nama'), 
        'npm' => $request->input('npm'), 
        'kelas_id' => $request->input('kelas_id'),
        'foto' => $fotoPath ? $fotoName : null,
        ]); 
        return redirect()->to('/user')->with('success','user berhasil ditambahkan'); 
    }

    public function show($id){
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user' => $user,

        ];

        return view ('profile', $data);
    }

    // public function store(UserRequest $request)
    // {
    //     $validatedData = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'npm' => 'required|string|max:255',
    //         'kelas_id' => 'required|exists:kelas,id',
    //        ]);

    //        $user = $this->userModel->create($validatedData);

    //     //    $user = UserModel::create($validatedData);
           
    //        $user->load('kelas');

    //     return view('profile', [
    //         'nama' => $user->nama,
    //         'npm' => $user->npm,
    //         'nama_kelas' => $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan',
            
    //     ]);
    // }
}