<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\Uraian;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UraianController extends Controller
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
    public function index(Tender $tender, Uraian $uraian)
    {
        $count = 0;

        if ($uraian->id == null) {
            $details = Uraian::where('tender_id', $tender->id)->get();
        } else {
            $count = 1;
            $details = Uraian::where('tender_id', $uraian->tender_id)->get();
            $tender = Tender::where('id', $uraian->tender_id)->first();
        }

        $vendor = Vendor::all();

        return view('auth.uraian.index', [
            'details' => $details,
            'tender' => $tender,
            'vendor' => $vendor,
            'uraian' => $uraian,
            'count' => $count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tender $tender,  FlasherInterface $flasher)
    {
        $request->validate([
            'no_sp' => 'required|max:255',
            'no_agreement' => 'required|max:255',
            'vendor' => 'required',
            'prosentase' => 'max:255',
            'kontrak' => 'nullable|mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('kontrak')) {
            $kontrak = $request->file('kontrak');
            $nama_kontrak = Str::random(30) . '.' . $kontrak->getClientOriginalExtension();
            $kontrak->move('file_upload', $nama_kontrak);
        }

        Uraian::create([
            'tender_id' => $tender->id,
            'vendor_id' => $request->vendor,
            'no_sp' => $request->no_sp,
            'no_agreement' => $request->no_agreement,
            'prosentase' => $request->prosentase,
            'kontrak' => $nama_kontrak ?? $request->kontrak,
            'oleh' => Auth::user()->name,
        ]);

        $flasher->addSuccess('Detail Pekerjaan Berhasil Ditambahkan!');

        activity()->log('Menambahkan Detail Pekerjaan ' . $tender->tender);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uraian $uraian, FlasherInterface $flasher)
    {
        $request->validate([
            'no_sp' => 'required|max:255',
            'no_agreement' => 'required|max:255',
            'vendor' => 'required',
            'prosentase' => 'max:255',
            'kontrak' => 'nullable|mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('kontrak')) {
            $kontrak = $request->file('kontrak');
            $nama_kontrak = Str::random(30) . '.' . $kontrak->getClientOriginalExtension();
            $kontrak->move('file_upload', $nama_kontrak);
        }
        
        $tender = Tender::where('id', $uraian->tender_id)->first();

        $uraian->update([
            'vendor_id' => $request->vendor,
            'no_sp' => $request->no_sp,
            'no_agreement' => $request->no_agreement,
            'prosentase' => $request->prosentase,
            'kontrak' => $nama_kontrak ?? $uraian->kontrak,
        ]);

        $flasher->addSuccess('Detail Pekerjaan Berhasil Diperbarui!');

        activity()->log('Memperbarui Detail Pekerjaan ' . $tender->tender);

        return redirect()->route('uraian.index', ['tender' => $tender->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uraian $uraian, FlasherInterface $flasher)
    {
        $tender = Tender::where('id', $uraian->tender_id)->first();
        $uraian->delete();

        $flasher->addSuccess('Detail Pekerjaan Berhasil Dihapus!');

        activity()->log('Menghapus Detail Pekerjaan ' . $tender->tender);

        return redirect()->route('uraian.index', ['tender' => $tender->id]);
    }

    public function download(Uraian $uraian)
    {
        $list_file = Uraian::find($uraian->id);
        $download = public_path() . '/file_upload/' . $list_file->kontrak;
        return response()->download($download);
    }
}
