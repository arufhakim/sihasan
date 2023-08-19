@extends('layouts.master-dashboard')
@section('page-title', 'Import Excel')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.index')}}">Informasi Pekerjaan</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.show', ['tender' => $tender->id])}}">Rincian Harga</a></li>
    <li class="breadcrumb-item"><a href="{{route('pekerjaan.history', ['tender' => $tender->id])}}">History Import</a></li>
    <li class="breadcrumb-item active">Import Excel</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title">Import Excel</h6>
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
            @if(count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                @foreach($errors -> all() as $error)
                {{ $error }} <br>
                @endforeach
            </div>
            @endif
            <form action="{{route('pekerjaan.import', ['tender' => $tender->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label class="col-form-label col-form-label-xs" for="file">File Excel<span classpan class="required">*</span></label>
                    <div class="custom-file">
                        <input name="file" type="file" class="custom-file-input @error('file') is-invalid @enderror" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    <span style="font-size: smaller;"> Tipe File : <span style="font-weight: lighter;">XLSX</span></span>
                    @error('file')
                    <div class="invalid-feedback mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <a href="{{asset('/file/Rincian_Harga.xlsx')}}" class="btn btn-primary btn-xs mr-1">Download Template</a>
                <button type="submit" class="btn btn-success btn-xs" data-toggle="confirmation" data-placement="left">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#inputGroupFile01').on('change', function() {
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endpush