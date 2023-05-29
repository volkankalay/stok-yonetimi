<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $now = now()->toDateTimeString();

            $store = [
                'name' => $request->input('name'),
                'owner_id' => Auth::id(),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            DB::table('stores')->insert($store);
        });

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $store = DB::table('stores')
            ->selectRaw('*')
            ->whereNull('deleted_at')
            ->where('owner_id', Auth::id())
            ->where('id', $id)
            ->first();

        $stocks = DB::table('stocks')
            ->selectRaw('*')
            ->whereNull('deleted_at')
            ->where('owner_id', Auth::id())
            ->where('store_id', $id)
            ->get();

        return view('store.index', compact('store', 'stocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        DB::transaction(function () use ($request, $id) {
            $now = now()->toDateTimeString();

            DB::table('stores')
                ->where('id', $id)
                ->update(['name' => $request->input('name'), 'updated_at' => $now]);
        });

        return redirect()->route('stores.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $record = Store::find($id);
        $record->delete();

        return redirect()->route('dashboard');
    }
}
