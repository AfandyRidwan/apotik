@extends('header.sidebar')
@section('main')
<body>
	<div class="container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

				<h4>Form Edit Berobat</h4>
				<form class="m-3 mt-5" action="{{route('berobat.update',$berobat->no_transaksi)}}" method="POST">
					@csrf <!-- harus menyertakan ini -->
                    @method("PATCH")
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No Transaksi</label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control @error('no_transaksi') is-invalid @enderror" id="no_transaksi" readonly="" value="{{$berobat->no_transaksi}}" name="no_transaksi">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            Nama tidak boleh kosong.
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Nama Pasien</label>
                        <div class="col-sm-9">
                        <select name="pasien_id" class="form-control" required>
                                <option value="">--- Pilih Pasien ---</option>
                                @foreach ($pasiens as $pasien)
                                    <option value="{{$pasien->pasien_id}}"
                                        {{ $berobat->pasien_id == $pasien->pasien_id ? "selected" : ""  }}>{{$pasien->nama_pasien}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Tanggal Berobat</label>
                        <div class="col-sm-3">
                        <select name="tanggal" class="form-control" required>
                            <option value="">- Tanggal -</option>
                            @php
                                for ($i=1; $i<=31; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            @endphp
                        </select>
                        </div>
                        <div class="col-sm-3">
                        <select name="bulan" class="form-control" required>
                                <option value="">- Bulan -</option>
                                @php
                                    $bulan=['Januari','Februari','Maret','April','Juni','Juli','Agustus','September','Oktober','November','Desember']
                                @endphp

                                @foreach ($bulan as $index=>$bulan_item)
                                <option value="{{$index+1}}">{{$bulan_item}}</option>
                                @endforeach
                        </select>
                        </div>
                        <div class="col-sm-3">
                        <select name="tahun" class="form-control" required>
                                <option value="">- Tahun -</option>
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
                        <select name="dokter_id" class="form-control" required>
                                <option value="">--- Pilih Dokter ---</option>
                                @foreach ($dokter as $dokter_item)
                                    <option value="{{$dokter_item->dokter_id}}"
                                        {{$berobat->dokter_id == $dokter_item->dokter_id ? "selected" :  ""  }}>{{$dokter_item->nama_dokter}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Keluhan</label>
                        <div class="col-sm-9">
                        <textarea  class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan">{{$berobat->keluhan}}</textarea>
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            Field ini tidak boleh kosong
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Biaya Adm</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" id="biaya_adm" name="biaya_adm" value="{{$berobat->biaya_adm}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" >Simpan</button>
                        <button type="reset" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
@endsection
