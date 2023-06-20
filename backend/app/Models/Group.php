<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Model to represent a user
 * 
 * @category Model
 */
class Group extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];


    /**
     * Get the users associated with the group.
     *
     * @return \Illuminate\Database\Eloquent\Collection|User[]
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
