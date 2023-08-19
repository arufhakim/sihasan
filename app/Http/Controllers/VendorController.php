<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Carbon;

class VendorController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Vendor::select(
                'id',
                'no',
                'vendor',
                'created_at',
            )->get();

            return Datatables::of($query)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" class="btn btn-warning btn-xs btn-table" data-toggle="modal" data-target="#edit" data-id="' . $row->id . '" data-no="' . $row->no . '" data-vendor="' . $row->vendor . '"><i class="fas fa-edit"></i></a>
                    <form action="vendor/' . $row->id . '" method="POST" style="display:inline">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="delete-confirm btn btn-danger btn-xs btn-table" data-toggle="confirmation" data-placement="left"><i class="fas fa-trash-alt"></i></button>
                                </form>';
                    return $html;
                })->editColumn('created_at', function ($row) {
                    return $row->created_at ? with(new Carbon($row->created_at))->format('d/m/Y') : '';
                })->rawColumns(['action'])->make(true);
        }

        return view('auth.vendor.index', [
            'vendor' => Vendor::orderBy('no', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'no_add' => 'required|max:50',
            'vendor_add' => 'required|max:255'
        ]);

        Vendor::create([
            'no' => $request->no_add,
            'vendor' => $request->vendor_add
        ]);

        $flasher->addSuccess('Vendor Berhasil Ditambahkan!');

        activity()->log('Menambahkan Vendor ' . $request->vendor_add);

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
            'no' => 'required|max:50',
            'vendor' => 'required|max:255'
        ]);

        Vendor::where('id', $request->id)->update([
            'no' => $request->no,
            'vendor' => $request->vendor
        ]);

        $flasher->addSuccess('Vendor Berhasil Diperbarui!');

        activity()->log('Memperbarui Vendor ' . $request->vendor);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor, FlasherInterface $flasher)
    {
        try {
            $vendor->delete();
            $flasher->addSuccess('Vendor Berhasil Dihapus!');
            activity()->log('Menghapus Vendor ' . $vendor->vendor);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                $flasher->addError('Vendor Tidak Dapat Dihapus!');
                activity()->log('Tidak Dapat Menghapus Vendor ' . $vendor->vendor);
            }
        }

        return redirect()->back();
    }
}
