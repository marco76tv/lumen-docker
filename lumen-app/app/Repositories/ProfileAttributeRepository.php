<?php

namespace App\Repositories;

use App\Models\ProfileAttribute;

class ProfileAttributeRepository
{
    public function create(array $data)
    {
        return ProfileAttribute::create($data);
    }

    public function update($id, array $data)
    {
        $attribute = ProfileAttribute::findOrFail($id);
        $attribute->update($data);
        return $attribute;
    }

    public function delete($id)
    {
        $attribute = ProfileAttribute::findOrFail($id);
        $attribute->delete();
        return $attribute;
    }

    public function find($id)
    {
        return ProfileAttribute::findOrFail($id);
    }

    public function all()
    {
        return ProfileAttribute::all();
    }
}
