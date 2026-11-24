<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $perusahaan = Perusahaan::all();

            return response()->json([
                'message' => 'Data berhasil di tampilkan',
                'data' => $perusahaan,
                'success' => true,
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'success' => false,
            ], 404);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Data gagal di tampilkan',
                'success' => false,
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
                'nama' => 'required',
            ]);

            $perusahaan = Perusahaan::create($validate);

            return response()->json([
                'message' => 'Data berhasil di tambahkan',
                'data' => $perusahaan,
                'success' => true,
            ], 200);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Data gagal ditambahkan',
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
            $perusahaan = Perusahaan::findOrFail($id);

            return response()->json([
                'message' => 'Data berhasil di tampilkan',
                'data' => $perusahaan,
                'success' => true,
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'success' => false,
            ], 404);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Data gagal di tampilkan',
                'success' => false,
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
            $validate = $request->validate(['nama' => 'required']);
            $perusahaan = Perusahaan::findOrFail($id);
            $perusahaan->update($validate);

            return response()->json([
                'message' => 'Data berhasil di update',
                'data' => $perusahaan,
                'success' => true,
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'success' => false,
            ], 404);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Data gagal di update',
                'success' => false,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = Perusahaan::destroy($id);

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
