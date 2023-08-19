<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Pekerjaan;
use App\Models\Tender;
use App\Models\Uraian;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin|Buyer|User');
    }

    public function index()
    {
        if (Auth::user()->roles->pluck('name')[0] == "Admin" || Auth::user()->roles->pluck('name')[0] == "Buyer") {
            //Pekerjaan
            $tender = Tender::count('id');

            //No. SP, No. Agreement
            $detail = Uraian::count('id');

            $kontrak = Uraian::whereNotNull('kontrak')->count('kontrak');

            // Belum Rincian Harga
            $sudahRincianHarga = DB::select(DB::raw("SELECT COUNT(DISTINCT pekerjaan.tender_id) AS result FROM pekerjaan JOIN tender ON tender.id = pekerjaan.tender_id WHERE tender.deleted_at IS NULL"));
            $belumRincianHarga = $tender - $sudahRincianHarga[0]->result;

            // Belum Detail Pekerjaan
            $sudahDetailPekerjaan = DB::select(DB::raw("SELECT COUNT(DISTINCT uraian.tender_id) AS result FROM uraian JOIN tender ON tender.id = uraian.tender_id WHERE tender.deleted_at IS NULL"));
            $belumDetailPekerjaan = $tender - $sudahDetailPekerjaan[0]->result;

            // Mendekati Periode Akhir
            $periodeAkhir = 0;
            $pekerjaan = Tender::all();

            foreach ($pekerjaan as $job) {
                if ($job->periode_akhir->subDays(91) < Carbon::now() && $job->periode_akhir > Carbon::now()) {
                    $periodeAkhir += 1;
                }
            }

            // Sisa
            $pengguna = User::count('id');
            $vendor = Vendor::count('id');
            $user = Bagian::count('id');
        } elseif (Auth::user()->roles->pluck('name')[0] == "User") {

            //Pekerjaan
            $data = [];
            foreach (Auth::user()->bagian as $bagian) {
                array_push($data, $bagian->id);
            }
            $tender = Tender::whereHas('bagian', function ($q) use ($data) {
                $q->whereIn('bagian_id', $data);
            })->count('id');

            //No. SP, No. Agreement, Kontrak
            $tenderUser = Tender::select('id')->whereHas('bagian', function ($q) use ($data) {
                $q->whereIn('bagian_id', $data);
            })->pluck('id');

            $arrOfId = [];
            $stringOfId = "";

            foreach ($tenderUser as $x) {
                array_push($arrOfId, $x);
                $stringOfId .= $x . ",";
            }
            if ($stringOfId != "") {
                $newStringOfId = rtrim($stringOfId, ",");
            } else {
                $newStringOfId = "0";
            }

            $detail = Uraian::whereIn('tender_id',  $arrOfId)->count();

            $kontrak = Uraian::whereIn('tender_id',  $arrOfId)->count('kontrak');

            // Belum Rincian Harga
            $sudahRincianHarga = DB::select(DB::raw("SELECT COUNT(DISTINCT tender_id) AS result FROM pekerjaan WHERE tender_id IN ($newStringOfId)"));
            $belumRincianHarga = $tender - $sudahRincianHarga[0]->result;

            // Belum Detail Pekerjaan
            $sudahDetailPekerjaan = DB::select(DB::raw("SELECT COUNT(DISTINCT tender_id) AS result FROM uraian WHERE tender_id IN ($newStringOfId)"));
            $belumDetailPekerjaan = $tender - $sudahDetailPekerjaan[0]->result;

            // Mendekati Periode Akhir
            $periodeAkhir = 0;
            $pekerjaan = Tender::whereHas('bagian', function ($q) use ($data) {
                $q->whereIn('bagian_id', $data);
            })->get();

            foreach ($pekerjaan as $job) {
                if ($job->periode_akhir->subDays(91) < Carbon::now() && $job->periode_akhir > Carbon::now()) {
                    $periodeAkhir += 1;
                }
            }

            //Sisa
            $pengguna = User::count('id');
            $vendor = Vendor::count('id');
            $user = Bagian::count('id');
        };

        return view('auth.dashboard', compact('tender', 'detail', 'kontrak', 'belumRincianHarga', 'belumDetailPekerjaan', 'periodeAkhir', 'pengguna', 'vendor', 'user'));
    }

    public function manual()
    {
        return view('auth.manual');
    }
}
