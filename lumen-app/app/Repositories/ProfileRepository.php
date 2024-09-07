<?php

namespace App\Repositories;

use App\Models\Profile;

class ProfileRepository
{
    public function create(array $data)
    {
        return Profile::create($data);
    }

    public function update($id, array $data)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($data);
        return $profile;
    }

    public function delete($id)
    {

        $profile = Profile::findOrFail($id);
        $profile->delete();
        return $profile;
    }

    public function find($id)
    {
        return Profile::findOrFail($id);
    }

    public function all()
    {
        return Profile::all();
    }
}
