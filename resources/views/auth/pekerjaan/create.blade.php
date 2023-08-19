@extends('layouts.master-dashboard')
@section('page-title', 'Rincian Harga')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.index')}}">Informasi Pekerjaan</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.show', ['tender' => $tender->id])}}">Rincian Harga</a></li>
    <li class="breadcrumb-item active">Tambah Rincian</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title">Tambah Rincian</h6>
            <!-- tool -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
            <!-- /tool -->
        </div>
        <div class="card-body">
            <form action="{{route('pekerjaan.store', ['tender' => $tender->id])}}" method="POST">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="pekerjaan">Uraian Pekerjaan<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror" value="{{old('pekerjaan')}}" id="pekerjaan" name="pekerjaan" placeholder="Uraian Pekerjaan">
                            @error('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="volume">Volume<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('volume') is-invalid @enderror" value="{{old('volume')}}" id="volume" name="volume" placeholder="Volume">
                            @error('volume')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="satuan">Satuan<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('satuan') is-invalid @enderror" value="{{old('satuan')}}" id="satuan" name="satuan" placeholder="Satuan">
                            @error('satuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="harga">Harga Satuan (Rp)<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('harga') is-invalid @enderror" value="{{old('harga')}}" id="harga" name="harga" placeholder="Harga">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-0">
                    <button type="submit" class="btn btn-success btn-xs text-right" data-toggle="confirmation" data-placement="left">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row ml-1 pb-2">
        <b><span style="color: blue;">* </span>Superscript (M²) & Subscript (M₂) Generator:</b> <a class="ml-1" href="https://www.tinytextgenerator.com/superscript-text.html" target="_blank">Click Here</a>
    </div>
</div>
@endsection