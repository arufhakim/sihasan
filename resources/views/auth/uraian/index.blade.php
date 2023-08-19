@extends('layouts.master-dashboard')
@section('page-title', 'Detail Pekerjaan')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.index')}}">Informasi Pekerjaan</a></li>
    <li class="breadcrumb-item active">Detail Pekerjaan</li>
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
    <!-- ADD -->
    @if($count == 0)
    <div class="card">
        <div class="card-header bg-primary">
            <h6 class="card-title pt-1">Tambah Detail Pekerjaan</h6>
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
            <form action="{{route('uraian.store', ['tender' => $tender->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="no_sp">No. SP<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('no_sp') is-invalid @enderror" value="{{old('no_sp')}}" id="no_sp" name="no_sp" placeholder="No. SP">
                            @error('no_sp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="no_agreement">No. Agreement<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('no_agreement') is-invalid @enderror" value="{{old('no_agreement')}}" id="no_agreement" name="no_agreement" placeholder="No. Agreement">
                            @error('no_agreement')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="vendor">Vendor<span class="required">*</span></label>
                            <select id="vendor" name="vendor" class="form-control form-control-sm select2bs4 @error('vendor') is-invalid @enderror" style="width: 100%; font: size 12px;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                @foreach($vendor as $rekanan)
                                <option value='{{$rekanan->id}}' {{ old('vendor') == $rekanan->id ? 'selected' : '' }}>{{ $rekanan->vendor }} ({{$rekanan->no}})</option>
                                @endforeach
                            </select>
                            @error('vendor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="prosentase">Prosentase</label>
                            <input type="text" class="form-control form-control-sm @error('prosentase') is-invalid @enderror" value="{{old('prosentase')}}" id="prosentase" name="prosentase" placeholder="Prosentase">
                            @error('prosentase')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="kontrak">Dokumen Kontrak</label>
                            <div class="custom-file">
                                <input type="file" name="kontrak" class="custom-file-input @error('kontrak') is-invalid @enderror" value="{{old('kontrak')}}" id="kontrak">
                                <label class="custom-file-label" for="kontrak" style="font-size: 12px !important;">Choose file</label>
                                <span style="font-size: 10px;">Tipe File: PDF, Maksimal: 10MB</span>
                                @error('kontrak')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-0">
                    <button type="submit" class="btn btn-success btn-xs text-right" data-toggle="confirmation" data-placement="left">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- EDIT -->
    @if($count == 1)
    <div class="card">
        <div class="card-header bg-warning">
            <h6 class="card-title pt-1">Edit Detail Pekerjaan</h6>
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
            <form action="{{route('uraian.update', ['uraian' => $uraian->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="no_sp">No. SP<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('no_sp') is-invalid @enderror" value="{{old('no_sp') ?? $uraian->no_sp}}" id="no_sp" name="no_sp" placeholder="No. SP">
                            @error('no_sp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="no_agreement">No. Agreement<span class="required">*</span></label>
                            <input type="text" class="form-control form-control-sm @error('no_agreement') is-invalid @enderror" value="{{old('no_agreement') ?? $uraian->no_agreement}}" id="no_agreement" name="no_agreement" placeholder="No. Agreement">
                            @error('no_agreement')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="vendor">Vendor<span class="required">*</span></label>
                            <select id="vendor" name="vendor" class="form-control select2bs4 @error('vendor') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                                <option value=''></option>
                                @foreach($vendor as $rekanan)
                                <option value='{{$rekanan->id}}' {{ old('vendor', $uraian->vendor_id) == $rekanan->id ? 'selected' : '' }}>{{ $rekanan->vendor }} ({{$rekanan->no}})</option>
                                @endforeach
                            </select>
                            @error('vendor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="prosentase">Prosentase</label>
                            <input type="text" class="form-control form-control-sm @error('prosentase') is-invalid @enderror" value="{{old('prosentase') ?? $uraian->prosentase}}" id="prosentase" name="prosentase" placeholder="Prosentase">
                            @error('prosentase')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="kontrak">Dokumen Kontrak</label>
                            <div class="custom-file">
                                <input type="file" name="kontrak" class="custom-file-input @error('kontrak') is-invalid @enderror" value="{{old('kontrak')}}" id="kontrak">
                                <label class="custom-file-label" for="kontrak" style="font-size: 12px !important;">Choose file</label>
                                <span style="font-size: 10px;">Tipe File: PDF, Maksimal: 10MB</span>
                                @error('kontrak')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mr-0">
                    <button type="submit" class="btn btn-success btn-xs text-right" data-toggle="confirmation" data-placement="left">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">Detail Pekerjaan</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nama Pekerjaan</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control pb-2" value=": {{$tender->tender}}" readonly style="background-color: white; font-size:14px; border: none;">
                        </div>
                        <label class="col-md-3 col-form-label">No. PR</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control pb-2" value=": {{$tender->no_pr}}" readonly style="background-color: white; font-size:14px; border: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Periode Awal</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control pb-2" value=": {{date('d F Y', strtotime($tender->periode_awal))}}" readonly style="background-color: white; font-size:14px; border: none;">
                        </div>
                        <label class="col-md-3 col-form-label">Periode Akhir</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control pb-2" value=": {{date('d F Y', strtotime($tender->periode_akhir))}}" readonly style="background-color: white; font-size:14px; border: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="overflow-x: hidden;">
                <table id="pekerjaanTable" class="table table-sm table-hovered table-bordered table-hover table-striped datatable2">
                    <thead>
                        <tr>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 10%;">No.</th>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 25%;">No. SP</th>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 10%;">No. Agreement</th>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 25%;">Vendor</th>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 10%;">Prosentase Pekerjaan</th>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 10%;">Dokumen Kontrak</th>
                            <th class="text-center pr-1" style="vertical-align: middle; width: 10%;">Aksi</th>
                        </tr>
                        <tr class="second-row">
                            <th class="text-center">No.</th>
                            <th class="text-center">No. SP</th>
                            <th class="text-center">No. Agreement</th>
                            <th class="text-center">Vendor</th>
                            <th class="text-center">Prosentase Pekerjaan</th>
                            <th class="text-center">Dokumen Kontrak</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                            <td class="text-center" style="vertical-align: middle;">{{$detail->no_sp}}</td>
                            <td class="text-center" style="vertical-align: middle;">{{$detail->no_agreement}}</td>
                            <td>{{$detail->vendor->vendor}}</td>
                            @if(isset($detail->prosentase))
                            <td class="text-center" style="vertical-align: middle;">{{$detail->prosentase}}%</td>
                            @else
                            <td class="text-center" style="vertical-align: middle;">-</td>
                            @endif
                            @if(isset($detail->kontrak))
                            <td class="text-center" style="vertical-align: middle;"><a href="{{route('kontrak.view', ['uraian' => $detail->id])}}" target="_blank">Lihat</a></td>
                            @else
                            <td class="text-center" style="vertical-align: middle;">-</td>
                            @endif
                            <td class="text-center" style="vertical-align: middle;">
                                <a href="{{route('uraian.edit', ['uraian' => $detail->id])}}" class="btn btn-warning btn-xs btn-table"><i class="fas fa-edit"></i></a>
                                <form action="{{route('uraian.destroy', ['uraian' => $detail->id])}}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs btn-table" data-toggle="confirmation" data-placement="left"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><br>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    // DataTable
    $(function() {
        $('#pekerjaanTable .second-row th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });
        $(document).ready(function() {
            $('.datatable2').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                pageLength: 25,
                ordering: false,
                initComplete: function() {
                    this.api().columns([0, 1, 2, 3, 4, 5]).every(function() {
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
<script>
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endpush