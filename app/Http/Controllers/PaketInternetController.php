<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaketInternet;
use App\Http\Requests\UpdatePaketInternet;
use App\Models\PaketInternet;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaketInternetController extends Controller
{
    public function index()
    {
        try {
            $paket_internet = PaketInternet::orderBy('created_at', 'asc')->paginate(10);
            $paket_options = PaketInternet::Paket_Internet;
            return view('paket_internet.index', compact('paket_internet', 'paket_options'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function store(StorePaketInternet $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();
                PaketInternet::create($validated);
            });

            return redirect()->route('paket_internet.index')->with('success', 'Paket Internet berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(PaketInternet $paketInternet)
    {
        try {
            $paket_options = PaketInternet::Paket_Internet;
            return view('paket_internet.edit', compact('paketInternet', 'paket_options'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(UpdatePaketInternet $request, PaketInternet $paketInternet)
    {
        try {
            DB::transaction(function () use ($request, $paketInternet) {
                $validated = $request->validated();
                $paketInternet->update($validated);
            });

            return redirect()->route('paket_internet.index')->with('success', 'Paket Internet berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(PaketInternet $paketInternet)
    {
        try {
            $paketInternet->delete();
            return redirect()->route('paket_internet.index')->with('success', 'Paket Internet berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
