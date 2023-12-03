<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Factory;
use App\Http\Controllers\Controller;
use App\Http\Resources\FactoryResource;

class FactoryAPIController extends Controller
{
	public function index()
    {
        $factories = Factory::all();

        return FactoryResource::collection($factories);
    }

    public function show(Factory $factory)
    {
        if (!$factory) {
            return response()->json(['message' => 'Factory not found'], 404);
        }

        return new FactoryResource($factory);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'letter_number' => 'nullable|string',
        ]);

        $factory = Factory::create($validatedData);

        return new FactoryResource($factory);
    }

     public function update(Request $request, Factory $factory)
    {
        if (!$factory) {
            return response()->json(['message' => 'Factory not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string',
            'letter_number' => 'nullable|string',
        ]);

        $factory->update($validatedData);

        return new FactoryResource($factory);
    }

    public function destroy(Factory $factory)
    {
        if (!$factory) {
            return response()->json(['message' => 'Factory not found'], 404);
        }

        $factory->delete();

        return response()->json(['message' => 'Factory deleted successfully']);
    }
}