<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clearance extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'student_id',
        'name',
        'registration_number',
        'block_number',
        'room_number',
        'level',
        'wadern',
        'librarian-udsm',
        'librarian-cse',
        'coordinator',
        'principal',
        'smart-card',
    ];

    protected $searchableFields = ['*'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function clears()
    {
        return $this->hasMany(Clear::class);
    }
}
