<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBandwidth;
use App\Http\Requests\UpdateBandwidth;
use App\Models\Bandwidth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BandwidthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bandwidths = Bandwidth::orderBy('created_at', 'asc')->paginate(10);
            $bandwidth_options = Bandwidth::Options();
            return view('bandwidth.index', compact('bandwidths', 'bandwidth_options'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
    public function store(StoreBandwidth $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();
                Bandwidth::create($validated);
            });

            return redirect()->route('bandwidth.index')->with('success', 'Bandwidth berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bandwidth $bandwidth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bandwidth $bandwidth)
    {
        try {
            $bandwidth_options = Bandwidth::Options();
            return view('bandwidth.edit', compact('bandwidth', 'bandwidth_options'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBandwidth $request, Bandwidth $bandwidth)
    {
        try {
            DB::transaction(function () use ($request, $bandwidth) {
                $validated = $request->validated();
                $bandwidth->update($validated);
            });

            return redirect()->route('bandwidth.index')->with('success', 'Bandwidth berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bandwidth $bandwidth)
    {
        try {
            $bandwidth->delete();
            return redirect()->route('bandwidth.index')->with('success', 'Bandwidth berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
