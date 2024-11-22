@extends('admin.layouts.app')

@section('title', 'chat') 
<style>
   
.chat-user-info-content {
    padding-inline-start: 20px;
}
 
.chat-user-info-img img {
    width: 55px;
}
.chat-user-info-img img {
    width: 45px;
    aspect-ratio: 1;
    border-radius: 50%;
}

  
.chat-user-info-img img {
    width: 55px;
}
.chat-user-info-img img {
    width: 45px;
    aspect-ratio: 1;
    border-radius: 50%;
}
.chat-user-info-img img {
    width: 45px;
    aspect-ratio: 1;
    border-radius: 50%;
}
.avatar-img {
    display: block;
    max-width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
    pointer-events: none;
    border-radius: 0.3125rem;
}
img {
    vertical-align: middle;
    border-style: none;
}
.w-100 {
    width: 100% !important;
}
.align-items-center {
    -ms-flex-align: center !important;
    -webkit-box-align: center !important;
    align-items: center !important;
}
    .items.ts-input.required.full.has-items {
    padding: 14px;
}
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 35%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: none;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{  border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button { 
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 3px 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat ,.mesgs.card{ height: 680px; }
.mesgs.card{ height: 755px; }

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 10px 10px 10px 12px;
  width: 100%;
  font-weight: bold;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 0px 15px 0 0px;
  width: 60%;
}

 .sent_msg p {
  background: #2d3748 none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 12px;
  margin: 0; color:#fff;
  padding: 10px 10px 10px 12px;
  width:100%;
  font-weight: bold;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {   
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px; 
}
.input-group .input-group-text ,.form-control{
    box-shadow: none !important;
    background: none;
    border: none;
}
.card-header.border-0{
    border:none;
    border-radius:3px;
}
input#serach,.headind_srch,.card {
    border: none !important;
} 
input#serach:focus,input.write_msg:focus {
  background: none !important;
  border: none !important;
}
body {
  font-family: 'Roboto', sans-serif !important;
}
.card.inbox_people{
    margin-right: 10px;
}
.mesgs.card{
    border-radius:3px;
}
 
.card-header.profile {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    -ms-flex-direction: row;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    flex-direction: row;
    -ms-flex-align: center;
    -webkit-box-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    -webkit-box-pack: justify;
    justify-content: space-between;
    padding-top: 1rem;
    padding-bottom: 1rem;
}
.card .card-header h5 {
    font-size: 16px;
    font-weight: 600;
}
.text-capitalize {
    text-transform: capitalize !important;
}
.mb-0, .my-0 {
    margin-bottom: 0 !important;
}
.chat-user-info-content {
    width: calc(100% - 55px);
    flex-grow: 1;
}
.incoming_msg_data{
    margin: 0;
    padding: 0;
    overflow: hidden;
    overflow-y: scroll;
    height: 535px;
    padding-left: 20px;
  /* Hide scrollbar while still allowing scrolling */
  scrollbar-width: thin; /* For Firefox */
  scrollbar-color: transparent transparent; /* For Firefox */ 
 
}
.incoming_msg_data::-webkit-scrollbar,.inbox_chat::-webkit-scrollbar{ 
    width: 6px;
}
.incoming_msg_data::-webkit-scrollbar-thumb,.inbox_chat::-webkit-scrollbar-thumb{
    background-color: transparent;
}
 
.inbox_chat{
    margin: 0;
    padding: 0;
    overflow: hidden;
    overflow-y: scroll;
    height: 755px;
    padding-left: 20px;
  /* Hide scrollbar while still allowing scrolling */
  scrollbar-width: thin; /* For Firefox */
  scrollbar-color: transparent transparent; /* For Firefox */ 
 
}
 
.emojionearea .emojionearea-editor {
    min-height: 0;
    max-height: unset;
    height: 118px;
}
.emojionearea .emojionearea-editor {
    display: block;
    height: auto;
    min-height: 7.5em;
    max-height: 15em;
    overflow: auto;
    padding: 6px 24px 6px 12px;
    line-height: 1.42857143;
    font-size: inherit;
    color: #555;
    background-color: transparent;
    border: 0;
    cursor: text;
    margin-right: 1px;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.emojionearea, .emojionearea.form-control {
    display: block;
    position: relative !important;
    width: 100%;
    height: auto;
    padding: 0;
    font-size: 14px;
    background-color: #fff;
    border: 1px solid #ccc;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-transition: border-color 0.15s ease-in-out, -moz-box-shadow 0.15s ease-in-out;
    -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
 
.quill-custom_ {
    position: relative;
    height: 100px;
    border-radius: 5px;
    /* border: 1px solid #e5e5e5; */
    margin-top: 10px;
    margin-left:10px;
}
.emojionearea .emojionearea-button > div {
    display: block;
    width: 24px;
    height: 24px;
    position: absolute;
    -moz-transition: all 0.4s ease-in-out;
    -o-transition: all 0.4s ease-in-out;
    -webkit-transition: all 0.4s ease-in-out;
    transition: all 0.4s ease-in-out;
}

.conv-reply-form .quill-custom_ {
    position: relative;
}
.con-reply-btn {
    position: absolute;
    bottom: 20px;
    inset-inline-end: 15px;
}   
.btn--primary {
    background: var(--title-clr);
    border-color: var(--title-clr)!important;
}
button[class*=btn--] {
    padding: 12px 24px;
}
.upload-btn-grp{
    position: absolute;
    right: 100px;
    top: 30px;
}
textarea:focus{
    border:1px solid grey !important;
}
.chat_list{
    cursor:pointer;
}
.upload__img-box {
    width: 43px;
    border-radius: 5px;
    margin-bottom: 12px;
}
.img-bg {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
    padding-bottom: 100%;
    border-radius:5px;
}
.upload__img-close {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background-color: rgba(0,0,0,.5);
    position: absolute;
    top: -6px;
    right: -6px;
    font-size: 11px;
    line-height: 14px;
    text-align: center;
    z-index: 1;
    cursor: pointer;
}
.upload__img-close:after {
    content: "✖";
    color: #fff;
}
.upload__img-wrap {
    position: absolute;
    bottom: -10px;
    left: 14px;
    display: flex;
    gap: 10px;
}
#images_icon{
  cursor:pointer;
}

    </style>
    <script>

      function get_notification_count(chat_id = null,active_chat)
      {  
        if(chat_id != null)
          {
            // var data = {chat_id:chat_id};
            $.ajax({
                    url: 'chat/get-notication-count?chat_id='+chat_id+'&active_chat='+active_chat+'', // Replace with your API endpoint
                    method: 'GET',
                    dataType: 'json', 
                    // data:data, 
                    success: function(response) {  
                    if(response.first_chat == 1)
                    {
                        window.location.reload();
                    }
                    else{ 
                    $(".inbox_chat").html(response.html_data)
                    }
                   
                    },
                    error: function(error) {
                    // Handle errors
                    console.log('Error:', error);
                    }
            });
          }
      }
      function update_notification_count(chat_id = null)
      {
        if(chat_id != null)
          {
            var data = {chat_id:chat_id,user_id:'{{Auth::user()->id}}'};
            $.ajax({
                    url: 'chat/update-notication-count', // Replace with your API endpoint
                    method: 'GET',
                    dataType: 'json', 
                    data:data, 
                    success: function(response) {    
                      $(".inbox_chat").html(response.html_data)
                    },
                    error: function(error) {
                      // Handle errors
                      console.log('Error:', error);
                    }
            });
          }
      }
      function chatmessage_get(chat_id = null)
      {
        if(chat_id != null)
        {
            var data = {chat_id:chat_id};
            $.ajax({
                    url: 'chat/get-chat-messages?chat_id='+chat_id+'', 
                    method: 'GET',
                    dataType: 'html',  
                    success: function(response) {  
                    $(".mesgs.card").html(response).promise().done(function(){
                    // Get the last message element
                    var lastMessage = document.getElementById('last_message');  
                    // Scroll the last message into view
                    lastMessage.scrollIntoView({ behavior: 'smooth', block: 'end' }); 
                    }); 
                    },
                    error: function(error) {
                    // Handle errors
                    console.log('Error:', error);
                    }
            });
        } 
      }
      </script>
@section('content')
<section class="content">
<br> 
<div>   
<h4 style="  padding: 15px 15px 20px 0px; font-weight: 500;   font-size: 22px; color: black;">Conversation List</h4>
@if(count($user_details) > 0)
<div class="messaging">
      <div class="inbox_msg">
        <div class="card inbox_people">
     <!--      <div class="headind_srch">
            <div class="recent_heading"> 
            </div>
            <div class="card-header border-0">
              <div class="input-group input---group">
              <div class="input-group-prepend border-inline-end-0">
              <span class="input-group-text border-inline-end-0" id="basic-addon1"><i class="fa-solid fa-magnifying-glass" style="color: #c3bcbc;  padding-top: 4px;"></i></span>
              </div>
              <input type="text" class="form-control border-inline-start-0 pl-1" id="serach" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1" autocomplete="off">
              </div>
              </div>
          </div> -->
          <div class="inbox_chat">
            
            @foreach($user_details as $key=>$value)
              
          <?php
            $user_datas = DB::table('users')->join('role_user','role_user.user_id','users.id')->join('roles','roles.id','role_user.role_id')->where('users.id',$value->user_id)->select('roles.slug')->first(); 
            
            $startDate = strtotime($value->created_date); 
            $current_date = time(); 
            $secs = $current_date - $startDate; 
            $days = $secs / 86400; 
            $minutes = $secs/60;  
            $hours = $secs / 3600;  
            if($days >= 1)
            {
                $time = intval($days)." days ago";
                if(intval($days) <= 1)
                {
                    $time = intval($days)." day ago";
                } 
            }
            else{
              if($hours >= 1){
                $time = intval($hours)." hours ago";
                if(intval($hours) <= 1)
                {
                    $time = intval($hours)." hour ago";
                } 
                
              }
              else{
                if($minutes >= 1){
                    $time = intval($minutes)." Minutes ago";
                    if(intval($minutes) <= 1)
                {
                    $time = intval($minutes)." Minute ago";
                } 
                
              }
              else{
                $time = "Just Now";
              }
              }
            } 
            ?>
            @if($key == 0)
            <?php $chat_id = $value->id;
            DB::table('chat_messages')->where('chat_id',$value->id)->where('to_id',$value->user_id)->update(['unseen_count'=>1]);
            ?>
            <div class="chat_list active_chat" data-val="{{$value->id}}">
            @else
            <div class="chat_list" data-val="{{$value->id}}">
            @endif
            
              <div class="chat_people chat-user-info-img">
                <div class="chat_img"> <img src="{{$value->user_detail->profile_picture ?? asset('/assets/img/user-dummy.svg') }}" style="width: 50px; aspect-ratio: 1; border-radius: 50%;"  alt=""> </div>
                <div class="chat_ib">
                 
                  <h5>{{$value->user_detail->name}}
                    @if($user_datas->slug =="user")
                    <span class="label label-success" style="float: none; margin-left: 8px; /* margin-top: -15px; */">User</span>
                    @endif
                    @if($user_datas->slug =="owner")
                   <span class="label label-green" style="float: none;margin-left: 8px;/* margin-top: -15px; */background-color: green;">owner</span>
                    @endif
                    @if($user_datas->slug =="driver")
                    <span class="label label-yellow" style="float: none;margin-left: 8px;/* margin-top: -15px; */background-color: yellow;color: black;">driver</span>
                    @endif 
                    <span class="chat_date"> {{$time}} </span></h5>
                  <p>{{$value->message}}
                  <?php
            $unseen_count = DB::table('chat_messages')->where('chat_id',$value->id)->where('to_id',Auth::user()->id)->where('unseen_count',0)->count();
                  ?> 
                  @if($unseen_count > 0 && $key != 0)
                
                  <span class="notication-count {{$value->id}}" style=" float: right; background-color: red; padding: 4px;  font-size: 9px; color: white; font-weight: bold;
                  border-radius: 100%;  position: relative; top: -2px;">{{Auth::user()->id}}</span>
                  @endif 
                  </p> 
                </div>
              </div>
            </div> 
            @endforeach 
         
          </div>
          
        </div>
        <div class="mesgs card">
      <script>
        

        chatmessage_get('{{$chat_id}}');
      </script>
      </div>
      
      
    </div></div>
    @else
    <div>
    <p id="no_data" class="lead no-data text-center">
                                            <img src="{{ asset('assets/img/dark-data.svg') }}"
                                                style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                                        <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                                        </p>
          </div>
    @endif 
 
<script>
   
var existingFiles = [];
let initialLoad;
 
const messagesRef = database.ref('chats/');  


    // Function to display messages in the chat
function displayMessages(messageData) 
{     
    if(messageData != null)
    {

              var active_chat = $(".chat_list.active_chat").attr("data-val"); 
    get_notification_count(messageData.chat_id,active_chat);
    var user_id = '{{Auth::user()->id}}';
    if(messageData.chat_id == $(".chat_list.active_chat").attr("data-val") && user_id != messageData.from_id)
    {   
      if(messageData.message !== null && messageData.message !== "" && messageData.message !== undefined)
      {
          $('#last_message').removeAttr('id');
          $(".incoming_msg_data").append('<div class="incoming_msg" id="last_message"> <div class="incoming_msg_img"> <img src="{{Auth::user()->profile_picture}}"> </div><div class="received_msg">  <div class="received_withd_msg"><p>'+messageData.message+'</p><span class="time_date"> Just Now</span></div> </div> </div>').promise().done(function(){
          var lastMessage = document.getElementById('last_message');  
          // Scroll the last message into view
          lastMessage.scrollIntoView({ behavior: 'smooth', block: 'end' });  
          });
      }   
    } 
    }
  
}
 
    let initialLoad_dt1 = true;
    let  chat_flag = false;
    setTimeout(function() {
        chat_flag = true;
    }, 2000 );
   messagesRef.on('value', (snapshot) => { 
    if(chat_flag) {

    var datas = snapshot.val(); 
     var objectSize = Object.keys(datas).length;
     var chat_count = '{{count($chat_ids)}}'; 
     if(chat_count < objectSize) 
     {
           snapshot.forEach(function(childSnapshot) {
      var child_data = childSnapshot.val();  
      if(child_data.hasOwnProperty('new_chat'))
      { 
          if(child_data.new_chat == 1)
          {
            displayMessages(child_data); 
          } 
          } 
        });
     }    
    }



});
           

  
  let $i;
let $count;
initialLoad_dt = true;
<?php
if(count($chat_ids) > 0)
{
    
 foreach($chat_ids as $k=>$v)
 {  
?>  

database.ref('chats/{{$v}}').on('value', (snapshot) => {
    
            $i = '{{$k}}';
            $count = '{{count($chat_ids)-1}}'; 
          if(!initialLoad_dt)
          {  
            const data = snapshot.val();   
           displayMessages(data); 
           }
              if ($i == $count) {  
              initialLoad_dt = false;
              return;
          }  
        });  
<?php 

 }   
}

?>


$(document).on("click",".chat_list",function(e){
    var data_val = $(this).attr("data-val"); 
    $(".chat_list").removeClass("active_chat");
    $(this).addClass("active_chat"); 
    chatmessage_get(data_val); 
    // update_notification_count(data_val);  
    $("span.notication-count."+data_val+"").remove(); 
})
$(document).on("click",".con-reply-btn",function(e){
      e.preventDefault();    
      var formData = new FormData($("#SendMsg")[0]);
      var data_text = $(".emojionearea-editor").text();
      formData.append("data_text",data_text); 
      // document.getElementById('msg').value = data_text; 
      $("#message").val(data_text); 
      $(".upload__img-wrap").html('');
      $(".emojionearea-editor").html('');
      // var fileInput = document.getElementById('upload_input_images'); 
        // if(fileInput.files.length > 0)
      // {

      //   image_status = 1;
      // }  
      // existingFiles.forEach(function(file) {
      //               formData.append('files[]', file);
      //           });
      image_status = 0;
      var image_url = null;

      if(data_text !== "" && data_text !== null && data_text !== undefined)
      {
            $.ajax({
                    url: 'chat/send_message', // Replace with your API endpoint
                    method: 'POST',
                    dataType: 'json', // Expected data type,
                    data:formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle the successful response    
                        if(response.status == "success")
                        {   
                          messagesRef.child(response.data.chat_id).set({
                                  message: response.data.message,  
                                  chat_id: response.data.chat_id, 
                                  from_id: response.data.from_id,  
                                  to_id: response.data.to_id,  
                                  count: response.count,
                                  new_chat: 0, 
                                  user_timezone: response.data.user_timezone
                                }); 
                           
                            if(response.data.message !== null && response.data.message !== "")
                            {
                                $('#last_message').removeAttr('id');
                                var html_data = '<div class="outgoing_msg" id="last_message"><div class="sent_msg"><p>'+data_text+'</p> <span class="time_date"> Just Now</span> </div>  </div>';
                                $(".incoming_msg_data").append(html_data).promise().done(function(){
                                      var lastMessage = document.getElementById('last_message');   
                                      lastMessage.scrollIntoView({ behavior: 'smooth', block: 'end' }); 
                                }); 
                            } 
                        }  
                    },
                    error: function(error) {
                      // Handle errors
                      console.log('Error:', error);
                    }
            });
      }

  
});  
function handleFileUpload() 
{
      var fileInput = document.getElementById('upload_input_images');   
      var newFiles = Array.from(fileInput.files);
      for (var i = 0; i < fileInput.files.length; i++) 
      { 
            var file = fileInput.files[i]; 
            var fileExists = existingFiles.some(function(selct_file) { 
                        if(selct_file.name === file.name && selct_file.size === file.size){
                          newFiles.splice(i,1);
                          return true;
                        }
                        return false;
                    });
            if(!fileExists) 
            if (file) {
                  var url = URL.createObjectURL(file); 
                  imageUrlToBase64(url, file.name,function (dataUrl,file_name) {  
                        $(".upload__img-wrap").append( '<div class="upload__img-box"><div data-number="0" data-file="'+file_name+'" style="background-image: url('+dataUrl+') "class="img-bg"><div class="upload__img-close"></div></div></div>');   
                    }); 
            }  
      } 
      var allFiles = existingFiles.concat(Array.from(newFiles));
      existingFiles = allFiles;
} 

async function imageUrlToBase64(url,file_name, callback) {
      var img = new Image();
      img.crossOrigin = "Anonymous"; // Enable CORS
      img.onload = function () {
          var canvas = document.createElement('canvas');
          var ctx = canvas.getContext('2d');
          canvas.width = img.width;
          canvas.height = img.height;
          ctx.drawImage(img, 0, 0);
          var dataURL = canvas.toDataURL('image/png');
          callback(dataURL,file_name);
      };
      img.src = url;
}
 

  $(document).on("click",".upload__img-close",function(){ 
      var data_val = $(this).closest(".upload__img-box").find(".img-bg").attr("data-file"); 
      $(this).closest(".upload__img-box").remove();
      var fileInput = document.getElementById('upload_input_images');   
      var newFileList = [];
      for (var i = 0; i < existingFiles.length; i++) {
          var file = existingFiles[i];   
          if (file) { 
              if(file.name !== data_val)
              { 
                newFileList.push((file)); 
              } 
          } 
      }   
    existingFiles = newFileList;  
});
</script>
@endsection
