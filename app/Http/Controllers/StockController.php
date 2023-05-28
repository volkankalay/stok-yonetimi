<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCreateRequest;
use App\Http\Requests\StockHistoryCreateRequest;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StockController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StockCreateRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $now = now()->toDateTimeString();

            $store = [
                'created_at' => $now,
                'updated_at' => $now,
                'owner_id' => Auth::id(),
                'store_id' => $request->input('store_id'),
                'name' => $request->input('name'),
                'unit' => $request->input('unit'),
                'stock_amount' => (float)$request->input('stock_amount'),
            ];

            $stockId = DB::table('stocks')->insertGetId($store);

            $history = [
                'created_at' => $now,
                'updated_at' => $now,
                'owner_id' => Auth::id(),
                'store_id' => $store['store_id'],
                'stock_id' => $stockId,
                'direction' => $store['stock_amount'] < 0 ? -1 : 1,
                'change' => abs($store['stock_amount'])
            ];

            DB::table('stock_histories')->insert($history);
        });

        return redirect()->route('stores.show', $request->input('store_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        /** @var Stock $stock */
        $stock = DB::table('stocks')
            ->selectRaw('*')
            ->whereNull('deleted_at')
            ->where('owner_id', Auth::id())
            ->where('id', $id)
            ->first();

        $histories = DB::table('stock_histories')
            ->selectRaw('*')
            ->whereNull('deleted_at')
            ->where('stock_id', $stock->id)
            ->orderByDesc('id')
            ->get();

        $store = DB::table('stores')
            ->selectRaw('*')
            ->whereNull('deleted_at')
            ->where('id', $stock->store_id)
            ->first();

        return view('stock.index', compact('store', 'stock', 'histories'));
    }

    /**
     * @param StockHistoryCreateRequest $request
     * @return RedirectResponse
     */
    public function addHistory(StockHistoryCreateRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $now = now()->toDateTimeString();

            $history = [
                'created_at' => $now,
                'updated_at' => $now,
                'owner_id' => Auth::id(),
                'store_id' => $request->input('store_id'),
                'stock_id' => $request->input('stock_id'),
                'direction' => ($request->input('change') < 0) ? -1 : 1,
                'change' => abs($request->input('change'))
            ];

            DB::table('stock_histories')->insert($history);

            DB::table('stocks')
                ->where('id', $history['stock_id'])
                ->update(['stock_amount' => DB::raw('stock_amount + ' . ($history['change'] * $history['direction']))]);
        });

        return redirect()->route('stocks.show', $request->input('stock_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request): RedirectResponse
    {
        $record = Stock::find($id);
        $record->delete();

        return redirect()->route('stores.show', $request->input('store_id'));
    }
}
