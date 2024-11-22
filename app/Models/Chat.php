<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Traits\HasActive;
use App\Base\Uuid\UuidModel; 

class Chat extends Model
{
    use HasFactory,HasActive,UuidModel;  
    
    protected $table = 'chat';

    protected $fillable = ['id','user_id'];  


    protected $appends = [];

    public function chat_messages(){
        return $this->hasMany(ChatMessage::class,'chat_id','id');
    }

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    } 


}
