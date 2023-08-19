@extends('layouts.master-dashboard')
@section('page-title', 'Trash')
@section('active-trash','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Trash</li>
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
            <h6 class="card-title pt-1">Trash</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tenderTable" class="fixed table table-sm table-hovered table-bordered table-hover table-striped mt-4 datatable2">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;" class="text-center pr-1 number">No.</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 no-2">No. PR</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 nama">Nama Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 no">No. SP</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 no-2">No. Agreement</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 vendor">Vendor</th>
                            <th style="vertical-align: middle;" class="text-center pr-1">Prosentase Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1">Dokumen Kontrak</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 daterangex">Periode Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 pr-1 keterangan">User</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 keterangan">Keterangan</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 date">Dibuat</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 oleh">Oleh</th>
                            <th style="vertical-align: middle;" class="text-center pr-1 keterangan">Aksi</th>
                        </tr>
                        <tr class="second-row">
                            <th style="vertical-align: middle;" class="text-center">No.</th>
                            <th style="vertical-align: middle;" class="text-center">No. PR</th>
                            <th style="vertical-align: middle;" class="text-center">Nama Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center">No. SP</th>
                            <th style="vertical-align: middle;" class="text-center">No. Agreement</th>
                            <th style="vertical-align: middle;" class="text-center">Vendor</th>
                            <th style="vertical-align: middle;" class="text-center">Prosentase Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center">Dokumen Kontrak</th>
                            <th style="vertical-align: middle;" class="text-center">Periode Pekerjaan</th>
                            <th style="vertical-align: middle;" class="text-center">User</th>
                            <th style="vertical-align: middle;" class="text-center">Keterangan</th>
                            <th style="vertical-align: middle;" class="text-center">Dibuat</th>
                            <th style="vertical-align: middle;" class="text-center">Oleh</th>
                            <th style="vertical-align: middle;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenders as $tender)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                            <td class="text-center" style="vertical-align: middle;">{{$tender->no_pr}}</td>
                            <td style="vertical-align: middle;">{{$tender->tender}}</td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        <tr>
                                            <td class="border-right-none">{{$key->no_sp}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        <tr>
                                            <td class="border-right-none">{{$key->no_agreement}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-0" style="vertical-align: middle;">
                                <table class="w-100 table-overflow-hidden" style="table-layout:fixed">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        <tr>
                                            <td class="border-right-none">{{$key->vendor->vendor}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        @if(isset($key->prosentase))
                                        <tr>
                                            <td class="border-right-none">{{$key->prosentase}}%</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="border-right-none">-</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="text-center p-0" style="vertical-align: middle;">
                                <table class="w-100">
                                    <tbody>
                                        @foreach($tender->uraian as $key)
                                        @if(isset($key->kontrak))
                                        <tr>
                                            <td class="border-right-none"><a href="{{route('kontrak.view', ['uraian' => $key->id])}}" target="_blank">Lihat</a></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="border-right-none">-</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            @if($tender->periode_akhir->subDays(91) < Carbon\Carbon::now() && $tender->periode_akhir > Carbon\Carbon::now())
                                <td class="text-center" style="background-color: rgb(255,250,205); vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                @elseif(Carbon\Carbon::now() < $tender->periode_akhir)
                                    <td class="text-center" style="vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                    @else
                                    <td class="text-center" style="vertical-align: middle;">{{date('d F Y', strtotime($tender->periode_awal))}} sd. {{date('d F Y', strtotime($tender->periode_akhir))}}</td>
                                    @endif
                                    <td style="vertical-align: middle;" class="text-center">
                                        @foreach($tender->bagian as $part)
                                        {{$part->bagian}},
                                        @endforeach
                                    </td>
                                    <td style="vertical-align: middle;">{!!$tender->keterangan!!}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{date('d/m/Y', strtotime($tender->created_at))}}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{$tender->oleh}}</td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a href="{{route('tender.restore', ['id' => $tender->id])}}" class="btn btn-success btn-xs" data-toggle="confirmation" data-placement="left">Restore</a>
                                        <a href="{{route('tender.permanent', ['id' => $tender->id])}}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="left">Hapus Permanen</a>
                                    </td>

                        </tr>
                        @endforeach
                    </tbody>
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
        $('#tenderTable .second-row th').each(function() {
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
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: true,
                fixedColumns: {
                    left: 0,
                    right: 1,
                },
                pageLength: 100,
                initComplete: function() {
                    this.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]).every(function() {
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