@extends('layouts.master-dashboard')
@section('page-title', 'Ubah Password')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('user.index')}}">Pengguna Sistem</a></li>
    <li class="breadcrumb-item active">Ubah Password</li>
</ol>
@endsection
@section('dashboard')
<div class="card">
    <div class="card-header bg-warning">
        <h6 class="card-title pt-1">Form Ubah Password</h6>
        <div class="card-tools">
            <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
            </button>
            <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('user.update', ['user' => Auth::user()->id])}}" method="POST">
            <div class="row">
                <div class="col-6">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="name">Nama Lengkap</label>
                        <input name="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{Auth::user()->name}}" readonly autocomplete="name" placeholder="Nama Lengkap">
                        @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="username">Username</label>
                        <input name="username" type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" value="{{Auth::user()->username}}" readonly autocomplete="username" placeholder="Username">
                        @error('username')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="role">Role</label>
                        <input name="role" type="text" class="form-control form-control-sm @error('role') is-invalid @enderror" value="{{Auth::user()->roles->first()->name}}" readonly autocomplete="role" placeholder="role">
                        @error('role')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="bagian">User</label>
                        <input name="bagian" type="text" class="form-control form-control-sm @error('bagian') is-invalid @enderror" @php $data=""; @endphp @foreach(Auth::user()->bagian as $bagian) @php $data .= $bagian->bagian.', '; @endphp @endforeach value="{{$data}}" readonly autocomplete="bagian">
                        @error('bagian')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="password_lama">Password Lama<span class="required">*</span></label>
                        <input type="password" class="form-control form-control-sm @error('password_lama') is-invalid @enderror" name="password_lama" value="{{ old('password_lama') }}" autofocus placeholder="Password Lama">
                        @error('password_lama')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-xs" for="password_baru">Password Baru<span class="required">*</span></label>
                            <input type="password" class="form-control form-control-sm @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru" value="{{ old('password_baru') }}" placeholder="Password Baru">
                            @error('password_baru')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label col-form-label-xs" for="password_konfirmasi">Konfirmasi Password Baru<span class="required">*</span></label>
                            <input type="password" class="form-control form-control-sm @error('password_konfirmasi') is-invalid @enderror" id="konfirmasi_password" name="password_konfirmasi" value="{{ old('password_konfirmasi') }}" placeholder="Konfirmasi Password Baru">
                            @error('password_konfirmasi')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-6 align-self-center">
                    <div class="row mx-3">
                        <p style="text-align: justify;"><span style="font-weight: bold; font-size: large;"> PANDUAN PENGISIAN PASSWORD </span> <br>
                            <span style="font-size: small;"> 1. Password terdiri dari minimal 8 karakter. <br>
                                2. Password setidaknya memiliki 1 huruf besar dan 1 huruf kecil. <br>
                                3. Password merupakan kombinasi huruf dan angka. <br> </span>
                        </p>
                        <p style="font-size: small; text-align: justify;"> <i class="fas fa-info-circle" style="color: blue;"></i> Pengguna dapat mengganti password sesuai dengan keinginannya, dan menjaganya agar selalu bersifat rahasia. <br></br>
                            <i class="fas fa-info-circle" style="color: blue;"></i> Setiap penyalahgunaan hak akses oleh pihak lain menjadi tanggung jawab pemilik User ID dan password.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end mr-0">
                <button type="submit" class="btn btn-success btn-xs" data-toggle="confirmation" data-placement="left">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection