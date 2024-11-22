@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')
<style type="text/css">
    .btn-link:hover, .btn-link:focus {
        color:#007bff;
    }
</style>
<!-- Start Page content -->
<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">
    <div class="box">
        <div class="box-header with-border">

            <a href="{{ url('roles') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

        <div class="mb-3">
<form  method="post" class="form-horizontal" action="{{url('roles/assign/permissions/update',$role->id)}}">
{{csrf_field()}}
    <div class="form-group m-b-25 mt-10">
        <div class="col-6">
            <label for="name">@lang('view_pages.name')</label>
            <input class="form-control" type="text" id="name" name="name" value="{{old('name',$role->name)}}" required="" placeholder="@lang('view_pages.enter_role')" disabled>
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
    </div>


<div class="accordion" id="accordionExample">
@foreach($permissions as $key=>$result)
  <div class="card">
    <div class="card-header" id="heading_{{$key}}">
      <h5 class="mb-0">
      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_{{$key}}" aria-expanded="false" aria-controls="collapse_{{$key}}">
          {{$key}}
        </button>
      </h5>
    </div>

    <div id="collapse_{{$key}}" class="collapse" aria-labelledby="heading_{{$key}}" data-parent="#accordionExample">
      <div class="card-body">
        @foreach($result as $sub_key=>$permission)
            @php $checked='' @endphp
            @foreach($role->permissions as $key => $role_permission)
                 @if($permission->id == $role_permission->id)
                    @php $checked = 'checked' @endphp
                    @break
                @else
                    @php $checked = '' @endphp
                @endif
            @endforeach
            <input class="form-group" id="checkbox_{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$permission->id}}" {{ $checked }}>
            <label for="checkbox_{{$permission->id}}">
                {{$permission->name}}
            </label> <br>

        @endforeach
      </div>
    </div>
  </div>
    @endforeach
</div>

    <div class="form-group">
        <div class="col-6">
            <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light" type="submit">
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


@endsection


