@extends('layouts.master-dashboard')
@section('page-title', 'Rincian Harga')
@section('active-rincian','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
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
            <div class="table-responsive">
                <table id="pekerjaanTable" class="table table-sm table-hovered table-bordered table-hover table-striped datatable2">
                    <thead>
                        <tr>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 5%;">No.</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 35%;">Uraian Pekerjaan</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 10%;">Volume</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 10%;">Satuan</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 15%;">Harga Satuan (Rp)</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 25%;">Keterangan</th>
                        </tr>
                        <tr class="second-row">
                            <th class="text-center">No.</th>
                            <th class="text-center">Uraian Pekerjaan</th>
                            <th class="text-center">Volume</th>
                            <th class="text-center">Satuan</th>
                            <th class="text-center">Harga Satuan (Rp)</th>
                            <th class="text-center">Keterangan</th>
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
                ordering: false,
                scrollY: '500px',
                scrollCollapse: true,
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
@endpush