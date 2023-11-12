<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteriaValue;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return view('data.index');
    }

    public function indexkriteria()
    {
        $kriteria = Kriteria::orderBy('id', 'DESC')->get();
        $allKriteria = Kriteria::all();
        $totalBobot = $allKriteria->sum('bobot');

        return view('data.kriteria.index', compact('kriteria', 'totalBobot'));
    }

    public function createkriteria()
    {
        return view('data.kriteria.create');
    }

    public function storekriteria(Request $request)
    {

        $this->validate($request, [
            'kriteria' => 'required',
            'bobot' => 'required',
            'attribut' => 'required',
        ]);


        $tambahKriteria = Kriteria::create([
            'kriteria' => $request->kriteria,
            'bobot' => $request->bobot,
            'attribut' => $request->attribut,
        ]);

        if ($tambahKriteria) {
            AlternatifKriteriaValue::truncate();
        }

        return redirect()->route('data')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function editkriteria(string $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        return view('data.kriteria.edit', compact('kriteria'));
    }

    public function updatekriteria(Request $request, string $id)
    {
        $this->validate($request, [
            'kriteria' => 'required',
            'bobot' => 'required',
            'attribut' => 'required',
        ]);

        $kriteria = Kriteria::findOrFail($id);

        $kriteria->update([
            'kriteria' => $request->kriteria,
            'bobot' => $request->bobot,
            'attribut' => $request->attribut
        ]);

        if ($kriteria) {
            AlternatifKriteriaValue::truncate();
        }

        return redirect()->route('data')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroykriteria(string $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $kriteria->delete();

        if ($kriteria) {
            AlternatifKriteriaValue::truncate();
        }

        return redirect()->route('data')->with(['success' => 'Data Berhasil di Hapus!']);
    }

    public function indexalternatif()
    {
        $alternatif = Alternatif::orderBy('id', 'DESC')->get();

        return view('data.alternatif.index', compact('alternatif'));
    }

    public function createalternatif()
    {
        return view('data.alternatif.create');
    }

    public function storealternatif(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);


        $tambahAlternatif = Alternatif::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        if ($tambahAlternatif) {
            AlternatifKriteriaValue::truncate();
        }

        return redirect()->route('data')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function editalternatif(string $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        return view('data.alternatif.edit', compact('alternatif'));
    }

    public function updatealternatif(Request $request, string $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        $alternatif = Alternatif::findOrFail($id);

        $alternatif->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        if ($alternatif) {
            AlternatifKriteriaValue::truncate();
        }

        return redirect()->route('data')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroyalternatif(string $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $alternatif->delete();

        if ($alternatif) {
            AlternatifKriteriaValue::truncate();
        }

        return redirect()->route('data')->with(['success' => 'Data Berhasil di Hapus!']);
    }

    public function indexdata()
    {
        $data = AlternatifKriteriaValue::all();
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();

        return view('data.data.index', compact('data', 'alternatif', 'kriteria'));
    }

    public function createdata()
    {
        $data = AlternatifKriteriaValue::all();
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        return view('data.data.create', compact('data', 'alternatif', 'kriteria'));
    }

    public function storedata(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $idAlternatif => $kriteriaData) {
            foreach ($kriteriaData as $idKriteria => $rowData) {
                $value = $rowData['value'];
                $idAlternatif = $rowData['id_alternatif'];
                $idKriteria = $rowData['id_kriteria'];

                AlternatifKriteriaValue::where('alternatif_id', $idAlternatif)
                    ->where('kriteria_id', $idKriteria)
                    ->delete();

                AlternatifKriteriaValue::create([
                    'alternatif_id' => $idAlternatif,
                    'kriteria_id' => $idKriteria,
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('data.value')->with(['success' => 'Data berhasil disimpan!']);
    }
}
