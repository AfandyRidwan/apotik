@extends('header.sidebar')
@section('main')
<body>
	<div class="container">
        <h4>Form Add Berobat</h4>
        <form class="m-3 mt-5" action="{{route('berobat.store')}}" method="POST">
            @csrf <!-- harus menyertakan ini -->
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">No Transaksi</label>
                <div class="col-sm-9">
                <input type="email" class="form-control" id="no_transaksi" readonly="" value="{{$no_transaksi}}" name="no_transaksi" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Pasien</label>
                <div class="col-sm-9">
                <select name="pasien_id" id="pasien_id" class="form-control select2">
                        <option value="{{ old('pasien_id') }}">--- Pilih Pasien ---</option>
                        @foreach ($pasiens as $pasien)
                            <option value="{{$pasien->pasien_id}}">{{$pasien->nama_pasien}}</option>
                        @endforeach
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tanggal Berobat</label>
                <div class="col-sm-3">
                <select name="tanggal" id="tanggal" class="form-control">
                    <option value="{{ old('tanggal') }}">- Tanggal -</option>
                    @php
                        for ($i=1; $i<=31; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    @endphp
                </select>
                </div>

                <div class="col-sm-3">
                    <select name="bulan" id="bulan" class="form-control">
                            <option value="{{ old('bulan') }}">- Bulan -</option>
                            @php
                                $bulan=['Januari','Februari','Maret','April','Juni','Juli','Agustus','September','Oktober','November','Desember']
                            @endphp

                            @foreach ($bulan as $index=>$bulan_item)
                            <option value="{{$index+1}}">{{$bulan_item}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="col-sm-3">
                    <select name="tahun" id="tahun" class="form-control">
                            <option value="{{ old('tahun') }}">- Tahun -</option>
                            @php
                                for ($i=2015; $i<=date("Y"); $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            @endphp
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Dokter</label>
                    <div class="col-sm-9">
                        <select name="dokter_id" id="dokter_id" class="form-control">
                                <option value="{{ old('dokter_id') }}">--- Pilih Dokter ---</option>
                                @foreach ($dokter as $dk)
                                    <option value="{{$dk->dokter_id}}">{{$dk->nama_dokter}}</option>
                                @endforeach
                        </select>
                    </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Keluhan</label>
                    <div class="col-sm-9">
                    <textarea  class="form-control @error('keluhan') is-invalid @enderror" id="keluhan"  name="keluhan" value="{{ old('keluhan') }}"> </textarea>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        Field ini tidak boleh kosong
                    </div>
                    </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Biaya Adm</label>
                <div class="col-sm-9">
                <input type="number" class="form-control @error('biaya_adm') is-invalid @enderror"" id="biaya_adm" name="biaya_adm" value="{{ old('biaya_adm') }}">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Field ini tidak boleh kosong
                </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>

        </form>
	</div>
</body>
@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush
