<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
 

class ChatMessage extends Model
{ 
    use HasFactory;

    protected $table = 'chat_messages';

    protected $fillable = ['id','chat_id','image_url','message','unseen_count','image_status','from_id','to_id'];  

    protected $append = ['from_details','to_details'];


    public function chat_messages(){
        return $this->belongsTo(Chat::class,'chat_id','id');
    }
     // Define the relationship with the User model for the 'from' user
     public function fromUser()
     {
         return $this->belongsTo(User::class, 'from_id');
     }
      
     // Define the relationship with the User model for the 'to' user
     public function toUser()
     {
         return $this->belongsTo(User::class, 'to_id');
     }
     public function getFromDetailsAttribute(){
        $user = new \Stdclass();
        $user->name = $this->fromUser->name;
        $user->profile_image = $this->fromUser->profile_picture;
        return $user;
     }


}
