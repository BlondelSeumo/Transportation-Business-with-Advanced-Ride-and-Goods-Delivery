@extends('admin.layouts.app')

@section('content')

<br>

<div class="row p-0 m-0">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">@lang('view_pages.drivers_privileged_fleet')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('company/drivers') }}">@lang('view_pages.manage_driver')</a>
                    </li>
                    <li class="breadcrumb-item active"> @lang('view_pages.drivers_privileged_fleet') </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ url('company/drivers/store/vehicle/privileges',$driver->id) }}">
                    @csrf
                    <div class="row">

                        <div class="col-sm-12 float-left mb-md-3">
                            <div class="form-group">
                                <label for="area">{{ trans('view_pages.fleets')}} <span class="mandatory">*</span></label>
                                <select data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100" data-select2-id="1" tabindex="-1" aria-hidden="true" name="fleets[]" id="fleets" title="@lang('view_pages.select_fleet')" multiple required>
                                    @php
                                        $selected = '';
                                        $oldValue = old('fleets');
                                        $selectedValue = $driver->privilegedVehicle;
                                    @endphp
                                    @foreach ($fleets as $key => $value)
                                        @if ($oldValue || !$selectedValue->isEmpty())
                                            @if ($oldValue)
                                                @foreach ($oldValue as $oldItem)
                                                    @if ($value->id == $oldItem)
                                                        @php
                                                            $selected = 'selected';
                                                        @endphp
                                                        @break
                                                    @else
                                                        @php
                                                            $selected = ''
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @elseif($selectedValue)
                                                @foreach ($selectedValue as $privilegedVehicle)
                                                    @if ($privilegedVehicle->fleet_id == $value->id)
                                                        @php
                                                            $selected = 'selected';
                                                        @endphp
                                                        @break
                                                    @else
                                                        @php
                                                            $selected = '';
                                                        @endphp
                                                    @endif
                                                @endforeach                                            
                                            @endif
                                        @endif
                                        <option value="{{ $value->id }}" {{ $selected }}>{{ $value->fleet_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if (!$driver->privilegedVehicle->isEmpty())
                            <div class="col-12">
                                <h4>@lang('view_pages.privileged_vehicles')</h4><br>
                                <ul>
                                    @foreach ($driver->privilegedVehicle as $item)
                                        <li> {{ $item->fleet->fleet_name }}  <a href="{{ url('company/drivers/unlink/fleet',[$item->driver_id,$item->id]) }}"><button class="btn-sm btn btn-danger" type="button">@lang('view_pages.unlink')</button></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-12 btn-group mt-3">
                            <ul class="admin-add-btn">
                               
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">{{ trans('view_pages.add') }}</button>
                               
                            </ul>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection

