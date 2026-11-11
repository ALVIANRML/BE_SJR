<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $segment = Segment::all();

            return response()->json([
                'message' => 'Data Berhasil di tampilkan',
                'success' => true,
                'status' => 200,
                'data' => $segment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error'.$e->getMessage(),
                'success' => false,
                'code' => 500,
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
            $validated = $request->validate([
                'nama' => 'required',
            ]);

            $segment = Segment::create([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di simpan',
                'data' => $segment,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $segment = Segment::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditampilkan',
                'data' => $segment,
                'code' => 200,
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Segment tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error'.$e->getMessage(),
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
            $validated = $request->validate([
                'nama' => 'required',
            ]);
            $segment = Segment::findOrFail($id);

            $segment->update([
                'nama' => $validated['nama'],
            ]);

            return response()->json([
                'message' => 'Data berhasil di update',
                'success' => true,
                'data' => $segment,
                'code' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Data segment tidak ditemukan'.$e->getMessage(),
                'success' => false,
                'code' => 404,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data Gagal di update'.$e->getMessage(),
                'success' => false,
                'code' => 500,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = Segment::destroy($id);

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
