<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $table = 'customer';
    protected $fillable = [
        'id', 'name', 'email', 'address', 'phone', 'note', 'created_at', 'updated_at', 'status', 'google_id', 'password', 'facebook_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.1';
    }
}
