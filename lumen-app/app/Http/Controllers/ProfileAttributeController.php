<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileAttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileAttributeController extends Controller
{
    protected $attributeRepo;

    public function __construct(ProfileAttributeRepository $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function index()
    {
        $attributes = $this->attributeRepo->all();
        return response()->json($attributes);
    }

    public function show($id)
    {
        $attribute = $this->attributeRepo->find($id);
        return response()->json($attribute);
    }

    public function store(Request $request)
    {

        $validated = $this->validate($request, [
            //'profile_id' => 'required|exists:profiles,id',
            'profile_id' => 'required',
            'attribute' => 'required|string',
        ]);

        $attribute = $this->attributeRepo->create($validated);

        // Log dell'operazione
        Log::info('Created profile attribute with ID: ' . $attribute->id);

        return response()->json($attribute, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            //'profile_id' => 'sometimes|required|exists:profiles,id',
            'profile_id' => 'sometimes|required',
            'attribute' => 'sometimes|required|string',
        ]);

        $attribute = $this->attributeRepo->update($id, $validated);

        // Log dell'operazione
        Log::info('Updated profile attribute with ID: ' . $attribute->id);

        return response()->json($attribute);
    }

    public function destroy($id)
    {
        $attribute = $this->attributeRepo->delete($id);

        // Log dell'operazione
        Log::info('Deleted profile attribute with ID: ' . $attribute->id);

        return response()->json(null, 204);
    }
}
