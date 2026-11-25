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
                'metode_tebusan' => 'required',
                'tanggal_tebus' => 'required',

                'items' => 'required|array|min:1',
                'items.*.id_item' => 'required|exists:item,id',
                'items.*.jumlah' => 'required|numeric|min:1',

            ]);

            $result = DB::transaction(function () use ($validated) {

                // Data tebusan
                $dataTebusan = collect($validated)
                    ->except('items')
                    ->toArray();



                // Simpan tebusan
                $tebusan = Tebusan::create($dataTebusan);

                // Simpan banyak item
                $items = $tebusan->itemTebusan()->createMany(
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
