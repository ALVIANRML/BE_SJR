<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $stok = Stok::all();

            return response()->json([
                'message' => 'Berhasil menampilkan semua data',
                'success' => true,
                'status' => 200,
                'data' => $stok,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menampilkan data',
                'success' => false,
                'status' => 500,
            ], 500);
        }
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
            $validate = $request->validate([
                'id_item' => 'required|exists:item,id',
                'jumlah_item' => 'required',
            ]);

            $stok = Stok::create($validate);

            return response()->json([
                'message' => 'Data berhasil di tambahkan',
                'success' => true,
                'data' => $stok,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data gagal disimpan '.$e,
                'success' => false,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $stok = Stok::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil di Tampilkan',
                'data' => $stok,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tidak Ditemukan '.$e,
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error '.$e,
            ], 500);
        }

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
        try {
            $validate = $request->validate([
                'id_item' => 'required|exists:item,id',
                'jumlah_item' => 'required',
            ]);

            $stok = Stok::findOrFail($id);
            $stok->update($validate);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil di Update',
                'data' => $stok,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tidak Ditemukan '.$e,
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'message' => 'Error '.$e,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = Stok::destroy($id);
            if ($deleted === 0) {
                return response()->json([
                    'message' => 'Data tidak ditemukan',
                    'status' => 404,
                ], 404);
            }

            return response()->json([
                'message' => 'Data berhasil dihapus',
                'status' => 200,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error'.$e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }
}
