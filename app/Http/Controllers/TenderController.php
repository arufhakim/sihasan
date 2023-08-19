<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Pekerjaan;
use App\Models\Tender;
use App\Models\Vendor;
use App\Models\Uraian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin|Buyer')->except(['index', 'show', 'filter']);
        $this->middleware('role:Admin|Buyer|User')->only(['index', 'show', 'filter']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles->pluck('name')[0] == "Admin" || Auth::user()->roles->pluck('name')[0] == "Buyer") {
            $tender = Tender::orderBy('created_at', 'desc')->get();
        } elseif (Auth::user()->roles->pluck('name')[0] == "User") {
            $data = [];
            foreach (Auth::user()->bagian as $bagian) {
                array_push($data, $bagian->id);
            }
            $tender = Tender::whereHas('bagian', function ($q) use ($data) {
                $q->whereIn('bagian_id', $data);
            })->orderBy('created_at', 'desc')->get();
        };

        return view('auth.tender.index', [
            'tenders' => $tender,
            'bagian' => Bagian::all()
        ]);
    }

    public function filter($name)
    {
        if (Auth::user()->roles->pluck('name')[0] == "Admin" || Auth::user()->roles->pluck('name')[0] == "Buyer") {
            if ($name == 'rincian') {
                $pekerjaan = Pekerjaan::all()->pluck('tender_id');
                $tender = Tender::whereNotIn('id', $pekerjaan)->orderBy('created_at', 'desc')->get();
            } elseif ($name == 'detail') {
                $uraian = Uraian::all()->pluck('tender_id');
                $tender = Tender::whereNotIn('id', $uraian)->orderBy('created_at', 'desc')->get();
            } elseif ($name = 'tanggal') {
                $tender = Tender::where('periode_akhir', '>', Carbon::now())->orderBy('created_at', 'desc')->get();
            }
        } elseif (Auth::user()->roles->pluck('name')[0] == "User") {
            $data = [];
            foreach (Auth::user()->bagian as $bagian) {
                array_push($data, $bagian->id);
            }
            if ($name == 'rincian') {
                $pekerjaan = Pekerjaan::all()->pluck('tender_id');
                $tender = Tender::whereHas('bagian', function ($q) use ($data) {
                    $q->whereIn('bagian_id', $data);
                })->whereNotIn('id', $pekerjaan)->orderBy('created_at', 'desc')->get();
            } elseif ($name == 'detail') {
                $uraian = Uraian::all()->pluck('tender_id');
                $tender = Tender::whereHas('bagian', function ($q) use ($data) {
                    $q->whereIn('bagian_id', $data);
                })->whereNotIn('id', $uraian)->orderBy('created_at', 'desc')->get();
            } elseif ($name == 'tanggal') {
                $tender = Tender::whereHas('bagian', function ($q) use ($data) {
                    $q->whereIn('bagian_id', $data);
                })->where('periode_akhir', '>', Carbon::now())->orderBy('created_at', 'desc')->get();
            }
        };

        return view('auth.tender.filter', [
            'tenders' => $tender,
            'bagian' => Bagian::all(),
            'name' => $name
        ]);
    }

    // public function create()
    // {
    //     return view('auth.tender.create', [
    //         'vendor' => Vendor::orderBy('no', 'asc')->get()
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'no_pr_add' => 'required|max:255',
            'tender_add' => 'required|max:255',
            'periode_awal_add' => 'required|date_format:Y-m-d',
            'periode_akhir_add' => 'required|date_format:Y-m-d',
            'bagian_add' => 'required|max:255',
            'keterangan_add' => 'max:16000000',
        ]);

        $tender = Tender::create([
            'no_pr' => $request->no_pr_add,
            'tender' => $request->tender_add,
            'periode_awal' => $request->periode_awal_add,
            'periode_akhir' => $request->periode_akhir_add,
            'keterangan' => $request->keterangan_add,
            'oleh' => Auth::user()->name,
            'slug' => Str::random(30) . "-" . time()
        ]);

        $tender->bagian()->attach($request->bagian_add);

        $flasher->addSuccess('Pekerjaan Berhasil Ditambahkan!');

        activity()->log('Menambahkan Pekerjaan ' . $request->tender_add);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        return view('auth.pekerjaan.index', [
            'jobs' => Pekerjaan::where('tender_id', $tender->id)->get(),
            'tender' => $tender,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tender $tender)
    {
        if (isset($tender['vendor'])) {
            $tender['vendor'] = (explode(";", $tender['vendor']));
        }

        return view('auth.tender.edit', [
            'tender' => $tender,
            'vendor' => Vendor::orderBy('no', 'asc')->get()
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
            'no_pr' => 'required|max:255',
            'tender' => 'required|max:255',
            'periode_awal' => 'required|date_format:Y-m-d',
            'periode_akhir' => 'required|date_format:Y-m-d',
            'bagian' => 'required|max:255',
            'keterangan' => 'max:16000000',
        ]);

        $work = Tender::find($request->id);
        $work->no_pr = $request->no_pr;
        $work->tender = $request->tender;
        $work->periode_awal = $request->periode_awal;
        $work->periode_akhir = $request->periode_akhir;
        $work->keterangan = $request->keterangan;
        $work->save();

        $work->bagian()->sync($request->bagian);

        $flasher->addSuccess('Pekerjaan Berhasil Diperbarui!');

        activity()->log('Memperbarui Pekerjaan ' . $request->tender);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender, FlasherInterface $flasher)
    {
        $tender->delete();

        $flasher->addSuccess('Pekerjaan Berhasil Dihapus!');

        activity()->log('Menghapus Pekerjaan ' . $tender->tender);

        return redirect()->back();
    }

    public function trash()
    {
        $tender = Tender::onlyTrashed()->orderBy('created_at', 'desc')->get();

        return view('auth.tender.trash', [
            'tenders' => $tender,
        ]);
    }

    public function restore($id, FlasherInterface $flasher)
    {
        Tender::onlyTrashed()->where('id', $id)->restore();
        $tender = Tender::where('id', $id)->first();

        $flasher->addSuccess('Pekerjaan Berhasil Direstore!');

        activity()->log('Merestore Pekerjaan ' . $tender->tender);

        return redirect()->back();
    }

    public function permanent($id, FlasherInterface $flasher)
    {
        $getTender = Tender::onlyTrashed()->where('id', $id)->first();
        $tender = $getTender->tender;
        $getTender->bagian()->detach();
        Tender::onlyTrashed()->where('id', $id)->forceDelete();

        $flasher->addSuccess('Pekerjaan Berhasil Dihapus Permanen!');

        activity()->log('Menghapus Permanen Pekerjaan ' . $tender);

        return redirect()->back();
    }
}
