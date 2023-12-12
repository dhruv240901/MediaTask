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

    /* add relationship between users and videos table */
    public function user()
    {
      return $this->belongsTo(User::class,'created_by');
    }

    /* add relationship between videos and comments table */
    public function comments()
    {
      return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }
}
