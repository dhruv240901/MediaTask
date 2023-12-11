<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    use HasFactory;

    protected $fillable=['name','video_id','user_id','created_by', 'updated_by'];

    /* add relationship between comments and users table */
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
