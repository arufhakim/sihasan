@extends('layouts.master-dashboard')
@section('page-title', 'Pengguna Sistem')
@section('active-user','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pengguna Sistem</li>
</ol>
@endsection
@push('styles')
<style>
    table tfoot {
        display: table-row-group;
    }
</style>
@endpush
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">List Pengguna Sistem</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <a href="{{route('user.create')}}" class="btn btn-success btn-xs mb-4">Tambah Pengguna Sistem</a>
            <div class="table-responsive">
                <table id="userTable" class="table table-sm table-hovered table-bordered table-hover table-striped mt-4 datatable2">
                    <thead>
                        <tr>
                            <th class="center text-center" style="vertical-align: middle; width: 5%;">No.</th>
                            <th class="center text-center" style="vertical-align: middle; width: 20%;">Nama Pengguna</th>
                            <th class="center text-center" style="vertical-align: middle; width: 15%;">Username</th>
                            <th class="center text-center" style="vertical-align: middle; width: 15%;">Role</th>
                            <th class="center text-center" style="vertical-align: middle; width: 25%;">User</th>
                            <th class="center text-center" style="vertical-align: middle; width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td align="center" style="vertical-align: middle;">{{$loop->iteration}}</td>
                            <td style="vertical-align: middle;">{{$user->name}}</td>
                            <td style="vertical-align: middle;">{{$user->username}}</td>
                            @foreach($user->roles as $role)
                            <td style="vertical-align: middle;">{{$role->name}}</td>
                            @endforeach
                            <td style="vertical-align: middle;">
                                @foreach($user->bagian as $bagian)
                                {{$bagian->bagian}},
                                @endforeach
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="row justify-content-center">
                                    @foreach($user->roles as $role)
                                    @if($role->name == 'Admin')
                                    <a class="btn btn-dark btn-xs mr-1"><i class="fas fa-ban"></i></a>
                                    @else
                                    <form action="{{route('user.destroy', ['user' => $user->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-xs btn-danger mr-1" data-toggle="confirmation" data-placement="left" data-singleton="true"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    @endif
                                    @endforeach
                                    <form action="{{route('user.reset', ['user' => $user->id])}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-xs btn-info" data-toggle="confirmation" data-placement="top" data-singleton="true"><b>Reset Password</b></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>User</th>
                            <th>Aksi</th>
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
        $('#userTable tfoot th').each(function() {
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
                
                initComplete: function() {
                    // Top
                    // var r = $('#userTable tfoot tr');
                    // r.find('th').each(function() {
                    //     $(this).css('padding', 8);
                    // });
                    // $('#userTable thead').append(r);
                    // $('#search_0').css('text-align', 'center');
                    // End Top

                    this.api().columns([0, 1, 2]).every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });

                    this.api().columns([3, 4]).every(function() {
                        var column = this;
                        var select = $('<select class="form-control" style="font-size:inherit;"><option  value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    });
                },
            });
        });
    });
</script>
@endpush