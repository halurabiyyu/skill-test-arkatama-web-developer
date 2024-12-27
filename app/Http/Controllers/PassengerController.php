<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::all();
        return view('passengers.index', compact('passengers'));
    }

    public function create()
    {
        return view('passengers.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'kode_booking' => 'required|string|max:255',
            'data_penumpang' => 'required|string',
            'no_telp' => 'required|integer',
            'pickup_location' => 'required|string|max:255',
        ]);

        // Memproses input data penumpang
        $data = explode(' ', $request->data_penumpang);
        if (count($data) < 3) {
            echo "Format input tidak valid. Gunakan format: NAMA USIA KOTA";
            return redirect()->route('dashboard')->with('error', 'Format input tidak valid. Gunakan format: NAMA USIA KOTA');
        }

        $nama = $data[0];
        $usia = (int)$data[1];
        $kota = $data[2];

        // Validasi tambahan
        if (!is_numeric($usia)) {
            echo "Usia harus berupa angka.";
            return redirect()->back()->with('error', 'Usia harus berupa angka.');
        }

        $tahun_lahir = date('Y') - $usia;

        Passenger::create([
            'kode_booking' => $request->kode_booking,
            'no_telp' => $request->no_telp,
            'pickup_location' => $request->pickup_location,
            'nama' => $nama,
            'kota' => $kota,
            'usia' => $usia,
            'tahun_lahir' => $tahun_lahir
        ]);

        return redirect()->route('dashboard')->with('success', 'Passenger created successfully.');
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