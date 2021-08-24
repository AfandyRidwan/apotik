@extends('header.sidebar')
@section('main')
<body>
    @if (session('pesan'))
    <div class="alert alert-succes" role="alert">
        {{session('pesan')}}
    </div>
    @endif

    <h4>List Berobat</h4>
    <a href="{{route('berobat.add')}}" class="btn btn-primary mb-3">Tambah Data</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Transaksi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Usia</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Keluhan</th>
            <th scope="col">Nama Poli</th>
            <th scope="col">Dokter</th>
            <th scope="col">Biaya Admin</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($view as $no=>$v)

        <tr>
            <th scope="row">{{$no+1}}</th>
            <td>{{$v->no_transaksi}}</td>
            <td>{{$v->tanggal_berobat}}</td>
            <td>{{$v->nama_pasien}}</td>
            <td>{{$v->usia}}</td>
            <td>{{$v->jenis_kelamin}}</td>
            <td>{{$v->keluhan}}</td>
            <td>{{$v->nama_poli}}</td>
            <td>{{$v->nama_dokter}}</td>
            <td>{{$v->biaya_adm}}</td>
            <td>
                <a class="badge bg-warning text-dark" href="{{route('berobat.edit',$v->no_transaksi)}}">Edit</a> |
                <a class="badge bg-danger text-dark" data-toggle="modal" data-target="#modal-delete{{$no}}">Delete</a>

                <!-- Modal -->
                <div class="modal fade" id="modal-delete{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Modal-deletelLabel">Delete Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('berobat.delete',$v->no_transaksi)}}" METHOD="POST">
                                @csrf
                                @method("DELETE")
                            <div class="modal-body">
                                Apakah anda yakin, akan menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
@endsection
