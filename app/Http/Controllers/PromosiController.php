<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromosi;
use App\Http\Requests\UpdatePromosi;
use App\Models\Promosi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $promosis = Promosi::orderBy('created_at', 'asc')->paginate(10);
            return view('promosi.index', compact('promosis'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('promosi.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromosi $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();
                if (!empty($validated['periode_mulai'])) {
                    $validated['periode_mulai'] = Carbon::parse($validated['periode_mulai'])->format('Y-m-d');
                }
                if (!empty($validated['periode_selesai'])) {
                    $validated['periode_selesai'] = Carbon::parse($validated['periode_selesai'])->format('Y-m-d');
                }
                Promosi::create($validated);
            });

            return redirect()->route('promosi.index')->with('success', 'Promosi berhasil disimpan.');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promosi $promosi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promosi $promosi)
    {
        try {
            return view('promosi.edit', compact('promosi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromosi $request, Promosi $promosi)
    {
        try {
            DB::transaction(function () use ($request, $promosi) {
                $validated = $request->validated();
                if (!empty($validated['periode_mulai'])) {
                    $validated['periode_mulai'] = Carbon::parse($validated['periode_mulai'])->format('Y-m-d');
                }
                if (!empty($validated['periode_selesai'])) {
                    $validated['periode_selesai'] = Carbon::parse($validated['periode_selesai'])->format('Y-m-d');
                }
                $promosi->update($validated);
            });

            return redirect()->route('promosi.index')->with('success', 'Promosi berhasil diperbarui.');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promosi $promosi)
    {
        try {
            $promosi->delete();
            return redirect()->route('promosi.index')->with('success', 'Promosi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
