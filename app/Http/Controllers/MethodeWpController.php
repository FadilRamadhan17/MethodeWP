<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteriaValue;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class MethodeWpController extends Controller
{
    public function index()
    {
        $data = AlternatifKriteriaValue::with('kriteria', 'alternatif')->get();

        return view('menu.methodewp', compact('data'));
    }

    public function methodewp()
    {

        // Mengambil data dari tabel Alternatif
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $altkrit = AlternatifKriteriaValue::all();

        if ($altkrit->isEmpty()) {
            return view('kosong.index'); // Mengarahkan ke halaman informasi jika data kosong
        }

        $weights = [];
        $totalWeight = 0;

        foreach ($kriteria as $k) {
            $weights[$k->id] = $k->bobot;
            $totalWeight += $k->bobot;
        }

        // Mengubah bobot kriteria menjadi bobot yang telah dibagi dengan jumlah bobot keseluruhan
        foreach ($weights as $kriteriaId => $bobot) {
            $weights[$kriteriaId] = $bobot / $totalWeight;
        }

        // Membuat array untuk menyimpan nilai terbobot
        $weightedValues = [];

        // Menghitung nilai terbobot untuk setiap alternatif
        foreach ($alternatif as $a) {
            $weightedValue = 1;
            foreach ($kriteria as $k) {
                $altKriteriaData = $altkrit->where('alternatif_id', $a->id)->where('kriteria_id', $k->id)->first();

                $value = $altKriteriaData->value;

                if ($k->attribut == 'benefit') {
                    $weightedValue *= pow($value, $weights[$k->id]);
                } else {
                    $weightedValue *= pow($value, -$weights[$k->id]);
                }
            }
            $weightedValues[$a->id] = $weightedValue;
        }

        $totalWeightedValues = array_sum($weightedValues);

        $finalValues = [];

        foreach ($alternatif as $a) {
            $finalValue = $weightedValues[$a->id] / $totalWeightedValues;
            $finalValues[$a->id] = $finalValue;
        }

        return view('menu.methodewp', compact('weightedValues', 'finalValues', 'alternatif'));
    }

    public function hasil()
    {

        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $altkrit = AlternatifKriteriaValue::all();

        if ($altkrit->isEmpty()) {
            return view('kosong.index'); // Mengarahkan ke halaman informasi jika data kosong
        }

        $weights = [];
        $totalWeight = 0;

        foreach ($kriteria as $k) {
            $weights[$k->id] = $k->bobot;
            $totalWeight += $k->bobot;
        }

        foreach ($weights as $kriteriaId => $bobot) {
            $weights[$kriteriaId] = $bobot / $totalWeight;
        }

        $weightedValues = [];
        foreach ($alternatif as $a) {
            $weightedValue = 1;
            foreach ($kriteria as $k) {
                $altKriteriaData = $altkrit->where('alternatif_id', $a->id)->where('kriteria_id', $k->id)->first();

                $value = $altKriteriaData->value;
                if ($k->attribut == 'benefit') {
                    $weightedValue *= pow($value, $weights[$k->id]);
                } else {
                    $weightedValue *= pow($value, -$weights[$k->id]);
                }
            }
            $weightedValues[$a->id] = $weightedValue;
        }

        $totalWeightedValues = array_sum($weightedValues);
        $finalValues = [];

        foreach ($alternatif as $a) {
            $finalValue = $weightedValues[$a->id] / $totalWeightedValues;
            $finalValues[$a->id] = $finalValue;
        }

        arsort($finalValues);
        $ranking = [];
        $rank = 1;
        foreach ($finalValues as $alternatifId => $finalValue) {
            $alternatif = Alternatif::find($alternatifId);

            if ($alternatif) {
                $ranking[] = [
                    'rank' => $rank,
                    'alternatif_keterangan' => $alternatif->keterangan,
                    'alternatif_name' => $alternatif->nama,
                    'final_value' => $finalValue,
                ];
            }

            $rank++;
        }

        return view('menu.hasil', compact('weightedValues', 'finalValues', 'alternatif', 'ranking'));
    }
}
