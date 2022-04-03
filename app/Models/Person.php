<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = [
        'father_id',
        'mother_id',
        'name',
        'gender'
    ];

    public function father()
    {
        return $this->belongsTo(Person::class,'father_id');
    }
    public function mother()
    {
        return $this->belongsTo(Person::class,'mother_id');
    }
    public function children()
    {
        return $this->hasMany(Person::class);
    }
    public function husband()
    {
        return $this->belongsToMany(Person::class,'spouses','wife','husband');
    }
    public function wife()
    {
        return $this->belongsToMany(Person::class,'spouses','husband','wife');
    }
}
