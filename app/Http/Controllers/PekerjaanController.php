<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\Tender;
use App\Models\Import;
use Illuminate\Http\Request;
use App\Imports\PekerjaanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;

class PekerjaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin|Buyer')->except(['pdf', 'rincian']);
        $this->middleware('role:Admin|Buyer|User')->only(['pdf', 'rincian']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tender $tender)
    {
        return view('auth.pekerjaan.create', [
            'tender' => $tender,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tender $tender, FlasherInterface $flasher)
    {
        $request->validate([
            'pekerjaan_add' => 'required|max:255',
            'volume_add' => 'required|numeric',
            'satuan_add' => 'required|max:255',
            'harga_add' => 'required|numeric',
            'keterangan_add' => 'max:16000000',
        ]);

        Pekerjaan::create([
            'pekerjaan' => $request->pekerjaan_add,
            'volume' => $request->volume_add,
            'satuan' => $request->satuan_add,
            'harga' => $request->harga_add,
            'keterangan' => $request->keterangan_add,
            'tender_id' => $tender->id
        ]);

        $flasher->addSuccess('Rincian Harga Berhasil Ditambahkan!');

        activity()->log('Menambahkan Rincian Harga ' . $request->pekerjaan_add);

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        return view('auth.pekerjaan.edit', [
            'pekerjaan' => $pekerjaan,
            'tender' => Tender::where('id', $pekerjaan->tender_id)->first(),
        ]);
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
            'pekerjaan' => 'required|max:255',
            'volume' => 'required|numeric',
            'satuan' => 'required|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'max:16000000',
        ]);

        Pekerjaan::where('id', $request->id)->update([
            'pekerjaan' => $request->pekerjaan,
            'volume' => $request->volume,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);

        $tender = Tender::where('id', $request->tender_id)->first();

        $flasher->addSuccess('Rincian Harga Berhasil Diperbarui!');

        activity()->log('Memperbarui Rincian Harga ' . $request->pekerjaan);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan, FlasherInterface $flasher)
    {
        $pekerjaan->delete();

        $flasher->addSuccess('Rincian Harga Berhasil Dihapus!');

        activity()->log('Menghapus Rincian Harga ' . $pekerjaan->pekerjaan);

        return redirect()->back();
    }

    public function rincian()
    {
        if (Auth::user()->roles->pluck('name')[0] == "Admin" || Auth::user()->roles->pluck('name')[0] == "Buyer") {
            $jobs = Pekerjaan::orderBy('pekerjaan', 'asc')->get();
        } elseif (Auth::user()->roles->pluck('name')[0] == "User") {
            $data = [];
            foreach (Auth::user()->bagian as $bagian) {
                array_push($data, $bagian->id);
            }
            $tender = Tender::whereHas('bagian', function ($q) use ($data) {
                $q->whereIn('bagian_id', $data);
            })->orderBy('created_at', 'desc')->pluck('id');

            $jobs = Pekerjaan::whereIn('tender_id', $tender)->orderBy('pekerjaan', 'asc')->get();
        };

        return view('auth.pekerjaan.rincian', [
            'jobs' => $jobs,
        ]);
    }

    public function historyView(Tender $tender)
    {
        return view('auth.pekerjaan.history', [
            'history' => Import::where('tender_id', $tender->id)->orderBy('id', 'desc')->get(),
            'tender' => $tender
        ]);
    }

    public function importView(Tender $tender)
    {
        return view('auth.pekerjaan.import', [
            'tender' => $tender
        ]);
    }

    public function import(Tender $tender, Request $request,  FlasherInterface $flasher)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new PekerjaanImport, $request->file('file'));

        $excel = $request->file('file');
        $nama_excel = Str::random(10) . '-' . $excel->getClientOriginalName();
        $excel->move('file_upload', $nama_excel);

        Import::create([
            'file' =>  $nama_excel,
            'tender_id' => $tender->id,
            'oleh' => Auth::user()->name,
        ]);

        $flasher->addSuccess('Uraian Pekerjaan Berhasil Diimport!');

        activity()->log('Import File Excel ' . $nama_excel);

        return redirect()->route('pekerjaan.history', ['tender' => $tender->id]);
    }

    public function download(Import $import)
    {
        $list_file = Import::find($import->id);
        $download = public_path() . '/file_upload/' . $list_file->file;
        return response()->download($download);
    }

    public function pdf(Tender $tender)
    {
        return view('auth.pekerjaan.pdf', [
            'pekerjaan' => Pekerjaan::where('tender_id', $tender->id)->get(),
            'tender' => $tender,
        ]);
    }
}
