<?php
namespace Carbon;
use Carbon\Carbon;
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;



class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(related:User::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function getCreatedAtShowAttribute($value)
    {
        return Carbon::parse($value)->format('1 jS\\of F Y h:i:s A');
    }
   public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}

