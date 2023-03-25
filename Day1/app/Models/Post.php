<?php
namespace Carbon;
use Carbon\Carbon;
namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Conner\Tagging\Taggable;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;



class Post extends Model
{
    use Sluggable;
    use HasFactory;
    // use Taggable;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id',
        'image_path',
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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}

