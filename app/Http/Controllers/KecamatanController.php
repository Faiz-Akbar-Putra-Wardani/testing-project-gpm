<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = 10;
        $data = Kecamatan::query();

        if ($request->filled('limit') && is_numeric($request->limit)) {
            $limit = intval($request->limit);
        }
        if ($request->filled('name')) {
            $data->where('name', 'like', "%$request->name%");
        }
        if ($request->filled('code')) {
            $data->where('code', $request->code);
        }
        if ($request->filled('full_code')) {
            $data->where('full_code', $request->full_code);
        }
        if ($request->filled('kabupaten_id')) {
            $data->where('kabupaten_id', $request->kabupaten_id);
        }
        if ($request->filled('code_kabupaten')) {
            $data->whereRelation('kabupaten', 'code', $request->code_kabupaten);
        }
        if ($request->filled('provinsi_id')) {
            $data->whereRelation('kabupaten', 'provinsi_id', $request->provinsi_id);
        }
        if ($request->filled('code_provinsi')) {
            $data->whereRelation('kabupaten.provinsi', 'code', $request->code_provinsi);
        }

        $result = $data->with('kabupaten.provinsi')->paginate($limit);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kecamatan = Kecamatan::find($id);
        if (!$kecamatan) {
            return response()->json(['data' => null, 'message' => 'Not Found!'], 404);
        }
        $kecamatan->load('kabupaten.provinsi');
        return response()->json(['data' => $kecamatan, 'message' => 'success']);
    }

    public function getByKabupaten($kabupatenId)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $kabupatenId)->get();
        return response()->json(['data' => $kecamatan, 'message' => 'success']);
    }
    //Route::get('/kecamatan/by-kabupaten/{kabupatenId}', [KecamatanController::class, 'getByKabupaten']);


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        //
    }

    public function destroy(Kecamatan $kecamatan)
    {
        //
    }
}
