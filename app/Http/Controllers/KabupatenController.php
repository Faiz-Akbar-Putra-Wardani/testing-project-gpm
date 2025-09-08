<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = 10;
        $data = Kabupaten::query();

        if ($request->filled('limit') && is_numeric($request->limit)) {
            $limit = intval($request->limit);
        }
        if ($request->filled('type')) {
            $data->where('type', $request->type);
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
        if ($request->filled('provinsi_id')) {
            $data->where('provinsi_id', $request->provinsi_id);
        }
        if ($request->filled('code_provinsi')) {
            $data->whereRelation('provinsi', 'code', $request->code_provinsi);
        }

        $result = $data->with('provinsi')->withCount('kecamatan')->paginate($limit);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $kabupaten = Kabupaten::find($id);
        if (!$kabupaten) {
            return response()->json(['data' => null, 'message' => 'Not Found!'], 404);
        }
        $kabupaten->load('provinsi');
        return response()->json(['data' => $kabupaten, 'message' => 'success']);
    }

    public function getByProvinsi($provinsiId)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $provinsiId)->get(['id', 'name']);
        return response()->json(['data' => $kabupaten, 'message' => 'success']);
    }

    //Route::get('/kabupaten/by-provinsi/{provinsiId}', [KabupatenController::class, 'getByProvinsi']);


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Kabupaten $kabupaten)
    {
        //
    }

    public function update(Request $request, Kabupaten $kabupaten)
    {
        //
    }

    public function destroy(Kabupaten $kabupaten)
    {
        //
    }
}
