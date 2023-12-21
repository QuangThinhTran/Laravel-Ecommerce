<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 */
class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role';
    protected $fillable = [
        'name'
    ];
}
