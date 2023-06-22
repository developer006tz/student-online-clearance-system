<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clear extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'clearance_id',
        'user_id',
        'role',
        'comment',
        'signature',
        'date',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function clearance()
    {
        return $this->belongsTo(Clearance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
