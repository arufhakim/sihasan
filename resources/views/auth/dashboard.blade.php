@extends('layouts.master-dashboard')
@section('page-title', 'Dashboard')
@section('active-dashboard','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection
@section('dashboard')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$tender}}</h3>

                <p>Pekerjaan</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-briefcase"></i>
            </div>
            <a href="{{route('tender.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$belumRincianHarga}}</h3>
                <p class="my-0 py-0" style="line-height: 19px;">Pekerjaan<span style="color:red;">*</span><br><span style="font-size: 10px;" class="py-0 my-0">Belum memiliki Rincian Harga</span></p>
            </div>
            <div class="icon">
                <i class="ion ion-social-usd"></i>
            </div>
            <a href="{{route('tender.filter', ['name' => 'rincian'])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$belumDetailPekerjaan}}</h3>
                <p class="my-0 py-0" style="line-height: 19px;">Pekerjaan<span style="color:red;">*</span><br><span style="font-size: 10px;" class="py-0 my-0">Belum memiliki Detail Pekerjaan</span></p>
            </div>
            <div class="icon">
                <i class="ion ion-paperclip"></i>
            </div>
            <a href="{{route('tender.filter', ['name' => 'detail'])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$periodeAkhir}}</h3>
                <p class="my-0 py-0" style="line-height: 19px;">Pekerjaan<span style="color:red;">*</span><br><span style="font-size: 10px;" class="py-0 my-0">Mendekati Periode Akhir</span></p>
            </div>
            <div class="icon">
                <i class="ion ion-android-calendar"></i>
            </div>
            <a href="{{route('tender.filter', ['name' => 'tanggal'])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3>{{$detail}}</h3>

                <p>Nomor SP</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('tender.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-pink">
            <div class="inner">
                <h3>{{$detail}}</h3>

                <p>Nomor Agreement</p>
            </div>
            <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
            </div>
            <a href="{{route('tender.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-indigo">
            <div class="inner">
                <h3>{{$kontrak}}</h3>

                <p>Dokumen Kontrak</p>
            </div>
            <div class="icon">
                <i class="ion ion-document-text"></i>
            </div>
            <a href="{{route('tender.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @role('Admin|Jasa Pabrik')
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{$vendor}}</h3>

                <p>Vendor</p>
            </div>
            <div class="icon">
                <i class="ion ion-home"></i>
            </div>
            <a href="{{route('vendor.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-navy">
            <div class="inner">
                <h3>{{$user}}</h3>

                <p>User</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('bagian.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gray">
            <div class="inner">
                <h3>{{$pengguna}}</h3>

                <p>Pengguna Sistem</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    @endrole
</div>
@endsection