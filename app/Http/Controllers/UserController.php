<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Flasher\Prime\FlasherInterface;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /*
     * Constructor.
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin')->except(['edit', 'update', 'userLog']);
        $this->middleware('role:Admin|Buyer')->only(['userLog']);
        $this->middleware('role:Admin|Buyer|User')->only(['edit', 'update']);
    }

    /*
     * Menampilkan List Pengguna Sistem.
     * 
     */
    public function index()
    {
        return view('auth.user.index', [
            "users" => User::all(),
        ]);
    }

    /*
     * Menampilkan Form Add Pengguna Sistem.
     * 
     */
    public function create()
    {
        return view('auth.user.create', [
            'bagian' => Bagian::all()
        ]);
    }

    /*
     * Menyimpan Informasi dalam Database.
     * 
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $userVal = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|unique:users',
            'role' => 'required',
            'bagian_id' => 'nullable',
            'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->bagian()->attach($request->bagian_id);

        $user->assignRole($request['role']);

        $flasher->addSuccess('Pengguna Sistem Berhasil Ditambahkan!');

        activity()->log('Menambahkan Pengguna Sistem ' . $request->name);

        return redirect()->route('user.index');
    }

    /*
     * Menampilkan Form Edit Password.
     * 
     */
    public function edit(User $user)
    {
        return view('auth.user.edit', compact('user'));
    }

    /*
     * Update Informasi dalam Database.
     * 
     */
    public function update(Request $request, User $user, FlasherInterface $flasher)
    {
        $request->validate([
            'password_lama' => ['required', 'string', 'min:8', new MatchOldPassword],
            'password_baru' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            'password_konfirmasi' => ['same:password_baru'],
        ]);

        $user->update([
            'password' => Hash::make($request['password_baru']),
        ]);

        $flasher->addSuccess('Password Berhasil Diubah!');

        activity()->log('Memperbarui Password ' . $user->name);

        return redirect()->back();
    }

    /*
     * Reset Password Pengguna Sistem.
     * 
     */
    public function resetPassword(User $user, FlasherInterface $flasher)
    {
        $user->update([
            'password' => Hash::make('Petrokimia1'),
        ]);

        $flasher->addSuccess('Password Pengguna Berhasil Direset!');

        activity()->log('Mereset Password ' . $user->name);

        return redirect()->back();
    }

    /*
     * Menghapus Pengguna Sistem.
     * 
     */
    public function destroy(User $user, FlasherInterface $flasher)
    {
        $user->bagian()->detach();
        $user->delete();

        $flasher->addSuccess('Pengguna Sistem Berhasil Dihapus!');

        activity()->log('Menghapus Pengguna Sistem ' . $user->name);

        return redirect()->back();
    }

    public function userLog()
    {
        return view('auth.log.index', [
            'users_log' => Activity::with('causer')->orderBy('created_at', 'desc')->limit(200)->get()
        ]);
    }
}
