<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

class BagianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin|Buyer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.bagian.index', [
            'bagian' => Bagian::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  FlasherInterface $flasher)
    {
        $request->validate([
            'bagian_add' => 'required|max:255',
        ]);

        Bagian::create([
            'bagian' => $request->bagian_add,
        ]);

        $flasher->addSuccess('User Berhasil Ditambahkan!');

        activity()->log('Menambahkan User ' . $request->bagian_add);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'bagian' => 'required|max:255'
        ]);

        Bagian::where('id', $request->id)->update([
            'bagian' => $request->bagian
        ]);

        $flasher->addSuccess('User Berhasil Diperbarui!');

        activity()->log('Memperbarui User ' . $request->bagian);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagian $bagian, FlasherInterface $flasher)
    {
        try {
            $bagian->delete();
            $flasher->addSuccess('User Berhasil Dihapus!');
            activity()->log('Menghapus User ' . $bagian->bagian);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                $flasher->addError('User Tidak Dapat Dihapus!');
                activity()->log('Tidak Dapat Menghapus User ' . $bagian->bagian);
            }
        }

        return redirect()->back();
    }
}
