@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')
<style type="text/css">
/* CSS for toggle switch */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}    
/**
 * Tooltip Styles
 */

/* Add this attribute to the element that needs a tooltip */
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box p-5">
   

<div class="g-col-12 g-col-lg-4">
    <div class="tab-content mt-5">
<form method="post" action="{{ url('system/settings/module_store') }}" enctype="multipart/form-data">
@csrf 

<table class="table">
    <thead>
        <tr style="padding: 10px;">
            <th>No</th>
            <th>Module</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr style="padding: 10px;">
            <td>1</td>
            <td>Enable digital signature</td>
            <td>
                <label class="switch">
                    <input type="hidden" name="enable_digital_signature" value="0">
                    <input type="checkbox" class="online-toggle" name="enable_digital_signature" value="1">
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
        <!-- Add other rows here -->
        <tr>
            <td>2</td>
            <td>Enable Owner Module</td>
            <td>
                <label class="switch">
                    <input type="hidden" name="enable_owner_module" value="0">
                    <input type="checkbox" class="online-toggle" name="enable_owner_module" value="1">
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
  
    </tbody>
</table>


              
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-primary w-32">Save</button>
            </div>
        </div>
    </div>
  </form>
 </div>
</div>
@endsection

