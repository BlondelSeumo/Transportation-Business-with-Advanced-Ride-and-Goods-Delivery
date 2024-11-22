@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('goods-types') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('goods-types/update',$item->id) }}">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="goods_type_name">@lang('view_pages.goods_type_name') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="name" name="goods_type_name"
                                                value="{{ old('goods_type_name',$item->goods_type_name) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.goods_type_name')">
                                            <span class="text-danger">{{ $errors->first('goods_type_name') }}</span>
                                        </div>
                                    </div>
                                      <div class="col-12">
                                        <div class="form-group">
                                            <label for="">@lang('view_pages.goods_types_for') <span
                                                    class="text-danger">*</span></label>
                                            <select name="goods_types_for" id="goods_types_for" class="form-control"
                                                    required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option
                                                    value="truck" {{ old('goods_types_for', $item->goods_types_for) == 'truck' ? 'selected' : '' }}>@lang('view_pages.truck')</option>
                                                    <option
                                                    value="motor_bike" {{ old('goods_types_for', $item->goods_types_for) == 'motor_bike' ? 'selected' : '' }}>@lang('view_pages.motor_bike')</option>

                                            </select>
                                            <span class="text-danger">{{ $errors->first('goods_types_for') }}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
                                            @lang('view_pages.update')
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
