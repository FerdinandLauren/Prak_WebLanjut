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
            'title' => 'List of Users', 
            'users' => $users, // Kirim variabel $users ke view
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
        $this->userModel->create([ 
        'nama' => $request->input('nama'), 
        'npm' => $request->input('npm'), 
        'kelas_id' => $request->input('kelas_id'), 
        ]); 
        return redirect()->route('users.index'); 
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