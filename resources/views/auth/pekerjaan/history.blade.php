@extends('layouts.master-dashboard')
@section('page-title', 'History Import')
@section('active-tender','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.index')}}">Informasi Pekerjaan</a></li>
    <li class="breadcrumb-item"><a href="{{route('tender.show', $tender->slug)}}">Rincian Harga</a></li>
    <li class="breadcrumb-item active">History Import</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">History Import</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-primary btn-xs mb-4" data-toggle="modal" data-target="#add">Import Excel</a>
            <div class="table-responsive">
                <table id="historyTable" class="table table-hover datatable table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No.</th>
                            <th class="text-center" style="width: 55%">File</th>
                            <th class="text-center" style="width: 20%">Dibuat</th>
                            <th class="text-center" style="width: 20%">Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $story)
                        <tr>
                            <td align="center">{{$loop->iteration}}</td>
                            <td>{{$story->file}}</td>
                            <td align="center">{{\Carbon\Carbon::parse($story->created_at)->format('d/m/Y')}}</td>
                            <td align="center">{{$story->oleh}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>File</th>
                            <th>Dibuat</th>
                            <th>Oleh</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ADD -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="card-title pt-1" id="exampleModalLabel">Import Excel</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs" data-dismiss="modal" aria-label="Close" data-card-widget="remove"><i class="fas fa-xs fa-times icon-border-red"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('pekerjaan.import', ['tender' => $tender->id])}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body py-2 px-0">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger mx-2" role="alert">
                        @foreach($errors -> all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>
                    @endif
                    <div class="row flex-column mr-3 ml-3">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label class="col-form-label col-form-label-xs" for="file">File Excel<span classpan class="required">*</span></label>
                            <div class="custom-file">
                                <input name="file" type="file" class="custom-file-input @error('file') is-invalid @enderror" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01" style="font-size: 12px !important;">Choose file</label>
                            </div>
                            <span style="font-size: smaller;"> Tipe File : <span style="font-weight: lighter;">XLSX</span></span>
                            @error('file')
                            <div class="invalid-feedback mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer pt-2 pb-0">
                        <div class="row w-100">
                            <div class="col-12 d-flex justify-content-end pr-0">
                                <a href="{{asset('/file/Rincian_Harga.xlsx')}}" class="btn btn-primary btn-xs mr-1">Download Template</a>
                                <button type="button" class="btn btn-danger btn-xs mr-1" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success btn-xs" data-toggle="confirmation" data-placement="bottom">Submit</button>
                            </div>
                        </div>
                    </div>
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
        $('#historyTable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });
        $(document).ready(function() {
            $('.datatable').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
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

<script>
    $('#inputGroupFile01').on('change', function() {
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>

@if(count($errors) > 0)
<script type="text/javascript">
    $('#add').modal('show');
</script>
@endif
@endpush