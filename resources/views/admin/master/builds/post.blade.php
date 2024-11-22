@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')

<!-- Start Page content -->
<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">
    <div class="box">

        <div class="mb-3">
<form  method="post" class="form-horizontal" action="{{url('builds/store')}}" enctype="multipart/form-data">
{{csrf_field()}}
<div class="row">
    <div class="col-sm-6">
<div class="form-group">
        <div class="col-12">
    <label for="admin_id">@lang('view_pages.select_team')
        <span class="text-danger">*</span>
    </label>
    <select name="team" id="team" class="form-control">
        <option value="" selected disabled>@lang('view_pages.select_team')</option>
        <option value="android">Android</option>
        <option value="ios">IOS</option>
    </select>
</div>
    </div>
</div>
    <div class="col-sm-6">
<div class="form-group">
        <div class="col-12">
    <label for="admin_id">@lang('view_pages.select_project')
        <span class="text-danger">*</span>
    </label>
    <select name="project_id" id="project_id" class="form-control">
        <option value="" selected disabled>@lang('view_pages.select_project')</option>
        @foreach($projects as $key=>$project)
        <option value="{{$project->id}}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{$project->project_name}}</option>
        @endforeach
    </select>
</div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-sm-6">
            <div class="form-group">
                <div class="col-12">
                    <label for="admin_id">@lang('view_pages.select_flavour')<span class="text-danger">*</span></label>
                    <select name="flavour_id" id="flavour_id" class="form-control">
                        <option value="" selected disabled>@lang('view_pages.select_flavour')</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
   <div class="form-group">
     <div class="col-12">
    <label for="admin_id">@lang('view_pages.select_environment')
        <span class="text-danger">*</span>
    </label>
    <select name="environment" id="environment" class="form-control">
        <option value="" selected disabled>@lang('view_pages.select_environment')</option>
        <option value="stage">@lang('view_pages.stage')</option>
        <option value="prod">@lang('view_pages.production')</option>
    </select>
</div>
</div>
</div>
</div>

<div class="row">
     <div class="col-sm-6">
   <div class="form-group">
        <div class="col-12">
            <label for="name">@lang('view_pages.version')</label>
            <input class="form-control" type="text" id="version" name="version" value="{{old('version')}}" required="" placeholder="@lang('view_pages.enter_version')">
            <span class="text-danger">{{ $errors->first('version') }}</span>
        </div>
    </div>
</div>
    <div class="col-sm-6">
     <div class="form-group">
        <div class="col-12">
            <label for="build">@lang('view_pages.build')</label>
            <input class="form-control" type="file" id="build" name="build" value="" required="" placeholder="@lang('view_pages.upload_build')">
            <span class="text-danger">{{ $errors->first('build') }}</span>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-sm-6">
   <div class="form-group">
        <div class="col-12">
            <label for="name">@lang('view_pages.additional_comments')</label>
            <textarea class="form-control" type="text" id="additional_comments" name="additional_comments" value="{{old('additional_comments')}}"></textarea>
            <span class="text-danger">{{ $errors->first('additional_comments') }}</span>

        </div>
    </div>
</div>

</div>

    <div class="form-group">
        <div class="col-12">
            <button class="btn btn-primary pull-right" type="submit">
                @lang('view_pages.save')
            </button>
        </div>
    </div>

</form>

            </div>
        </div>


    </div>
</div>
</div>

</div>
<!-- container -->

</div>
<!-- content -->

<script>
    $('#project_id').change(function(){
        let id = $(this).val();
        let option = '';

        $.ajax({
            url:"{{ route('fetchFlavour') }}",
            method:"GET",
            data:{id:id},
            success:function(result){
                $('#flavour_id').empty();

                if(result.length > 0){
                    result.forEach(element => {
                        option += '<option value='+element.id+'>'+element.flavour_name+'</option>';
                    });
                }else{
                    option += '<option value="">No Flavour</option>';
                }

                $('#flavour_id').append(option);
            }
        });
    });
</script>
@endsection

