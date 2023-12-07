<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends BaseModel
{
    use HasFactory;

    protected $fillable=['name','file_url','file_name','slug','is_active','created_by','updated_by'];

    /* add relationship between users and videos table through shared_videos pivot table */
    public function users()
    {
      return $this->belongsToMany(User::class,'shared_videos');
    }
}
