<div>
    <form wire:submit.prevent="store">
        <div class="form-group">
            <label class="col-form-label col-form-label-xs" for="tender">Nama Pekerjaan<span class="required">*</span></label>
            <input type="text" class="form-control form-control-sm @error('tender') is-invalid @enderror" wire:model="tender"  id="tender" name="tender" placeholder="Nama Pekerjaan">
            @error('tender')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label class="col-form-label col-form-label-xs" for="no_sp">No. SP<span class="required">*</span></label>
            <input type="text" class="form-control form-control-sm @error('no_sp') is-invalid @enderror" wire:model="no_sp" id="no_sp" name="no_sp" placeholder="No. SP">
            @error('no_sp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            {{$no_sp}}
        </div>
        <div class="form-group">
            <label class="col-form-label col-form-label-xs" for="no_agreement">No. Agreement<span class="required">*</span></label>
            <input type="text" class="form-control form-control-sm @error('no_agreement') is-invalid @enderror" wire:model="no_agreement" id="no_agreement" name="no_agreement" placeholder="No. Agreement">
            @error('no_agreement')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        {{$vendor}}
        <div class="form-group">
            <label class="col-form-label col-form-label-xs" for="vendor">Vendor<span class="required">*</span></label>
            <select wire:model="vendor" id="vendor" name="vendor" class="form-control form-control-sm select2bs4 @error('vendor') is-invalid @enderror" style="width: 100%;" data-placeholder="-- Pilih --">
                <option value=''></option>
                @foreach($vendors as $rekanan)
                <option value='{{$rekanan->id}}' {{ old('vendor') == $rekanan->id ? 'selected' : '' }}>{{ $rekanan->vendor }} ({{$rekanan->no}})</option>
                @endforeach
            </select>
            @error('vendor')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="col-form-label col-form-label-xs" for="prosentase">Prosentase<span class="required">*</span></label>
                <div class="input-group" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm @error('prosentase') is-invalid @enderror" wire:model="prosentase" id="prosentase" name="prosentase" placeholder="Prosentase">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-percent"></i></div>
                    </div>
                    @error('prosentase')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="col-form-label col-form-label-xs" for="periode_awal">Periode Awal<span class="required">*</span></label>
                <div class="input-group date" id="reservationdate_add" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_awal') is-invalid @enderror" wire:model="periode_awal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask data-target="#reservationdate_add" placeholder="Periode Awal" name="periode_awal">
                    <div class="input-group-append" data-target="#reservationdate_add" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    @error('periode_awal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label col-form-label-xs" for="periode_akhir">Periode Akhir<span class="required">*</span></label>
                <div class="input-group date" id="reservationdate_add_2" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm datetimepicker-input @error('periode_akhir') is-invalid @enderror" wire:model="periode_akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask data-target="#reservationdate_add_2" placeholder="Periode Akhir" name="periode_akhir">
                    <div class="input-group-append" data-target="#reservationdate_add_2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    @error('periode_akhir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label col-form-label-xs" for="keterangan">Keterangan</label>
            <textarea class="form-control form-control-sm @error('keterangan') is-invalid @enderror" wire:model="keterangan" name="keterangan" rows="3" cols="50" placeholder="Keterangan"></textarea>
            @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="row justify-content-end mr-0">
            <button class="btn btn-success btn-xs text-right">Simpan</button>
        </div>
    </form>
</div>