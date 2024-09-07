<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileAttribute extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $fillable = ['profile_id', 'attribute'];

    /**
     * Relazione inversa con Profile.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
