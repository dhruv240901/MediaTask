<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['name', 'email', 'phone', 'gender', 'profile_image', 'social_id', 'social_type', 'is_active', 'created_by', 'updated_by'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password'          => 'hashed',
    'is_active'         => 'boolean',
    'is_deleted'        => 'boolean',
  ];

  protected $keyType = 'string';
  protected $primaryKey = 'id';
  public $incrementing = false;

  public static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      $model->id = (string) Str::uuid();
      $model->created_by = auth()->id();
    });

    static::updating(function ($model) {
      $model->updated_by = auth()->id();
    });

  }

  /* add relationship between users and videos table through shared_videos pivot table */
  public function videos()
  {
    return $this->belongsToMany(Video::class,'shared_videos');
  }
}
