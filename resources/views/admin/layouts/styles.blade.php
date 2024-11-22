    <link rel="stylesheet" href="{{ asset('taxi/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('taxi/assets/css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('taxi/assets/css/tail.select-default.css') }}">
    <link rel="stylesheet" href="{{ asset('taxi/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('taxi/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('taxi/assets/css/jquery.scrollbar.css') }}">
    <script src="{{ asset('taxi/assets/js/jquery.js') }}"></script>

    @yield('taxi-extra-css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,400&display=swap" rel="stylesheet">
    <style>
        .sidebar-submenu {
            display: none;
        }

        .side-bar-dropdown li {
            list-style-type: none;
        }

        ul.side-bar-dropdown li a {
            display: block;
            padding: 13px 0.5rem;
            position: relative;
            font-size: 13px;
            -webkit-transition: all .4s;
            transition: all .4s;
            text-decoration: none;
        }

        ul.side-bar-dropdown li a span,
        .sidebar-submenu ul li a,
        ul.side-bar-dropdown li span {
            color: #a6b0cf !important;
            font-size: 13px;
        }

        ul.side-bar-dropdown li:hover a span,
        .sidebar-submenu ul li:hover a,
        ul.side-bar-dropdown li:hover span,
        ul.side-bar-dropdown li:hover a i {
            color: #ffffff !important;
        }

        ul.side-bar-dropdown li a i {
            color: #6a7187 !important;
            font-size: 18px;
            margin-right: 10px;
        }

        .sidebar-submenu ul {
            padding-left: 30px;
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

        .mandatory {
            color: red;
        }
        th {
            text-transform: uppercase;
        }
        
        .profile-div .dropdown-menu{
            left:-50px;
        }
        .alert-div{
            position:fixed;
            background:rgba(0,0,0,0.5);
            top:0px;
            left:0px;
            width:100%;
            height:100vh;
            display:none;
           
        }
        .alert-div .col-md-3{
            background:#fff;
            margin-top:15%;   
            padding: 25px 10px; 
            display:table;  
            border-radius:5px;
        }
        .alert-div .col-md-3 p{
            font-size:25px;
            font-weight:500;
        }
        .alert-div .col-md-3 i{
            font-size:30px;
            color:orange;
        }
        .hover-blue {
            background-color: #bee3ca;
            color: white;
        }
        ul.side-bar-dropdown li.active a i,
        ul.side-bar-dropdown li.active a span,
        .sidebar-dropdown.active a span,
        .sidebar-submenu ul li.active a {
            color: #ffffff !important;
        }
    </style>