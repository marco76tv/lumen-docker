<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

    public function index()
    {
        $profiles = $this->profileRepo->all();
        return response()->json($profiles);
    }

    public function show($id)
    {
        $profile = $this->profileRepo->find($id);
        return response()->json($profile);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string',
        ]);



        $validated['phone_number'] = $this->sanitizePhoneNumber($validated['phone_number'] ?? null);

        $profile = $this->profileRepo->create($validated);

        Log::info('Created profile with ID: ' . $profile->id);

        return response()->json($profile, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|nullable|string',
        ]);

        // Sanifica il numero di telefono
        if (isset($validated['phone_number'])) {
            $validated['phone_number'] = $this->sanitizePhoneNumber($validated['phone_number']);
        }

        $profile = $this->profileRepo->update($id, $validated);

        // Log dell'operazione
        Log::info('Updated profile with ID: ' . $profile->id);

        return response()->json($profile);
    }

    public function destroy($id)
    {

        $profile = $this->profileRepo->delete($id);

        // Log dell'operazione
        Log::info('Deleted profile with ID: ' . $profile->id);

        return response()->json(null, 204);
    }

    private function sanitizePhoneNumber($phoneNumber)
    {
        // Rimuove il prefisso internazionale
        return preg_replace('/^\+\d{1,3}/', '', $phoneNumber);
    }
}
