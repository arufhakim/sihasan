<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Tender;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;

class TenderLivewire extends Component
{
    public $no_sp;
    public $tender, $no_agreement, $vendor, $prosentase, $periode_awal, $periode_akhir, $keterangan;

    public function render()
    {
        return view('livewire.tender-livewire', [
            'vendors' => Vendor::orderBy('no', 'asc')->get()
        ]);
    }

    public function store(FlasherInterface $flasher)
    {
        $this->validate([
            'tender' => 'required|max:255',
            'no_sp' => 'required|max:255',
            'no_agreement' => 'required|max:255',
            'vendor' => 'required',
            'prosentase' => 'required|max:255',
            'periode_awal' => 'required|date_format:Y-m-d',
            'periode_akhir' => 'required|date_format:Y-m-d',
            'keterangan' => 'max:16000000',
        ]);

        Tender::create([
            'tender' => $this->tender,
            'no_sp' => $this->no_sp,
            'no_agreement' => $this->no_agreement,
            'vendor' => $this->vendor,
            'prosentase' => $this->prosentase,
            'periode_awal' => $this->periode_awal,
            'periode_akhir' => $this->periode_akhir,
            'keterangan' => $this->keterangan,
            'oleh' => Auth::user()->name
        ]);

        $flasher->addSuccess('Pekerjaan Berhasil Ditambahkan!');

        activity()->log('Menambahkan Pekerjaan ' . $this->tender);

        return redirect()->route('tender.index');
    }
}
