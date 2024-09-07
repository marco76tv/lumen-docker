<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number'
    ];

    /**
     * Relazione uno a molti con ProfileAttribute.
     */
    public function attributes()
    {
        return $this->hasMany(ProfileAttribute::class);
    }
}
