

	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{!! asset('assets/vendor_components/bootstrap/dist/css/bootstrap.css') !!}">

	<!-- Select2 -->
	<link rel="stylesheet" href="{!! asset('assets/vendor_components/select2/dist/css/select2.min.css') !!}">

	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="{!! asset('assets/css/bootstrap-extend.css') !!}">

	<!-- theme style -->
	<link rel="stylesheet" href="{!! asset('assets/css/master_style.css') !!}">

	<!-- Fab Admin skins -->
	<link rel="stylesheet" href="{!! asset('assets/css/skins/_all-skins.css') !!}">

    <!-- Vector CSS -->
    <link href="{!! asset('assets/vendor_components/jvectormap/lib2/jquery-jvectormap-2.0.2.css') !!}" rel="stylesheet" />

	<!-- Morris charts -->
	<link rel="stylesheet" href="{!! asset('/assets/vendor_components/morris.js/morris.css') !!}">

    <!--alerts CSS -->
    <link href="{!! asset('assets/vendor_components/sweetalert/sweetalert.css') !!}" rel="stylesheet" type="text/css">
 	<!-- toast CSS -->
	<link href="{!! asset('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css') !!}" rel="stylesheet">
	 <link rel="stylesheet" href="{{ asset('taxi/assets/css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('taxi/assets/css/tail.select-default.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    {{-- mapbox link --}}
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">



	<style>
		.no-data{
			color:red;
			font-weight:bold
		}
		.img-circle{
			width: 50px;
			height: 50px;
			border-radius: 30px;
		}
		.skin-yellow .sidebar-menu .treeview-menu > li.active > a{
			color: #e9ab37;
		}
		.hover-blue {
			color: white;
			background: #2a3042;
			font-weight: bold;
		}
		 .sidebar-list {
            padding-left: 10px;
        }
        .tail-select {
            width: 100%;
        }

        .tail-select .select-dropdown ul li:hover {
            background-color: #f8f9fa !important;
        }

        .tail-select .select-dropdown ul li {
            color: #343a40;
            padding: 0.6rem 2.10rem;
            text-align: left;
            font-weight: normal;
        }
		.main-header .notifications-menu .dropdown-toggle i::after {
			content: "";
			position: absolute;
			top: 13px;
			right: 10px;
			display: inline-block;
			width: 10px;
			height: 10px;
			border-radius: 100%;
			border: 2px solid;
			background-color: #0B4DD8;
		}
		.main-header .notifications-menu .dropdown-toggle span::after {
			content: "";
			position: absolute;
			top: 10px;
			right: 10px;
			display: inline-block;
			width: 10px;
			height: 10px;
			border-radius: 100%;
			border: 2px solid #0B4DD8;
			background-color: #0B4DD8;
		}
		.main-header .notifications-menu .dropdown-toggle span.active::after {
			background-color: #fc4b6c;
		}
		.curser {
			cursor: pointer;
		}
        .sosicon {
            padding: 3px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: bolder;
			background: red;
			color: #fff;
        }

	</style>
	<style>
    .jq-toast-wrap {
        width: 350px;
        animation: heartbeat 2s 3s;
    }
    .jq-toast-wrap.top-right {
        top: 70px;
        right: 15px;
    }
    .jq-toast-single.jq-has-icon.jq-icon-error {
        font-weight: 900 !important;
        font-size: 15px !important;
        color: white;
    }

    @keyframes heartbeat
    {
    0%
    {
        transform: scale( .75 );
    }
    20%
    {
        transform: scale( 1 );
    }
    40%
    {
        transform: scale( .75 );
    }
    60%
    {
        transform: scale( 1 );
    }
    80%
    {
        transform: scale( .75 );
    }
    100%
    {
        transform: scale( .75 );
    }
    }
</style>
