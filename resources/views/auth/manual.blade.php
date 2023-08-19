@extends('layouts.master-dashboard')
@section('page-title', 'Panduan Pengguna')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Panduan Pengguna</li>
</ol>
@endsection
@section('dashboard')
<div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">Panduaan Pengguna</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body pt-0 pb-2">
            <div class="table-responsive">
                <table id="vendorTable" class="table table-sm table-hovered table-bordered table-hover table-striped mt-4">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Panduan Pengguna Admin</td>
                            <td class="text-center"><a href="{{asset('/file/User_Manual_Admin.pdf')}}">Lihat</a></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Panduan Pengguna Buyer</td>
                            <td class="text-center"><a href="{{asset('/file/User_Manual_Buyer.pdf')}}">Lihat</a></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Panduan Pengguna User</td>
                            <td class="text-center"><a href="{{asset('/file/User_Manual_User.pdf')}}">Lihat</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection