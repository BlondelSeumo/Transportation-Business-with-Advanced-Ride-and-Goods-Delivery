<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
Driver Invoice
      </title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
    </script>
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js">
    </script>
</head>

<body>
<div id="divID">

<div style="margin: 0; padding: 0">
<table bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td bgcolor="#EEEEEE" style="padding: 20px 15px 0 15px">
<div align="center">
<table border="0" cellpadding="0" cellspacing="0" width="660">
<tbody>
<tr>
<td bgcolor="#ffffff"
style="padding: 24px 14px 0 14px; border-top-left-radius: 4px; border-top-right-radius: 4px">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td width="40%" align="left">
<table>
<tbody>
<tr>
<td
style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; color: #707070; font-weight: normal; line-height: 16px">
{{ now()->parse($data->completed_at)->setTimezone(env('SYSTEM_DEFAULT_TIMEZONE', 'Asia/Kolkata'))->format('M j,Y - h:i A') }}
<br />
</td>
</tr>
</tbody>
</table>
</td>
<td width="60%" align="right">
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td align="right" style="padding: 0 0 5px 0">
<a href="https://evoj.com/"
style="float: right" rel="noreferrer"
target="_blank">
<img width="76"
style="display: inline; float: none; text-align: center; width: 120px"
src="{{ invoice_logo() ??  asset('invoice/logo.jpeg') }}"
alt="" class="CToWUd" />
</a>
<br>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="color: #ffffff; line-height: 10px">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%" class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="center"
style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 40px; font-weight: bold; color: #000000">
<table>
<tbody>
<tr>
<td style="padding-left: 15px">
<table>
<tbody>
<tr>
<td
style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 40px; font-weight: bold; color: #000000; padding-right: 10px">
{{ $data->currency }}
{{ number_format($data->requestBill->driver_commision, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
<td style="padding-top: 10px; padding-left: 6px"></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="center"
style="padding-right: 20px; padding-left: 20px; padding-bottom: 2px; font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #777777">
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
<tbody>
<tr>
<td align="center" style="
padding-top: 10px;
background-image: url('Invoice_background.png');
background-position: center 100%;
background-repeat: no-repeat;
">
<span style="
background-color: #ffffff;
padding-top: 0px;
padding-left: 0px;
padding-right: 0px;
font-size: 14px;
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
color: #707070;
">
&nbsp;&nbsp;&nbsp;{{ $data->driver_invoice_no }}&nbsp;&nbsp;&nbsp;<br />
</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="center"
style="font-family: Helvetica, Helvetica Neue, Arial, sans-serif; font-size: 14px; word-spacing: -0.3px; color: #000000; padding-bottom: 0px; padding-top: 17px">
Thanks for driving with us, {{ $data->outstation_invoice ? $data->driver_name : $data->driverDetail->name }}
</td>
</tr>
<tr>
<td bgcolor="#ffffff" align="center"
style="padding-left: 16px; padding-right: 16px">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tbody>
<tr>
<td
style="border-bottom: 3px solid #ececec; width: 100%; text-align: center; color: #ffffff">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%" class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
<table bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td bgcolor="#EEEEEE" align="center" style="padding: 0 15px 0 15px">
<table border="0" cellpadding="0" cellspacing="0" width="660">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tbody>
<tr>
<td bgcolor="#ffffff" valign="top"
style="padding-top: 28px; padding-bottom: 0; padding-left: 0px; padding-right: 0px">
<table cellpadding="0" cellspacing="0" border="0" width="49.5%"
align="left">
<tbody>
<tr>
<td style="padding-left: 14px; padding-right: 14px">
<table cellpadding="0" cellspacing="0" border="0"
width="100%">
<tbody>
<tr>
<td align="center" style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #333333;
font-size: 16px;
padding-bottom: 16px;
font-weight: bold;
border-bottom: 1px solid #d7d7d7;
">
Trip Details
</td>
</tr>
<tr>
<td style="padding: 9px 0 0 0">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td valign="top"
style="border-bottom: 1px solid #eeeeee; padding-bottom: 10px; padding-left: 14px">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%"
style="width: 100%"
align="left">
<tbody>
<tr>
<!-- <td align="left"
style="width: 42px; padding-left: 2px"
width="42">
<img height="50"
style="height: 50px"
src="{{ asset('invoice/Invoice_driver_default.png') }}"
alt=""
class="CToWUd" />
</td> -->
<td align="left"
style="padding-left: 16px">
<table>
<tbody>
<tr>
<td
style="font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #000000; font-size: 16px; line-height: 18px">

For:
{{ $data->outstation_invoice ? $data->driver_name : $data->driverDetail->name }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 12px !important; font-size: 10px !important">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0 0 0 0">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td valign="top"
style="border-bottom: 1px solid #eeeeee; padding-bottom: 12px; padding-left: 14px; padding-top: 5px">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%"
style="width: 100%"
align="left">
<tbody>
<tr>
<td align="left"
style="width: 42px; padding-left: 2px"
width="42">
<img width="40"
style="width: 40px"
src="{{ asset('invoice/Invoice_dash_icon_2x.png') }}"
alt=""
class="CToWUd" />
</td>
<td align="left"
style="font-family: Helvetica, Helvetica Neue, Arial, sans-serif; color: #000000; font-size: 14px; padding-left: 16px; padding-top: 8px">
Total
Kms:
{{ number_format($data->total_distance, 2) }}
km
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 12px; font-size: 10px">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0 0 0 0">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td valign="top"
style="border-bottom: 1px solid #eeeeee; padding-bottom: 12px; padding-left: 14px; padding-top: 5px">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%"
style="width: 100%"
align="left">
<tbody>
<tr>
<td align="left"
style="width: 42px; padding-left: 2px"
width="42">
<img width="40"
style="width: 40px"
src="{{ asset('invoice/Invoice_time_icon_2x.png') }}"
alt=""
class="CToWUd" />
</td>
<td align="left"
style="font-family: Helvetica, Helvetica Neue, Arial, sans-serif; color: #000000; font-size: 14px; padding-left: 16px; padding-top: 8px">
Total
Mins:
{{ $data->total_time }}
min
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 12px; font-size: 10px">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 0 0 0 0">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td valign="top"
style="border-bottom: 1px solid #eeeeee; padding-bottom: 7px; padding-left: 14px; padding-top: 5px">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%"
style="width: 100%"
align="left">
<tbody>
<tr>
<td align="left"
style="width: 42px; padding-left: 2px"
width="42">
<img width="38"
style="width: 38px"
src="{{ $data->zoneType->vehicleType->icon ?? asset('invoice/Invoice_Micro_Icon.png') }}"
alt=""
class="CToWUd" />
</td>
<td align="left"
style="
padding-top: 4px;
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
padding-left: 16px;
line-height: 16px;
">
{{ $data->vehicle_type_name}} - {{$data->outstation_invoice ? strtoupper($data->vehicle_number) : strtoupper($data->driverDetail->vehicle_number)}}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>














<tr style="vertical-align: top; text-align: left; display: block; background-color: #ffffff; padding-bottom: 10px; padding-top: 5px"
align="left" bgcolor="#ffffff">
<td style="word-break: break-word; border-collapse: collapse !important; vertical-align: top; text-align: left; display: inline-block; padding: 10px 0 0 14px"
align="left" valign="top">
<table
style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: auto; padding: 0">
<tbody>
@if($data->requestStops->count() == 0)
<tr style="vertical-align: top; text-align: left; width: 100%; padding-top: 5px"
align="left">
<td style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 80px !important;
line-height: 16px;
height: auto;
padding: 0 0 0 0;
" align="left" valign="top">
<span
style="font-size: 14px; font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; font-weight: normal; color: #000000 !important">
<span> <a
style="text-decoration: none !important; color: #000000 !important"
rel="noreferrer">{{ now()->parse($data->trip_start_time)->setTimezone(env('SYSTEM_DEFAULT_TIMEZONE', 'Asia/Kolkata'))->format('h:i A') }}</a>
</span>
</span>
</td>
<td rowspan="2" style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 17px !important;
padding: 3px 2px 10px 2px;
" align="left" valign="top">
<img width="6"
height="84px"
src="{{ asset('invoice/Invoice_src_dest.png') }}"
style="outline: none; text-decoration: none; float: left; clear: both; display: block; width: 6px !important; height: 84px; padding-top: 5px"
align="left"
class="CToWUd" />
</td>
<td style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 197px;
line-height: 16px;
height: 57px;
padding: 0 10px 10px 0;
" align="left" valign="top">
<span style="
font-size: 14px;
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000 !important;
line-height: 16px;
text-decoration: none;
">
{{ $data->pick_address }}
</span>
</td>
</tr>
<tr style="vertical-align: top; text-align: left; width: 100%; padding: 0"
align="left">
<td style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 80px !important;
line-height: 16px;
height: auto;
padding: 0 0 0 0;
" align="left" valign="top">
<span
style="font-size: 14px; font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; font-weight: normal; color: #000000 !important">
<span>
<a style="text-decoration: none !important; color: #000000 !important"
rel="noreferrer">{{ now()->parse($data->completed_at)->setTimezone(env('SYSTEM_DEFAULT_TIMEZONE', 'Asia/Kolkata'))->format('h:i A') }}</a>
</span>
</span>
</td>
<td style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 197px;
line-height: 16px;
height: auto;
padding: 0 0px 0 0;
" align="left" valign="top">
<span style="
font-size: 14px;
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000 !important;
line-height: 16px;
text-decoration: none;
">
{{ $data->drop_address }}

</span>
</td>
</tr>
</tbody>
@else



<tr style="vertical-align: top; text-align: left; width: 100%; padding-top: 5px"
align="left">
<td style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 80px !important;
line-height: 16px;
height: auto;
padding: 0 0 0 0;
" align="left" valign="top">
<span
style="font-size: 14px; font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; font-weight: normal; color: #000000 !important">
<span> <a
style="text-decoration: none !important; color: #000000 !important"
rel="noreferrer">{{ now()->parse($data->trip_start_time)->setTimezone(env('SYSTEM_DEFAULT_TIMEZONE', 'Asia/Kolkata'))->format('h:i A') }}</a>
</span>
</span>
</td>
<td rowspan="1" style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 17px !important;
padding: 3px 2px 10px 2px;
" align="left" valign="top">
<img width="6"
height="84px"
src="{{ asset('invoice/Invoice_src_dest.png') }}"
style="outline: none; text-decoration: none; float: left; clear: both; display: block; width: 6px !important; height: 84px; padding-top: 5px"
align="left"
class="CToWUd" />
</td>
<td style="
word-break: break-word;
border-collapse: collapse !important;
vertical-align: top;
text-align: left;
display: table-cell;
width: 197px;
line-height: 16px;
height: 57px;
padding: 0 10px 10px 0;
" align="left" valign="top">

<span style="
font-size: 14px;
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000 !important;
line-height: 16px;
text-decoration: none;
">
{{ $data->pick_address }}
</span>
</td>
</tr>


@foreach($data->requestStops as $key => $stop)
<tr style="vertical-align: top; text-align: left; width: 100%; padding: 0" align="left">
    <td style="word-break: break-word; border-collapse: collapse !important; vertical-align: top; text-align: left; display: table-cell; width: 80px !important; line-height: 16px; height: auto; padding: 0 0 0 0;" align="left" valign="top">
        <span style="font-size: 14px; font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; font-weight: normal; color: #000000 !important">
            <span>
                <a style="text-decoration: none !important; color: #000000 !important" rel="noreferrer">{{ now()->parse($data->completed_at)->setTimezone(env('SYSTEM_DEFAULT_TIMEZONE', 'Asia/Kolkata'))->format('h:i A') }}</a>
            </span>
        </span>
    </td>
    <td style="word-break: break-word; border-collapse: collapse !important; vertical-align: top; text-align: left; display: table-cell; width: 17px !important; padding: 3px 2px 10px 2px;" align="left" valign="top">
        @if ($key < count($data->requestStops) - 1)
        <img width="6" height="84px" src="{{ asset('invoice/Invoice_src_dest.png') }}" style="outline: none; text-decoration: none; float: left; clear: both; display: block; width: 6px !important; height: 84px; padding-top: 5px" align="left" class="CToWUd" />
        @endif
    </td>
    <td style="word-break: break-word; border-collapse: collapse !important; vertical-align: top; text-align: left; display: table-cell; width: 197px; line-height: 16px; height: auto; padding: 0 0px 0 0;" align="left" valign="top">
        <span style="font-size: 14px; font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #000000 !important; line-height: 16px; text-decoration: none;">
            {{ $stop->address }}
        </span>
    </td>
</tr>
@endforeach










@endif
</table>
</td>
</tr>
</tbody>
</table>


</td>
</tr>
</tbody>
</table>


<table cellpadding="0" cellspacing="0" border="0" width="49.5%"
align="left">
<tbody>
<tr>
<td style="padding-right: 14px; padding-left: 14px">
<table cellpadding="0" cellspacing="0" border="0"
width="100%">
<tbody>
<tr>
<td align="center" style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #333333;
font-size: 16px;
padding-bottom: 16px;
font-weight: bold;
border-bottom: 1px solid #d7d7d7;
">
Bill Details
</td>
</tr>
<tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-left: 7px; padding-right: 13px; padding-top: 10px; padding-bottom: 2px">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="font-family: Arial, Helvetica, 'Helvetica Neue', sans-serif; color: #707070; font-size: 14px">
Total Distance Driven
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td
style="font-family: Arial, Helvetica, 'Helvetica Neue', sans-serif; color: #707070; font-size: 14px">
{{number_format($data->requestBill->total_distance,2) }} km
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>

















<tr>
    <td bgcolor="#ffffff">
    <table cellspacing="0"
    cellpadding="0" border="0"
    width="100%">
    <tbody>
    <tr>
    <td border="0"
    cellpadding="0"
    cellspacing="0"
    valign="top"
    style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px; background-color: #f3f3f3">
    <table
    cellpadding="0"
    cellspacing="0"
    border="0"
    width="70%"
    style="width: 70%"
    align="left">
    <tbody>
    <tr>
    <td
    style="padding: 0 0 0 0">
    <table
    cellpadding="0"
    cellspacing="0"
    border="0"
    width="100%">
    <tbody>
    <tr>
    <td
    align="left">
    <table>
    <tbody>
    <tr>
    <td align="left"
    style="
    font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
    color: #000000;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    ">
Ride Type
    <span
    style="font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #707070; font-size: 13px; font-weight: normal"></span>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    <table
    cellpadding="0"
    cellspacing="0"
    border="0"
    width="30%"
    style="width: 30%"
    align="right">
    <tbody>
    <tr>
    <td
    style="padding: 0 0 0 0">
    <table
    cellpadding="0"
    cellspacing="0"
    border="0"
    width="100%">
    <tbody>
    <tr>
    <td
    align="left">
    <table
    align="right">
    <tbody>
    <tr>
    <td style="
    font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
    color: #000000;
    font-size: 16px;
    font-weight: bold;
    line-height: 18px;
    ">
  @if($data->is_bid_ride == 1 && $data->goods_type_id == null && $data->is_out_station==0)
  Bidding Ride
  @endif
  @if( $data->is_out_station==1)
  Out Station
  @if($data->is_round_trip==1)
  (Round Way Trip)
  @else
  (One Way Trip)
  @endif
  @endif
  @if($data->is_bid_ride == 0 && $data->is_rental == 0 && $data->is_out_station==0 && $data->goods_type_id == null)
  Normal Ride
    @endif
    @if($data->is_bid_ride == 0 && $data->is_rental == 1 && $data->is_out_station==0 && $data->goods_type_id == null)
    Rental Ride ({{ $data->rentalPackage->name }})
      @endif
      @if($data->is_bid_ride == 0 && $data->is_rental == 0 && $data->is_out_station==1 && $data->goods_type_id == null)
      Rental Ride
        @endif
        @if($data->is_bid_ride == 1 && $data->is_rental == 0 && $data->is_out_station==0 && $data->goods_type_id != null)
        Delivery Ride
          @endif
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>






    @if($data->is_bid_ride == 1 && $data->is_rental == 0 && $data->is_out_station==0 && $data->goods_type_id != null)

    <tr>
        <td bgcolor="#ffffff">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tbody>
                    <tr>
                        <td border="0" cellpadding="0" cellspacing="0" valign="top" style="padding-left: 7px; padding-right: 13px; padding-bottom: 2px">
                            <table cellpadding="0" cellspacing="0" border="0" width="72%" style="width: 72%" align="left">
                                <tbody>
                                    <tr>
                                        <td style="padding: 0 0 0 0">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" style="
                                                            font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
                                                            color: #707070;
                                                            font-size: 14px;
                                                            font-weight: normal;
                                                            line-height: 18px;">
                                                            Goods Types:
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="padding: 0 0 0 0" width="28%" align="right">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td align="left">
                                            <table align="right">
                                                <tbody>
                                                    <tr>
                                                        <td style="
                                                            font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
                                                            color: #707070;
                                                            font-size: 14px;
                                                            font-weight: normal;
                                                            line-height: 18px;">
                                                            {{ $data->goodsTypeDetail->goods_type_name }} - {{$data->goods_type_quantity }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
                            <img style="width: 100%" src="{{ asset('invoice/Invoice_White_line.png') }}" class="CToWUd" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>

    @endif































<!-- User Price fare-->

<tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px;">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
User Paid Amount
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
{{ $data->currency }}
{{ number_format($data->RequestBill->total_amount, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>

<tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-left: 7px; padding-right: 13px; padding-bottom: 2px">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #707070;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
Cancellation
Fee
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #707070;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
{{ $data->currency }}
{{ $data->requestBill->cancellation_fee }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>


<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>


<!-- Driver Convenience Fee -->
<tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px;">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
Admin Fee
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
- {{ $data->currency }}
{{ number_format($data->requestBill->admin_commision, 2)+number_format($data->requestBill->admin_commision_from_driver, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>




<tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px;">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
Tax {{get_settings('service_tax')}} %
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
- {{ $data->currency }}
{{ number_format(($data->requestBill->service_tax), 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>



<!-- <tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px; background-color: #f3f3f3">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 16px;
font-weight: bold;
line-height: 18px;
">
Additional
Charges
<span
style="font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #707070; font-size: 13px; font-weight: normal">(rounded
off)</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 16px;
font-weight: bold;
line-height: 18px;
">
{{ $data->currency }}
{{ number_format($data->requestBill->additional_amount, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr> -->

<!-- <tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px; background-color: #f3f3f3">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 16px;
font-weight: bold;
line-height: 18px;
">
Total
Bill
<span
style="font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #707070; font-size: 13px; font-weight: normal">(rounded
off)</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 16px;
font-weight: bold;
line-height: 18px;
">
{{ $data->currency }}
{{ number_format($data->requestBill->total_amount, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr> -->

<tr>
<td bgcolor="#ffffff">
<table cellspacing="0"
cellpadding="0" border="0"
width="100%">
<tbody>
<tr>
<td border="0"
cellpadding="0"
cellspacing="0"
valign="top"
style="padding-top: 6px; padding-bottom: 6px; padding-left: 7px; padding-right: 13px; background-color: #b9efaf">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="72%"
style="width: 72%"
align="left">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table>
<tbody>
<tr>
<td align="left"
style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
Settlement Amount

<span
style="font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif; color: #707070; font-size: 13px; font-weight: normal">(rounded
off)</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table
cellpadding="0"
cellspacing="0"
border="0"
width="27%"
style="width: 27%"
align="right">
<tbody>
<tr>
<td
style="padding: 0 0 0 0">
<table
cellpadding="0"
cellspacing="0"
border="0"
width="100%">
<tbody>
<tr>
<td
align="left">
<table
align="right">
<tbody>
<tr>
<td style="
font-family: Helvetica, 'Helvetica Neue', Arial, sans-serif;
color: #000000;
font-size: 14px;
font-weight: normal;
line-height: 18px;
">
{{ $data->currency }}
{{ number_format($data->requestBill->driver_commision, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td
style="color: #ffffff; line-height: 8px !important; padding: 0 0 0 0; font-size: 13px">
<img style="width: 100%"
src="{{ asset('invoice/Invoice_White_line.png') }}"
class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td bgcolor="#eeeeee" align="center" style="padding: 0 15px 0 15px">
<table border="0" bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="660">
<tbody>
<tr>
<td bgcolor="#ffffff" align="center" style="padding-left: 15px; padding-right: 15px">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="center" style="
font-family: Arial, Helvetica, 'Helvetica Neue', sans-serif;
color: #000000;
font-size: 16px;
font-weight: bold;
padding-top: 10px;
padding-bottom: 10px;
border-bottom: 1px solid #eeeeee;
">
Payment
</td>
</tr>
<tr>
<td style="color: #ffffff; line-height: 14px">.</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" style="padding: 0 15px 0 15px">
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tbody>
<tr>
<td border="0" cellpadding="0" cellspacing="0" valign="top"
style="padding-bottom: 3px">
<table cellpadding="0" cellspacing="0" border="0" width="50%"
style="width: 50%" align="left">
<tbody>
<tr>
<td style="padding: 0 0 0 0">
<table cellpadding="0" cellspacing="0" border="0"
width="100%">
<tbody>
<tr>
<td align="left"
style="padding-left: 70px">
<table>
<tbody>
<tr>
<td width="30"
style="width: 30px">
<img style="float: none; display: inline; width: 20px"
width="20"
src="{{ asset('invoice/cash_international.png') }}"
alt=""
class="CToWUd" />
</td>
<td align="left"
style="padding-bottom: 5px; padding-left: 8px; font-family: Arial, Helvetica, 'Helvetica Neue', sans-serif; color: #707070; font-size: 14px">
@php
$payment = 'Cash';
@endphp
@if ($data->payment_opt == 1)
@php
$payment = 'Cash';
@endphp
@elseif($data->payment_opt
== 0)
@php
$payment = 'Card';
@endphp
@elseif($data->payment_opt
== 2)
@php
$payment = 'Card';
@endphp
@endif
Paid by
{{ $payment }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="27%"
style="width: 27%" align="right">
<tbody>
<tr>
<td style="padding: 0 0 0 0">
<table cellpadding="0" cellspacing="0" border="0"
width="100%">
<tbody>
<tr>
<td align="left"
style="font-family: Arial, Helvetica, 'Helvetica Neue', sans-serif; color: #707070; font-size: 14px; padding-bottom: 5px">
{{ $data->currency }}
{{ number_format($data->requestBill->total_amount, 2) }}
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="color: #ffffff; line-height: 10px">
<img src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%" class="CToWUd" />
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td bgcolor="#EEEEEE" align="center" style="padding: 0 15px 20px 15px">
<table border="0" cellpadding="0" cellspacing="0" width="660">
<tbody>
<tr>
<td
style="background-color: #ffffff; padding: 0 15px 0px 15px; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">
<table align="left" width="100%" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td align="left" style="
font-size: 13px;
font-family: Arial, Helvetica, 'Helvetica Neue', sans-serif;
color: #777777;
padding-top: 16px;
padding-bottom: 10px;
padding-left: 16px;
border-top: 1px solid #eeeeee;
text-align: center;
"><?php

$privacy = $links->privacy_policy_link;
$terms = $links->terms_and_conditions_link;
$email= $links->invoice_email;
?>
<a style="text-decoration: none; color: #5d93bb"
href="<?php echo $privacy; ?>" rel="noreferrer"
target="_blank">
Privacy Policy |</a>
<a style="text-decoration: none; color: #5d93bb"
href="<?php echo $terms; ?>" rel="noreferrer"
target="_blank">
Terms</a>
<a style="text-decoration: none; color: #000000"
href="<?php echo $email; ?>" rel="noreferrer"
target="_blank">

| Questions? Email us at {{$email}}
</a>
</td>

</tr>
<tr>
<td style="color: #ffffff; line-height: 9px"><img
src="{{ asset('invoice/Invoice_White_line.png') }}"
style="width: 100%" class="CToWUd" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<script>
    function autoPrint() {
        var opt = {
            margin: 0.5,
            filename: 'document.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(document.body).set(opt).save();
    }

    function redirectToPreviewPage() {
        // Get the item ID
        var itemId = "<?php echo $data->id; ?>";

        // Construct the URL for the preview page
        var previewUrl = "{{ url('requests') }}";

        // Redirect to the preview page after a delay
        setTimeout(function() {
            window.location.href = previewUrl;
        }, 3000); // Adjust the delay time as needed (in milliseconds)
    }

    // Call autoPrint() and redirectToPreviewPage() after the document is ready
    document.addEventListener("DOMContentLoaded", function() {
        autoPrint();
       redirectToPreviewPage();
    });
</script>


<button id="printBtn" style="display: none">Print and Save as PDF</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


</body>

</html>
