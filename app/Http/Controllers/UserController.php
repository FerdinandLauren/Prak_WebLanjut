<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Faker\Provider\UserAgent;

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

    public function show($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = Kelas::findOrFail($user->kelas_id);

        $title = 'Detail' . $user->nama;

        return view('show_user', compact('user','kelas','title'));
    }

    // public function show($id){
    //     $user = $this->userModel->getUser($id);

    //     $data = [
    //         'title' => 'Profile',
    //         'user' => $user,

    //     ];

    //     return view ('profile', $data);
    // }

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
            $fotoPath = $foto->move(public_path('upload/img'), $fotoName); // Pindahkan file
            $user->foto = $fotoName; // Simpan nama file ke database
        }

        $user->save();

        return redirect()->route('user.list')->with('success', 'user updated successfully');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete(); // Memanggil fungsi delete
    
        return redirect()->route('user.list')->with('success', 'User has been deleted successfully');
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