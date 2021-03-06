<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'body','user_id','ticket_id','comment_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
