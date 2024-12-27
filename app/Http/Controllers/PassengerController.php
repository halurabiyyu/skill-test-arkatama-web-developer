<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::all();
        return view('dashboard', compact('passengers'));
    }

    public function create()
    {
        return view('passengers.create');
    }

    public function store(Request $request)
    {   
        try {
            // Validasi input
            $request->validate([
                'kode_booking' => 'required|string|max:255',
                'data_penumpang' => 'required|string',
                'no_telp' => 'required|string',
                'pickup_location' => 'required|string|max:255',
            ]);

            // Debugging input

            // Memproses input data penumpang
            $data = explode(' ', $request->data_penumpang);
            if (count($data) < 3) {
                return redirect()->back()->with('error', 'Format input tidak valid. Gunakan format: NAMA USIA KOTA');
            }

            $nama = $data[0];
            $usia = (int)$data[1];
            $kota = $data[2];

            if (!is_numeric($usia)) {
                return redirect()->back()->with('error', 'Usia harus berupa angka.');
            }

            $tahun_lahir = date('Y') - $usia;

            // Simpan data ke database
            Passenger::create([
                'kode_booking' => $request->kode_booking,
                'nama' => $nama,
                'kota' => $kota,
                'pickup_location' => $request->pickup_location,
                'no_telp' => $request->no_telp,
                'usia' => $usia,
                'tahun_lahir' => $tahun_lahir
            ]);


            return redirect()->route('dashboard')->with('success', 'Passenger created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.' . $e->getMessage());
        }
    }


    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('passengers.show', compact('passenger'));
    }

    public function edit($id)
    {
        $passenger = Passenger::findOrFail($id);
        return view('passengers.edit', compact('passenger'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_booking' => 'string|max:255',
            'nama' => 'string|max:255',
            'jenis_kelamin' => 'string|max:10',
            'kota' => 'string|max:255',
            'usia' => 'integer',
            'tahun_lahir' => 'integer'
        ]);

        $passenger = Passenger::findOrFail($id);
        $passenger->update($request->all());
        return redirect()->route('passengers.index')->with('success', 'Passenger updated successfully.');
    }

    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();
        return redirect()->route('passengers.index')->with('success', 'Passenger deleted successfully.');
    }
}