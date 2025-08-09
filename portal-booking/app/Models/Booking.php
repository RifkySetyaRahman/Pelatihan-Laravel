<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Booking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'booking';
    protected $fillable = [
        'user_id',
        'room_id',
        'title',
        'start_time',
        'end_time',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the room that is booked.
     */
    // app/Models/Booking.php
public function getRoomNameAttribute()
{
    $response = Http::get('http://room-service-nginx/rooms/' . $this->room_id);
    return $response->successful() ? $response->json()['name'] : 'Room not found';
}

}
// made by Rifky Setya Rahman
