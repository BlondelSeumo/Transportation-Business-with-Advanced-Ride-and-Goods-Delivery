@extends('email.layout')

@section('content')
    <div class="content">
        <div class="content-body">
            {!! $mail_template !!}
         </div>
     </div>
@endsection