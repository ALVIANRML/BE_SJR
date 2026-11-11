<?php

namespace App\Http\Controllers;

use App\Models\Tebusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TebusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_pt' => 'required',
                'nomor_sh' => 'required',
                'nomor_surat' => 'required',
                'kode_pt' => 'required',
                'bulan_romawi' => 'required',
                'tahun' => 'required',
                'metode_tebusan' => 'required',
                'tanggal' => 'required',

                'items' => 'required|array|min:1',
                'items.*.id_stok' => 'required|exists:stok,id',
                'items.*.jumlah' => 'required|numeric|min:1',
                'items.*.harga' => 'nullable|numeric|min:0',
            ]);

            $result = DB::transaction(function () use ($validated) {

                // Data tebusan
                $dataTebusan = collect($validated)
                    ->except('items')
                    ->toArray();

                $dataTebusan['nomor_tebusan'] = implode('/', [
                    $dataTebusan['nomor_surat'],
                    $dataTebusan['kode_pt'],
                    $dataTebusan['bulan_romawi'],
                    $dataTebusan['tahun'],
                ]);

                // Simpan tebusan
                $tebusan = Tebusan::create($dataTebusan);

                // Simpan banyak item
                $items = $tebusan->items()->createMany(
                    $validated['items']
                );

                return [
                    'tebusan' => $tebusan,
                    'items' => $items,
                ];
            });

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'success' => true,
                'data_tebusan' => $result['tebusan'],
                'data_item' => $result['items'],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data gagal disimpan '.$e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
