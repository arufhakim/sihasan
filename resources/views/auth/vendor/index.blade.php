@extends('layouts.master-dashboard')
@section('page-title', 'Data Vendor')
@section('action','active')
@section('menuopen','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Vendor</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">Data Vendor</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-success btn-xs mb-4" data-toggle="modal" data-target="#add">Tambah Vendor</a>
            <div class="table-responsive">
                <table id="vendorTable" class="table table-sm table-hovered table-bordered table-hover table-striped mt-4">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">No.</th>
                            <th class="text-center" style="width: 30%;">Nomor Vendor</th>
                            <th class="text-center" style="width: 40%;">Nama Vendor</th>
                            <th class="text-center" style="width: 10%;">Dibuat</th>
                            <th class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Vendor</th>
                            <th>Nama Vendor</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
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
                <h5 class="card-title pt-1" id="exampleModalLabel">Tambah Vendor</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('vendor.store')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="no_add">Nomor Vendor<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('no_add') is-invalid @enderror" value="{{old('no_add')}}" id="no_add" name="no_add" placeholder="Nomor Vendor">
                        @error('no_add')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="vendor_add">Nama Vendor<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('vendor_add') is-invalid @enderror" value="{{old('vendor_add')}}" id="vendor_add" name="vendor_add" placeholder="No. SP">
                        @error('vendor_add')
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
                <h5 class="card-title pt-1" id="exampleModalLabel">Edit Vendor</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('vendor.update')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="no">Nomor Vendor<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('no') is-invalid @enderror" value="{{old('no')}}" id="no" name="no" placeholder="Nomor Vendor">
                        @error('no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="vendor">Nama Vendor<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('vendor') is-invalid @enderror" value="{{old('vendor')}}" id="vendor" name="vendor" placeholder="Nama Vendor">
                        @error('vendor')
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
        $('#vendorTable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });



        $(document).ready(function() {

            $('#vendorTable').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                scrollY: 500,
                scrollCollapse: true,
                ajax: "{{ route('vendor.index') }}",
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span> '
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'no',
                        name: 'no',
                        className: 'text-center',
                    },
                    {
                        data: 'vendor',
                        name: 'vendor',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
                drawCallback: function(oSettings) {
                    $("[data-toggle=confirmation]").confirmation({
                        html: true,
                        onConfirm: function(event, element) {}
                    });
                },
                order: [
                    [3, "desc"]
                ],
                pageLength: 25,
                initComplete: function() {
                    this.api().columns([0, 1, 2, 3]).every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
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

@if($errors->has('no_add') || $errors->has('vendor_add'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

@if($errors->has('no') || $errors->has('vendor'))
<script type="text/javascript">
    $('#edit').modal('show');
</script>
@endif

<script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var no = button.data('no')
        var vendor = button.data('vendor')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #no').val(no);
        modal.find('.modal-body #vendor').val(vendor);
    })
</script>
@endpush