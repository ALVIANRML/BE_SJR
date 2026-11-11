<?php

namespace App\Http\Controllers;

use App\Models\KreditLimit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class KreditLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kreditLimit = KreditLimit::all();

            return response()->json([
                'message' => 'Data berhasil ditampilkan',
                'data' => $kreditLimit,
                'status' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'error'.$e,
                'status' => 404,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error'.$e,
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
                'id_segment' => 'required|exists:segment,id',
                'total_kredit' => 'required',
                'sisa_limit' => 'required',
            ]);

            $kreditLimit = KreditLimit::create($validate);

            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data' => $kreditLimit,
                'status' => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error'.$e,
                'status' => 500,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $kreditLimit = KreditLimit::findOrFail($id);

            return response()->json([
                'message' => 'Data berhasil ditampilkan',
                'data' => $kreditLimit,
                'status' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'error'.$e,
                'status' => 404,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error'.$e,
                'status' => 500,
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
                'id_segment' => 'required|exists:segment,id',
                'total_kredit' => 'required',
                'sisa_limit' => 'required',
            ]);

            $kreditLimit = KreditLimit::findOrFail($id);
            $kreditLimit->update($validate);

            return response()->json([
                'message' => 'Data berhasil diupdate',
                'data' => $kreditLimit,
                'status' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'error'.$e,
                'status' => 404,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error'.$e,
                'status' => 500,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = KreditLimit::destroy($id);

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
