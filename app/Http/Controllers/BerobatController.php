<?php

namespace App\Http\Controllers;

use App\Models\Berobat;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerobatController extends Controller
{
    function get_data()
    {
        $view = View::all();
        //$data['datas'] = DB::table('berobat as b')
        //    ->join('pasien as p', 'b.pasien_id', '=', 'p.pasien_id')
        //    ->join('dokter as d', 'b.dokter_id', '=', 'd.dokter_id')
        //    ->join('poli as pl', 'd.poli_id', '=', 'pl.poli_id')
        //    ->select('b.*', 'p.pasien_id', 'p.nama_pasien', 'p.jenis_kelamin', 'p.tanggal_lahir', 'pl.nama_poli', 'd.nama_dokter')
        //    ->get();
        return view('layouts.berobat', compact('view'));
    }
    function add()
    {
        $data['pasiens'] = Pasien::all();
        $data['dokter'] = Dokter::all();

        $count_berobat = Berobat::count();
        $data['no_transaksi'] = "TR" . sprintf('%03d', $count_berobat + 1);
        return view('layouts.berobat-add', $data);
    }
    function store(Request $request)
    {
        $request->validate([
            'no_transaksi' => 'required|string|max:5|min:4',
            'pasien_id' => 'required|string',
            'tanggal' => 'required|numeric',
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
            'dokter_id' => 'required|string',
            'keluhan' => 'required|string',
            'biaya_adm' => 'required|numeric',
        ]);

        //DB::table('berobat')->insert([
        //    'no_transaksi' => $request->no_transaksi,
        //    'pasien_id' => $request->pasien_id,
        //    'tanggal_berobat' => $request->tahun . "-" . $request->bulan . '-' . $request->tanggal,
        //    'dokter_id' => $request->dokter_id,
        //    'keluhan' => $request->keluhan,
        //    'biaya_adm' => $request->biaya_adm
        //]);

        Berobat::create([
            'no_transaksi' => $request->no_transaksi,
            'pasien_id' => $request->pasien_id,
            'tanggal_berobat' => $request->tahun . "-" . $request->bulan . '-' . $request->tanggal,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'biaya_adm' => $request->biaya_adm
        ]);

        //Berobat::create($request->all());

        return redirect()->route('berobat.index')->with('pesan', 'Data berhasil disimpan.');
    }
    function edit(Request $request, $id)
    {
        if (DB::table('berobat')->where('no_transaksi', $id)->exists()) {
            $data['pasiens'] = Pasien::all();
            $data['dokter'] = Dokter::all();
            $data['berobat'] = DB::table('berobat')->where('no_transaksi', $id)->first();
            $tanggal_berobat = DB::table('berobat')->where('no_transaksi', $id)->first()->tanggal_berobat;
            //$data['tanggal'] = strtotime($tanggal_berobat, date("d"));
            //$data['bulan'] = strtotime($tanggal_berobat, date("m"));
            //$data['tahun'] = strtotime($tanggal_berobat, date("y"));
            return view('layouts.berobat-edit', $data);
        } else {
            return redirect()->route('berobat.index')->with('pesan', 'Data Tidak Ditemukan');
        }
    }
    function update(Request $request, $id)
    {
        //$request->validate([
        //    'no_transaksi' => 'required|string|max:5|min:4',
        //    'pasien_id' => 'required|string',
        //    'tanggal' => 'required|numeric',
        //    'bulan' => 'required|numeric',
        //    'tahun' => 'required|numeric',
        //    'dokter_id' => 'required|string',
        //    'keluhan' => 'required|string',
        //    'biaya_adm' => 'required|numeric',
        //]);

        Berobat::where('no_transaksi', $id)->update([
            'pasien_id' => $request->pasien_id,
            'tanggal_berobat' => $request->tahun . "-" . $request->bulan . '-' . $request->tanggal,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'biaya_adm' => $request->biaya_adm
        ]);
        return redirect()->route('berobat.index');
    }
    function delete($id)
    {
        //if (DB::table('berobat')->where('no_transaksi', $id)->exists()) {
        //    DB::table('berobat')->where('no_transaksi', $id)->delete();
        //    return redirect()->route('berobat.index')->with('pesan', 'Data Berhasil di Hapus!');
        //}
        Berobat::destroy($id);
        return redirect()->route('berobat.index')->with('pesan', 'Data Berhasil di Hapus!');
    }
}
