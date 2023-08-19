@extends('layouts.master-dashboard')
@section('page-title', 'Activity Log')
@section('active-log','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Activity Log</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">Activity Log</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="logTable" class="fixed table table-sm table-hovered table-bordered table-hover table-striped mt-4 datatable2">
                    <thead>
                        <tr>
                            <th class="center" style="vertical-align: middle; width: 5%;">No.</th>
                            <th class="center" style="vertical-align: middle; width: 20%;">Diproses Oleh</th>
                            <th class="center" style="vertical-align: middle; width: 50%;">Keterangan Aktivitas</th>
                            <th class="center" style="vertical-align: middle; width: 15%;">Tanggal</th>
                            <th class="center" style="vertical-align: middle; width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users_log as $log)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                            @if(optional($log->causer)->name)
                            <td style="vertical-align: middle;">{{optional($log->causer)->name}}</td>
                            @else
                            <td style="color: red; vertical-align: middle;">USER DELETED</td>
                            @endif
                            <td style="vertical-align: middle;">{{$log->description}}</td>
                            <td align="center" style="vertical-align: middle;">{{\Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td align="center" style="vertical-align: middle;">{{Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Diproses Oleh</th>
                            <th>Keterangan Aktivitas</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    // DataTable
    $(function() {
        $('#logTable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text"  class="form-control" placeholder="" />');
        });
        $(document).ready(function() {
            $('.datatable2').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10', '25', '50', '100', 'All']
                ],
                scrollY: '500px',
                scrollCollapse: true,
                pageLength: 10,
                initComplete: function() {
                    this.api().columns([0, 1, 2, 3, 4]).every(function() {
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
@endpush