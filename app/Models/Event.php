<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function organizer()
    {
        return $this->hasOne(Organizer::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    protected $fillable = [
        'title',
        'description',
        'accepted',
        'automatique',
        'location',
        'total_Tickets',
        'available_Tickets',
        'event_date',
        'category_id',
        'organizer_id',
    ];
   
}
