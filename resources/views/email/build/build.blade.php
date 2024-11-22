@extends('email.layout')

@section('content')
    <div class="content">
        <div class="content-header content-header--blue">
            Mobile Builds
        </div>
        <div class="content-body">
            <p>Hi Team,</p>
            <p>I have uploaded the latest {{$build->team}} {{$build->flavour_name}} {{$build->environment}} build of the {{$build->project_name}} and You can download and install the application using below the download button.</p>

            <div class="text-center">
                <a href="{{$build->download_link}}" target="_blank" class="btn btn-default">
                    Download Build
                </a>
            </div>

            <div class="hr-line"></div>

            <p>The Build Details are</p>
            <ul>
            <p> Build Number: {{$build->build_number}}</p>
            <p> Build Version:{{$build->version}} </p>
            <p> Platform:{{$build->team}} </p>
            <p> Environment:{{$build->environment}} </p>
            <p> Uploaded By:{{$build->uploaded_by}} </p>
            <p> File size:{{$build->file_size}} </p>
            <p> Uploaded On:{{$build->created_at}} </p>
            <p> Description:{{$build->additional_comments}} </p>

        </ul>
    <div class="hr-line"></div>
    <ul>
        <p>Thanks&Regards</p>
        <p>{{$build->uploaded_by}}</p>
    </ul>

        </div>
    </div>
@endsection
