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

        // Mengambil data dari tabel Kriteria
        $kriteria = Kriteria::all();

        // Mengambil data dari tabel AlternatifKriteriaValue
        $altkrit = AlternatifKriteriaValue::all();

        // Membuat array untuk menyimpan bobot kriteria
        $weights = [];

        // Mengisi bobot kriteria sesuai dengan data dari tabel Kriteria
        $totalWeight = 0; // Menyimpan jumlah total bobot

        foreach ($kriteria as $k) {
            $weights[$k->id] = $k->bobot; // Bobot kriteria disimpan dalam array
            $totalWeight += $k->bobot; // Menambahkan bobot ke jumlah total
        }

        // Mengubah bobot kriteria menjadi bobot yang telah dibagi dengan jumlah bobot keseluruhan
        foreach ($weights as $kriteriaId => $bobot) {
            $weights[$kriteriaId] = round($bobot / $totalWeight, 2);
        }

        // Membuat array untuk menyimpan nilai terbobot
        $weightedValues = [];

        // Menghitung nilai terbobot untuk setiap alternatif
        foreach ($alternatif as $a) {
            $weightedValue = 1;
            foreach ($kriteria as $k) {
                // Mencari data dari tabel AlternatifKriteriaValue berdasarkan id alternatif dan kriteria
                $altKriteriaData = $altkrit->where('alternatif_id', $a->id)->where('kriteria_id', $k->id)->first();

                // Periksa apakah data ditemukan
                $value = $altKriteriaData->value;

                if ($k->attribut == 'benefit') {
                    $weightedValue *= pow($value, $weights[$k->id]);
                } else { // Jika atribut adalah "cost"
                    // Menggunakan nilai negatif untuk atribut "cost"
                    $weightedValue *= pow($value, -$weights[$k->id]);
                }
            }
            $weightedValues[$a->id] = round($weightedValue, 4);
        }

        // dd($weightedValues);
        // Menghitung nilai V (Vektor S)
        $totalWeightedValues = array_sum($weightedValues);

        // Membuat array untuk menyimpan nilai V (Vektor S) final
        $finalValues = [];

        // Menghitung nilai V (Vektor S) final untuk setiap alternatif
        foreach ($alternatif as $a) {
            $finalValue = $weightedValues[$a->id] / $totalWeightedValues;
            $finalValues[$a->id] = round($finalValue, 4);
        }


        // dd($finalValues);

        // Menentukan alternatif terbaik
        // $bestAlternative = collect($finalValues)->keys()->max();

        return view('menu.methodewp', compact('weightedValues', 'finalValues', 'alternatif'));
    }

    public function hasil()
    {

        // Mengambil data dari tabel Alternatif
        $alternatif = Alternatif::all();

        // Mengambil data dari tabel Kriteria
        $kriteria = Kriteria::all();

        // Mengambil data dari tabel AlternatifKriteriaValue
        $altkrit = AlternatifKriteriaValue::all();

        // Membuat array untuk menyimpan bobot kriteria
        $weights = [];

        // Mengisi bobot kriteria sesuai dengan data dari tabel Kriteria
        $totalWeight = 0; // Menyimpan jumlah total bobot

        foreach ($kriteria as $k) {
            $weights[$k->id] = $k->bobot; // Bobot kriteria disimpan dalam array
            $totalWeight += $k->bobot; // Menambahkan bobot ke jumlah total
        }

        // Mengubah bobot kriteria menjadi bobot yang telah dibagi dengan jumlah bobot keseluruhan
        foreach ($weights as $kriteriaId => $bobot) {
            $weights[$kriteriaId] = round($bobot / $totalWeight, 2);
        }

        // Membuat array untuk menyimpan nilai terbobot
        $weightedValues = [];

        // Menghitung nilai terbobot untuk setiap alternatif
        foreach ($alternatif as $a) {
            $weightedValue = 1;
            foreach ($kriteria as $k) {
                // Mencari data dari tabel AlternatifKriteriaValue berdasarkan id alternatif dan kriteria
                $altKriteriaData = $altkrit->where('alternatif_id', $a->id)->where('kriteria_id', $k->id)->first();

                // Periksa apakah data ditemukan
                $value = $altKriteriaData->value;

                if ($k->attribut == 'benefit') {
                    $weightedValue *= pow($value, $weights[$k->id]);
                } else { // Jika atribut adalah "cost"
                    // Menggunakan nilai negatif untuk atribut "cost"
                    $weightedValue *= pow($value, -$weights[$k->id]);
                }
            }
            $weightedValues[$a->id] = round($weightedValue, 4);
        }

        // dd($weightedValues);
        // Menghitung nilai V (Vektor S)
        $totalWeightedValues = array_sum($weightedValues);

        // Membuat array untuk menyimpan nilai V (Vektor S) final
        $finalValues = [];

        // Menghitung nilai V (Vektor S) final untuk setiap alternatif
        foreach ($alternatif as $a) {
            $finalValue = $weightedValues[$a->id] / $totalWeightedValues;
            $finalValues[$a->id] = round($finalValue, 4);
        }

        arsort($finalValues);

        // Inisialisasi array untuk menyimpan peringkat
        $ranking = [];

        // Hitung peringkat dan simpan dalam array
        $rank = 1;
        foreach ($finalValues as $alternatifId => $finalValue) {
            $alternatif = Alternatif::find($alternatifId); // Mengambil data alternatif berdasarkan ID

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
