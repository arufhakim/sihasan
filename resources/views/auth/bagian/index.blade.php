@extends('layouts.master-dashboard')
@section('page-title', 'Data User')
@section('action','active')
@section('menuopen','menu-open')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data User</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">Data User</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-success btn-xs mb-4" data-toggle="modal" data-target="#add">Tambah User</a>
            <div class="table-responsive">
                <table id="vendorTable" class="table table-sm table-hovered table-bordered table-hover table-striped mt-4">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No.</th>
                            <th class="text-center" style="width: 85%;">User</th>
                            <th class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bagian as $part)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="pl-4">{{$part->bagian}}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-xs btn-table" data-toggle="modal" data-target="#edit" data-id="{{$part->id}}" data-bagian="{{$part->bagian}}"><i class="fas fa-edit"></i></a>
                                <form action="{{route('bagian.destroy', ['bagian' => $part->id])}}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-confirm btn btn-danger btn-xs btn-table" data-toggle="confirmation" data-placement="left"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
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
                <h5 class="card-title pt-1" id="exampleModalLabel">Tambah User</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('bagian.store')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="bagian_add">User<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('bagian_add') is-invalid @enderror" value="{{old('bagian_add')}}" id="bagian_add" name="bagian_add" placeholder="User">
                        @error('bagian_add')
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
                <h5 class="card-title pt-1" id="exampleModalLabel">Edit User</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('bagian.update')}}" method="POST">
                <div class="modal-body py-2">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="bagian">User<span class="required">*</span></label>
                        <input type="text" class="form-control form-control-sm @error('bagian') is-invalid @enderror" value="{{old('bagian')}}" id="bagian" name="bagian" placeholder="User">
                        @error('bagian')
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
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                pageLength: 25,
                initComplete: function() {
                    this.api().columns([0, 1]).every(function() {
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

@if($errors->has('bagian_add'))
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif

@if($errors->has('bagian'))
<script type="text/javascript">
    $('#edit').modal('show');
</script>
@endif

<script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var bagian = button.data('bagian')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #bagian').val(bagian);
    })
</script>
@endpush