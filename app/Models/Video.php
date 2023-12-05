<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends BaseModel
{
    use HasFactory;

    protected $fillable=['name','file_url','file_name','slug','created_by','updated_by'];
}
