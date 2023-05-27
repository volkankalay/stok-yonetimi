<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StockCreateRequest $request): RedirectResponse
    {
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

        DB::table('stocks')->insert($store);

        return redirect()->route('stores.show', $request->input('store_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
