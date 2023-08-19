@extends('layouts.master-dashboard')
@section('page-title', 'Pengguna Sistem')
@section('active-user','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('user.index')}}">Pengguna Sistem</a></li>
    <li class="breadcrumb-item active">Tambah Pengguna Sistem</li>
</ol>
@endsection
@section('dashboard')
<div class="card">
    <div class="card-header bg-primary">
        <h6 class="card-title pt-1">Tambah Pengguna Sistem</h6>
        <div class="card-tools">
            <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
            </button>
            <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('user.store')}}" method="POST">
            <div class="row">
                <div class="col-6">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="name">Nama Lengkap<span class="required">*</span></label>
                        <input id="name" name="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{old('name')}}" autofocus placeholder="Nama Lengkap">
                        @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="username">Username<span class="required">*</span></label>
                        <input id="username" name="username" type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" value="{{old('username')}}" placeholder="Username">
                        @error('username')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="role">Role<span class="required">*</span></label>
                        <select id="role" name="role" class="form-control form-control-sm select2bs4 @error('role') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih Role --">
                            <option value=''></option>
                            <option value='Admin' @if(old('role')=='Admin' ) selected @endif>Admin</option>
                            <option value='Buyer' @if(old('role')=='Buyer' ) selected @endif>Buyer</option>
                            <option value='User' @if(old('role')=='User' ) selected @endif>User</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="bagian_id">User</label>
                        <select id="bagian_id" name="bagian_id[]" multiple class="form-control form-control-sm select2bs4 @error('bagian_id') is-invalid @enderror" style="width: 100%; font: size 12px;" data-placeholder="-- Pilih --">
                            <option value=''></option>
                            @foreach($bagian as $part)
                            @if(old('bagian_id'))
                            <option value="{{ $part->id }}" {{ in_array($part->id, old('bagian_id')) ? 'selected' : '' }}>{{ $part->bagian }}</option>
                            @else
                            <option value="{{ $part->id }}">{{ $part->bagian }}</option>
                            @endif
                            @endforeach
                        </select>
                        <span style="font-size: smaller;">Hanya isi ketika <b>Role</b> yang dipilih adalah <b>User</b></span>
                        @error('bagian_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-form-label-xs" for="password">Password<span class="required">*</span></label>
                        <input id="password" name="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" value="{{'Petrokimia1'}}" placeholder="Kata Sandi">
                        <span style="font-size: smaller;">Default Password: <span style=" font-weight: lighter;">Petrokimia1</span></span>
                        @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6 align-self-center">
                    <div class="row ml-3 mr-0">
                        <p style="text-align: justify;"><span style="font-weight: bold; font-size: large;"> PANDUAN PENGISIAN PASSWORD </span> <br>
                            <span style="font-size: 12px;"> 1. Password terdiri dari minimal 8 karakter. <br>
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