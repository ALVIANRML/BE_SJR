<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Item::all();
        try {
            return response()->json([
                'message' => 'Data Berhasil di tampilkan',
                'success' => true,
                'status' => 200,
                'data' => $item,
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
        $validate = $request->validate([
            'id_segment' => 'required|exists:segment,id',
            'nama_item' => 'required',
            'kemasan' => 'required',
            'jumlah_liter' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'harga_tebus' => 'required|numeric|min:0',
        ]);

        try {
            $item = Item::create($validate);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di simpan',
                'data' => $item,
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
            $item = Item::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditampilkan',
                'data' => $item,
                'code' => 200,
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan',
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
            $validate = $request->validate([
                'id_segment' => 'required|exists:segment,id',
                'nama_item' => 'required',
                'kemasan' => 'required',
                'jumlah_liter' => 'required|numeric|min:0',
                'harga_jual' => 'required|numeric|min:0',
                'harga_tebus' => 'required|numeric|min:0',
            ]);
            $item = Item::findOrFail($id);

            $item->update($validate);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $item,
                'code' => 200,
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error'.$e->getMessage(),
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleted = Item::destroy($id);

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
