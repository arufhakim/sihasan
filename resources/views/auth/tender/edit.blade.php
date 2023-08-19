@extends('layouts.master-dashboard')
@section('page-title', 'Informasi Pekerjaan')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.index')}}">Informasi Pekerjaan</a></li>
    <li class="breadcrumb-item active">Edit Pekerjaan</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title">Edit Pekerjaan</h6>
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
            <form action="{{route('tender.update', ['tender' => $tender->id])}}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label class="col-form-label col-form-label-xs" for="tender">Nama Pekerjaan<span class="required">*</span></label>
                    <input type="text" class="form-control form-control-sm @error('tender') is-invalid @enderror" value="{{old('tender') ?? $tender->tender}}" id="tender" name="tender" placeholder="Nama Pekerjaan">
                    @error('tender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="col-form-label col-form-label-xs" for="no_sp">No. SP<span class="required">*</span></label>
                    <input type="text" class="form-control form-control-sm @error('no_sp') is-invalid @enderror" value="{{old('no_sp') ?? $tender->no_sp}}" id="no_sp" name="no_sp" placeholder="Cont. 0169/B/HK.01.02/35/SP/2022;0170/B/HK.01.02/35/SP/2022">
                    <span style="font-size: smaller;"> Input lebih dari satu pisahkan dengan tanda <b>Titik Koma</b> ( ; )</span>
                    @error('no_sp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="col-form-label col-form-label-xs" for="no_agreement">No. Agreement<span class="required">*</span></label>
                    <input type="text" class="form-control form-control-sm @error('no_agreement') is-invalid @enderror" value="{{old('no_agreement') ?? $tender->no_agreement}}" id="no_agreement" name="no_agreement" placeholder="Cont. 4100003840;4100003841">
                    <span style="font-size: smaller;"> Input lebih dari satu pisahkan dengan tanda <b>Titik Koma</b> ( ; )</span>
                    @error('no_agreement')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="col-form-label col-form-label-xs" for="vendor">Vendor<span class="required">*</span></label>
                    <select id="vendor" name="vendor[]" multiple data-reorder="1" class="form-control form-control-sm select2bs4 @error('vendor') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                        <option value=''></option>
                        @foreach($vendor as $rekanan)
                        @if (old('vendor'))
                        <option value="{{ $rekanan->id }}" {{ in_array($rekanan->id, old('vendor')) ? 'selected' : '' }}>{{ $rekanan->vendor }} ({{$rekanan->no}})</option>
                        @elseif($tender->vendor)
                        <option value="{{ $rekanan->id }}" {{ in_array($rekanan->id, $tender->vendor) ? 'selected' : '' }}>{{ $rekanan->vendor }} ({{$rekanan->no}})</option>
                        @else
                        <option value="{{ $rekanan->id }}">{{ $rekanan->vendor }} ({{$rekanan->no}})</option>
                        @endif
                        @endforeach
                    </select>
                    @error('vendor')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="col-form-label col-form-label-xs" for="prosentase">Prosentase<span class="required">*</span></label>
                    <div class="input-group" data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm @error('prosentase') is-invalid @enderror" value="{{old('prosentase') ?? $tender->prosentase}}" id="prosentase" name="prosentase" placeholder="Cont. 80;20">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-percent"></i></div>
                        </div>
                    </div>
                    <span style="font-size: smaller;"> Input lebih dari satu pisahkan dengan tanda <b>Titik Koma</b> ( ; )</span>
                    @error('prosentase')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-xs" for="periode_awal">Periode Awal<span class="required">*</span></label>
                        <div class="input-group date" id="reservationdate_edit" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_awal') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode_awal') ?? $tender->periode_awal}}" data-target="#reservationdate_edit" placeholder="Periode Awal" name="periode_awal">
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
                            <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_akhir') is-invalid @enderror" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{old('periode_akhir') ?? $tender->periode_akhir}}" data-target="#reservationdate_edit_2" placeholder="Periode Akhir" name="periode_akhir">
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
                    <label class="col-form-label col-form-label-xs" for="keterangan">Keterangan<span class="required">*</span></label>
                    <textarea id="summernote" class="form-control form-control-sm @error('keterangan') is-invalid @enderror" name="keterangan" rows="3" cols="50" placeholder="Keterangan">{{old('keterangan') ?? $tender->keterangan}}</textarea>
                    @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="row justify-content-end mr-0">
                    <button type="submit" class="btn btn-success btn-xs text-right" data-toggle="confirmation" data-placement="left">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    jQuery("select").each(function() {
        $this = jQuery(this);
        if ($this.attr('data-reorder')) {
            $this.on('select2:select', function(e) {
                var elm = e.params.data.element;
                $elm = jQuery(elm);
                $t = jQuery(this);
                $t.append($elm);
                $t.trigger('change.select2');
            });
        }
        $this.select2();
    });
</script>
@endpush