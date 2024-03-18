<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tariffs = Tariff::all();
        return response()->json(['tariffs' => $tariffs]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tariff = Tariff::find($id);

        if (!$tariff) {
            return response()->json(['message' => 'Tariff not found'], 404);
        }

        return response()->json(['tariff' => $tariff]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tariff_name' => 'required|string',
            'tariff_type' => 'required|in:per_hour,per_km,per_day',
            'amount' => 'required|string',
            'min_km' => 'string|nullable',
            'per_km' => 'string|nullable',
            'extra_km' => 'string|nullable',
            'seat' => 'required|integer',
            'driver_charge' => 'string|nullable',
            'expensive' => 'string|nullable',
            'status' => 'required|in:active,inactive',
        ]);

        $tariff = Tariff::create($validatedData);

        return response()->json(['tariff' => $tariff], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tariff = Tariff::find($id);

        if (!$tariff) {
            return response()->json(['message' => 'Tariff not found'], 404);
        }

        $validatedData = $request->validate([
            'tariff_name' => 'string',
            'tariff_type' => 'in:per_hour,per_km,per_day',
            'amount' => 'string',
            'min_km' => 'string|nullable',
            'per_km' => 'string|nullable',
            'extra_km' => 'string|nullable',
            'seat' => 'integer',
            'driver_charge' => 'string|nullable',
            'expensive' => 'string|nullable',
            'status' => 'in:active,inactive',
        ]);

        $tariff->update($validatedData);

        return response()->json(['tariff' => $tariff]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tariff = Tariff::find($id);

        if (!$tariff) {
            return response()->json(['message' => 'Tariff not found'], 404);
        }

        $tariff->delete();

        return response()->json(['message' => 'Tariff deleted']);
    }
}
