@extends('layouts.master-dashboard')
@section('page-title', 'Informasi Pekerjaan')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Informasi Pekerjaan</li>
</ol>
@endsection
@push('styles')
<style>
    .dataTables_scroll {
        margin-bottom: 10px;
    }
</style>
@endpush
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">Informasi Pekerjaan</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @role('Admin|Buyer')
            <a href="#" class="btn btn-success btn-xs mb-4" data-toggle="modal" data-target="#add">Tambah Pekerjaan</a>
            @endrole
            <a href="{{route('tender.index')}}" class="btn btn-primary btn-xs mb-4">Show All Data</a>
            <div class="table-responsive">
                <table id="tenderTable" class="fixed table table-sm table-hovered table-bordered table-hover table-striped mt-4 datatable2">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;" class="text-center pr-1 number">No.</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 no-2">No. PR</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 nama">Nama Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 no">No. SP</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 no-2">No. Agreement</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 vendor">Vendor</th>
                            <th style="vertical-align: middle;" class="text-center pr-1">Prosentase Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1">Dokumen Kontrak</th>
                            @role('Admin|Buyer')
                            <th style="vertical-align: middle;" class="text-center pr-1">Detail Pekerjaan</th>
                            @endrole
                            <th style="vertical-align: middle;" class="text-center pr-1 daterangex">Periode Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 keterangan">User</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 keterangan">Keterangan</th>
                            @role('Admin|Buyer')
                            <th style="vertical-align: middle;" class="text-center pr-1 date">Dibuat</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 oleh">Oleh</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 aksi">Aksi</th>
                            @endrole
                            <th style="vertical-align: middle;" class="text-center pr-1 rincian">Rincian Harga</th>
                        </tr>
                        <tr class="second-row">
                            <th style="vertical-align: middle;" class="text-center">No.</th>
                            <th style="vertical-align: middle;" class="text-center">No. PR</th>
                            <th style="vertical-align: middle;" class="text-center">Nama Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center">No. SP</th>
                            <th style="vertical-align: middle;" class="text-center">No. Agreement</th>
                            <th style="vertical-align: middle;" class="text-center">Vendor</th>
                            <th style="vertical-align: middle;" class="text-center">Prosentase</th>
                            <th style="vertical-align: middle;" class="text-center">Dokumen Kontrak</th>
                            @role('Admin|Buyer')
                            <th style="vertical-align: middle;" class="text-center">Detail Pekerjaan</th>
                            @endrole
                            <th style="vertical-align: middle;" class="text-center">Periode Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center">User</th>
                            <th style="vertical-align: middle;" class="text-center">Keterangan</th>
                            @role('Admin|Buyer')
                            <th style="vertical-align: middle;" class="text-center">Dibuat</th>
                            <th style="vertical-align: middle;" class="text-center">Oleh</th>
                            <th style="vertical-align: middle;" class="text-center">Aksi</th>
                            @endrole
                            <th style="vertical-align: middle;" class="text-center">Rincian Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($name == 'rincian' || $name == 'detail')
                        @foreach($tenders as $tender)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                            <td class="text-center" style="vertical-align: middle;">{{$tender->no_pr}}</td>
                            <td style="vertical-align: middle;">{{$tender->tender}}</td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        <tr>
                                            <td class="border-right-none">{{$key->no_sp}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        <tr>
                                            <td class="border-right-none">{{$key->no_agreement}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-0" style="vertical-align: middle;">
                                <table class="w-100 table-overflow-hidden" style="table-layout:fixed">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        <tr>
                                            <td class="border-right-none">{{$key->vendor->vendor}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        @if(isset($key->prosentase))
                                        <tr>
                                            <td class="border-right-none">{{$key->prosentase}}%</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="border-right-none">-</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        @if(isset($key->kontrak))
                                        <tr>
                                            <td class="border-right-none"><a href="{{route('kontrak.view', ['uraian' => $key->id])}}" target="_blank">Lihat</a></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="border-right-none">-</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            @role('Admin|Buyer')
                            <td class="text-center" style="vertical-align: middle;"><a href="{{route('uraian.index', ['tender' => $tender->id])}}" class="btn btn-success btn-xs"><b>Detail</b></a>
                            </td>
                            @endrole
                            @if($tender->periode_akhir->subDays(91) < Carbon\Carbon::now() && $tender->periode_akhir > Carbon\Carbon::now())
                                <td class="text-center" style="background-color: rgb(255,250,205); vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                @elseif(Carbon\Carbon::now() < $tender->periode_akhir)
                                    <td class="text-center" style="vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                    @else
                                    <td class="text-center" style="vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                    @endif
                                    <td style="vertical-align: middle;" class="text-center">
                                        @foreach($tender->bagian as $part)
                                        {{$part->bagian}},
                                        @endforeach
                                    </td>
                                    <td style="vertical-align: middle;">{!!$tender->keterangan!!}</td>
                                    @role('Admin|Buyer')
                                    <td class="text-center" style="vertical-align: middle;">{{date('d/m/Y', strtotime($tender->created_at))}}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{$tender->oleh}}</td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="#" class="btn btn-warning btn-xs btn-table" data-toggle="modal" data-target="#edit" data-id="{{$tender->id}}" data-no_pr="{{$tender->no_pr}}" data-tender="{{$tender->tender}}" data-periode_awal="{{$tender->periode_awal}}" data-periode_akhir="{{$tender->periode_akhir}}" data-keterangan="{{$tender->keterangan}}"><i class="fas fa-edit"></i></a>
                                        <form action="{{route('tender.destroy', ['tender' => $tender->id])}}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-confirm btn btn-danger btn-xs btn-table" data-toggle="confirmation" data-placement="left"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    @endrole
                                    @if($tender->checking($tender->id))
                                    <td class="text-center" style="vertical-align: middle;"> <a href="{{route('tender.show', $tender->slug)}}" class="btn btn-primary btn-xs"><b>Rincian</b></a>
                                    </td>
                                    @else
                                    <td class="text-center" style="vertical-align: middle; background-color: rgba(255, 204, 203);"> <a href="{{route('tender.show', $tender->slug)}}" class="btn btn-primary btn-xs"><b>Rincian</b></a>
                                    </td>
                                    @endif
                        </tr>
                        @endforeach
                        @endif

                        @if($name == 'tanggal')
                        @foreach($tenders as $tender)
                        @if($tender->periode_akhir->subDays(91) < Carbon\Carbon::now() && $tender->periode_akhir > Carbon\Carbon::now())
                            <tr>
                                <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                                <td class="text-center" style="vertical-align: middle;">{{$tender->no_pr}}</td>
                                <td style="vertical-align: middle;">{{$tender->tender}}</td>
                                <td class="text-center p-0" style="vertical-align: middle;">
                                    <table class="w-100">
                                        <tbody>
                                            @foreach($tender->uraian as $key)
                                            <tr>
                                                <td class="border-right-none">{{$key->no_sp}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-center p-0" style="vertical-align: middle;">
                                    <table class="w-100">
                                        <tbody>
                                            @foreach($tender->uraian as $key)
                                            <tr>
                                                <td class="border-right-none">{{$key->no_agreement}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="p-0" style="vertical-align: middle;">
                                    <table class="w-100 table-overflow-hidden" style="table-layout:fixed">
                                        <tbody>
                                            @foreach($tender->uraian as $key)
                                            <tr>
                                                <td class="border-right-none">{{$key->vendor->vendor}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-center p-0" style="vertical-align: middle;">
                                    <table class="w-100">
                                        <tbody>
                                            @foreach($tender->uraian as $key)
                                            @if(isset($key->prosentase))
                                            <tr>
                                                <td class="border-right-none">{{$key->prosentase}}%</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td class="border-right-none">-</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-center p-0" style="vertical-align: middle;">
                                    <table class="w-100">
                                        <tbody>
                                            @foreach($tender->uraian as $key)
                                            @if(isset($key->kontrak))
                                            <tr>
                                                <td class="border-right-none"><a href="{{route('kontrak.view', ['uraian' => $key->id])}}" target="_blank">Lihat</a></td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td class="border-right-none">-</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                @role('Admin|Buyer')
                                <td class="text-center" style="vertical-align: middle;"><a href="{{route('uraian.index', ['tender' => $tender->id])}}" class="btn btn-success btn-xs"><b>Detail</b></a>
                                </td>
                                @endrole
                                <td class="text-center" style="background-color: rgb(255,250,205); vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                <td style="vertical-align: middle;" class="text-center">
                                    @foreach($tender->bagian as $part)
                                    {{$part->bagian}},
                                    @endforeach
                                </td>
                                <td style="vertical-align: middle;">{!!$tender->keterangan!!}</td>
                                @role('Admin|Buyer')
                                <td class="text-center" style="vertical-align: middle;">{{date('d/m/Y', strtotime($tender->created_at))}}</td>
                                <td class="text-center" style="vertical-align: middle;">{{$tender->oleh}}</td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <a href="#" class="btn btn-warning btn-xs btn-table" data-toggle="modal" data-target="#edit" data-id="{{$tender->id}}" data-no_pr="{{$tender->no_pr}}" data-tender="{{$tender->tender}}" data-periode_awal="{{$tender->periode_awal}}" data-periode_akhir="{{$tender->periode_akhir}}" data-keterangan="{{$tender->keterangan}}"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('tender.destroy', ['tender' => $tender->id])}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-confirm btn btn-danger btn-xs btn-table" data-toggle="confirmation" data-placement="left"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                                @endrole
                                @if($tender->checking($tender->id))
                                <td class="text-center" style="vertical-align: middle;"> <a href="{{route('tender.show', $tender->slug)}}" class="btn btn-primary btn-xs"><b>Rincian</b></a>
                                </td>
                                @else
                                <td class="text-center" style="vertical-align: middle; background-color: rgba(255, 204, 203);"> <a href="{{route('tender.show', $tender->slug)}}" class="btn btn-primary btn-xs"><b>Rincian</b></a>
                                </td>
                                @endif
                            </tr>
                            @endif
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ADD -->
<div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="card-title pt-1" id="exampleModalLabel">Tambah Pekerjaan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('tender.store')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="no_pr_add">No. PR<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('no_pr_add') is-invalid @enderror" value="{{old('no_pr_add')}}" id="no_pr_add" name="no_pr_add" placeholder="No. PR">
                        @error('no_pr_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="tender_add">Nama Pekerjaan<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('tender_add') is-invalid @enderror" value="{{old('tender_add')}}" id="tender_add" name="tender_add" placeholder="Nama Pekerjaan">
                        @error('tender_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-xs" for="periode_awal_add">Periode Awal<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate_add" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_awal_add') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode_awal_add')}}" data-target="#reservationdate_add" placeholder="Periode Awal" name="periode_awal_add">
                                <div class="input-group-append" data-target="#reservationdate_add" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('periode_awal_add')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-xs" for="periode_akhir_add">Periode Akhir<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate_add_2" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_akhir_add') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode_akhir_add')}}" data-target="#reservationdate_add_2" placeholder="Periode Akhir" name="periode_akhir_add">
                                <div class="input-group-append" data-target="#reservationdate_add_2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('periode_akhir_add')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="bagian_add">User<span class="required">*</span></label>
                        <select id="bagian_add" name="bagian_add[]" multiple class="form-control form-control-sm select2bs4 @error('bagian_add') is-invalid @enderror" style="width: 100%; font: size 12px;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($bagian as $part)
                            @if(old('bagian_add'))
                            <option value="{{ $part->id }}" {{ in_array($part->id, old('bagian_add')) ? 'selected' : '' }}>{{ $part->bagian }}</option>
                            @else
                            <option value="{{ $part->id }}">{{ $part->bagian }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('bagian_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="keterangan_add">Keterangan</label>
                        <textarea id="keterangan_add" class="form-control form-control-sm @error('keterangan_add') is-invalid @enderror" name="keterangan_add" rows="3" cols="50" placeholder="Keterangan" style="font-size:12px">{{old('keterangan_add')}}</textarea>
                        @error('keterangan_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-xs" data-toggle="confirmation" data-placement="bottom">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="edit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="card-title pt-1" id="exampleModalLabel">Edit Pekerjaan</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('tender.update')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="no_pr">No. PR<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('no_pr') is-invalid @enderror" value="{{old('no_pr')}}" id="no_pr" name="no_pr" placeholder="No. PR">
                        @error('no_pr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="tender">Nama Pekerjaan<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('tender') is-invalid @enderror" value="{{old('tender')}}" id="tender" name="tender" placeholder="Nama Pekerjaan">
                        @error('tender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-xs" for="periode_awal">Periode Awal<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate_edit" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_awal') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode_awal')}}" data-target="#reservationdate_edit" placeholder="Periode Awal" id="periode_awal" name="periode_awal">
                                <div class="input-group-append" data-target="#reservationdate_edit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('periode_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-xs" for="periode_akhir">Periode Akhir<span class="required">*</span></label>
                            <div class="input-group date" id="reservationdate_edit_2" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_akhir') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode_akhir')}}" data-target="#reservationdate_edit_2" placeholder="Periode Akhir" id="periode_akhir" name="periode_akhir">
                                <div class="input-group-append" data-target="#reservationdate_edit_2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('periode_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="bagian">User<span class="required">*</span></label>
                        <select id="bagian" name="bagian[]" multiple class="form-control select2bs4 @error('bagian') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($bagian as $part)
                            @if(old('bagian'))
                            <option value="{{ $part->id }}" {{ in_array($part->id, old('bagian')) ? 'selected' : '' }}>{{ $part->bagian }}</option>
                            @else
                            <option value="{{ $part->id }}">{{ $part->bagian }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('bagian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="keterangan">Keterangan</label>
                        <textarea id="keterangan" class="form-control form-control-sm @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" placeholder="Keterangan" style="font-size:12px">{{old('keterangan')}}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success btn-xs" data-toggle="confirmation" data-placement="bottom">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    // DataTable
    $(function() {
        $('#tenderTable .second-row th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="" />');
        });
        $(document).ready(function() {
            $('.datatable2').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                ordering: false,
                // bSortCellsTop: true,
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: true,
                fixedColumns: {
                    left: 0,
                    right: 1,
                },
                pageLength: 100,
                initComplete: function() {
                    this.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12, 13]).every(function() {
                        var that = this;

                        $('input', this.header()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                },
            });
        });
    });
</script>

@if($errors->has('no_pr_add') || $errors->has('tender_add') || $errors->has('periode_awal_add') || $errors->has('periode_akhir_add') || $errors->has('bagian_add') || $errors->has('keterangan_add'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

@if($errors->has('no_pr') || $errors->has('tender') || $errors->has('periode_awal') || $errors->has('periode_akhir') || $errors->has('bagian') || $errors->has('keterangan'))
<script type="text/javascript">
    $('#edit').modal('show');
</script>
@endif

<script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var no_pr = button.data('no_pr')
        var tender = button.data('tender')
        var periode_awal = button.data('periode_awal')
        var periode_akhir = button.data('periode_akhir')
        var keterangan = button.data('keterangan')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #no_pr').val(no_pr);
        modal.find('.modal-body #tender').val(tender);
        modal.find('.modal-body #periode_awal').val(periode_awal);
        modal.find('.modal-body #periode_akhir').val(periode_akhir);
        modal.find('.modal-body #keterangan').html(keterangan);
    })
</script>
@endpush