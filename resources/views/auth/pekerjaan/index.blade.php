@extends('layouts.master-dashboard')
@section('page-title', 'Rincian Harga')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.index')}}">Informasi Pekerjaan</a></li>
    <li class="breadcrumb-item active">Rincian Harga</li>
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
            <h6 class="card-title pt-1">Rincian Harga</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @role('Admin|Buyer')
            <a href="#" class="btn btn-success btn-xs mb-4" data-toggle="modal" data-target="#add">Tambah Rincian</a>
            <a href="{{route('pekerjaan.history', ['tender' => $tender->id])}}" class="btn btn-primary btn-xs mb-4">History Import</a>
            @endrole
            <div class="table-responsive">
                <table id="pekerjaanTable" class="table table-sm table-hovered table-bordered table-hover table-striped datatable2">
                    <thead>
                        <tr>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 5%;">No.</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 25%;">Uraian Pekerjaan</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 10%;">Volume</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 10%;">Satuan</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Harga Satuan (Rp)</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Keterangan</th>
                            @role('Admin|Buyer')
                            <th class="text-center pr-0" style="width: 10%;">Aksi</th>
                            @endrole
                        </tr>
                        <tr class="second-row">
                            <th class="text-center">No.</th>
                            <th class="text-center">Uraian Pekerjaan</th>
                            <th class="text-center">Volume</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Satuan (Rp)</th>
                            <th class="text-center">Keterangan</th>
                            @role('Admin|Buyer')
                            <th class="text-center">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $pekerjaan)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                            <td style="vertical-align: middle;">{{$pekerjaan->pekerjaan}}</td>
                            <td class="text-center" style="vertical-align: middle;">@currency($pekerjaan->volume)</td>
                            <td class="text-center" style="vertical-align: middle;">{{$pekerjaan->satuan}}</td>
                            <td class="text-center" style="vertical-align: middle;"><span>Rp</span>@currency($pekerjaan->harga)</td>
                            <td style="vertical-align: middle;">{{$pekerjaan->keterangan}}</td>
                            @role('Admin|Buyer')
                            <td class="text-center" style="vertical-align: middle;">
                                <a href="#" class="btn btn-warning btn-xs btn-table" data-toggle="modal" data-target="#edit" data-id="{{$pekerjaan->id}}" data-tender_id="{{$pekerjaan->tender_id}}" data-pekerjaan="{{$pekerjaan->pekerjaan}}" data-volume="{{$pekerjaan->volume}}" data-satuan="{{$pekerjaan->satuan}}" data-harga="{{$pekerjaan->harga}}" data-keterangan="{{$pekerjaan->keterangan}}"><i class="fas fa-edit"></i></a>
                                <form action="{{route('pekerjaan.destroy', ['pekerjaan' => $pekerjaan->id])}}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-confirm btn btn-danger btn-xs btn-table" data-toggle="confirmation" data-placement="left"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                            @endrole
                        </tr>
                        @endforeach
                    </tbody>
                </table><br>
            </div>
        </div>
    </div>
</div>

<!-- ADD -->
<div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="card-title pt-1" id="exampleModalLabel">Tambah Rincian</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('pekerjaan.store', ['tender' => $tender->id])}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="pekerjaan_add">Uraian Pekerjaan<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('pekerjaan_add') is-invalid @enderror" value="{{old('pekerjaan_add')}}" id="pekerjaan_add" name="pekerjaan_add" placeholder="Uraian Pekerjaan">
                        @error('pekerjaan_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="volume_add">Volume<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('volume_add') is-invalid @enderror" value="{{old('volume_add')}}" id="volume_add" name="volume_add" placeholder="Volume">
                        @error('volume_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="satuan_add">Satuan<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('satuan_add') is-invalid @enderror" value="{{old('satuan_add')}}" id="satuan_add" name="satuan_add" placeholder="Satuan">
                        @error('satuan_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="harga_add">Harga Satuan (Rp)<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('harga_add') is-invalid @enderror" value="{{old('harga_add')}}" id="harga_add" name="harga_add" placeholder="Harga Satuan">
                        @error('harga_add')
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
                    <div class="row ml-1 pb-2">
                        <b><span style="color: blue;">* </span>Superscript (M²) & Subscript (M₂) Generator:</b> <a class="ml-1" href="https://www.tinytextgenerator.com/superscript-text.html" target="_blank">Click Here</a>
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
                <h5 class="card-title pt-1" id="exampleModalLabel">Edit Rincian</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('pekerjaan.update')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <input type="hidden" name="tender_id" id="tender_id" value="{{old('tender_id')}}">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="pekerjaan">Uraian Pekerjaan<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror" value="{{old('pekerjaan')}}" id="pekerjaan" name="pekerjaan" placeholder="Uraian Pekerjaan">
                        @error('pekerjaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="volume">Volume<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('volume') is-invalid @enderror" value="{{old('volume')}}" id="volume" name="volume" placeholder="Volume">
                        @error('volume')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="satuan">Satuan<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('satuan') is-invalid @enderror" value="{{old('satuan')}}" id="satuan" name="satuan" placeholder="Satuan">
                        @error('satuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="harga">Harga Satuan (Rp)<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('harga') is-invalid @enderror" value="{{old('harga')}}" id="harga" name="harga" placeholder="Harga Satuan">
                        @error('harga')
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
                    <div class="row ml-1 pb-2">
                        <b><span style="color: blue;">* </span>Superscript (M²) & Subscript (M₂) Generator:</b> <a class="ml-1" href="https://www.tinytextgenerator.com/superscript-text.html" target="_blank">Click Here</a>
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
        $('#pekerjaanTable .second-row th').each(function() {
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
                scrollY: '400px',
                scrollCollapse: true,
                dom: "<'row'<'col-sm-6'B><'col-sm-6'Rf>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                        text: 'PDF',
                        className: 'pdf',
                        action: function(e, dt, node, config) {
                            window.open("{{route('pekerjaan.pdf', ['tender' => $tender->id])}}", '_blank');
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'excel'
                    },
                    {
                        extend: 'csv',
                        className: 'csv'
                    },
                    {
                        extend: 'pageLength',
                        className: 'pageLength'
                    },
                ],
                pageLength: 100,
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

@if($errors->has('pekerjaan_add') || $errors->has('volume_add') || $errors->has('satuan_add') || $errors->has('harga_add') || $errors->has('keterangan_add'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

@if($errors->has('pekerjaan') || $errors->has('volume') || $errors->has('satuan') || $errors->has('harga') || $errors->has('keterangan'))
<script type="text/javascript">
    $('#edit').modal('show');
</script>
@endif

<script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var tender_id = button.data('tender_id')
        var pekerjaan = button.data('pekerjaan')
        var volume = button.data('volume')
        var satuan = button.data('satuan')
        var harga = button.data('harga')
        var keterangan = button.data('keterangan')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #tender_id').val(tender_id);
        modal.find('.modal-body #pekerjaan').val(pekerjaan);
        modal.find('.modal-body #volume').val(volume);
        modal.find('.modal-body #satuan').val(satuan);
        modal.find('.modal-body #harga').val(harga);
        modal.find('.modal-body #keterangan').html(keterangan);
    })
</script>
@endpush