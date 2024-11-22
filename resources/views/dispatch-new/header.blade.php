<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assetsweb/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsweb/fonts/flaticon/font/flaticon.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">	 -->

<style>
.hide-mobile {
  display: none;
}

a {
  text-decoration: none;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

header {
  background-color: #dbe1e8;
  border-radius: 1rem;
}
.wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

header a.logo {
  font-size: 2.2rem;
  font-weight: bold;
  color: #fca503;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav {
  position: fixed;
  right: 0;
  top: 0;
  height: 40vh;
  width: 50%;
  z-index: 60;
  background-color: #fff;
  transform: translateX(100%);
  transition: translateX .5s ease-in-out;
}

.toggle-menu {
  transform: translateX(0);
}

ul.nav {
    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 2em;
}
.close {
  cursor: pointer;
    display: block;
    margin: 2em 18em;
}

nav ul li a {
  font-size: 1.8rem;
  color: #000;
}

ul li.active>a {
    font-weight: bold;
    color:#fca503;
}

ul li a:hover {
    color: #fca503;
}

.profile {
  display: flex;
  gap: 30em;
}

button {
  border: none;
  outline: none;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #c3ccd7;
  padding: 0.4em 0.8em;
  cursor: pointer;
  gap: 0.4em;
  border-radius: 0.4em;
  color: #000;
  font-size: 1.8rem;
}

button p {
  margin: 0;
}

button:hover {
  color: #fff;
  background-color: #fca503;
}

/* span {
    width: 450px;
    height: 35px;
    background-color: #DBE1E8;
    margin-top: 9.7em;
    margin-left: 12.2em;
    border-radius: 4.5em;
} */

.spTwo {
    width: 300px;
    margin-top: 2.4em;
}

@media (min-width: 700px) {
  .hamburger, .close {
    display: none;
  }

  .hide-mobile {
    display: block;
  }

  nav {
    position: unset;
    height: auto;
    background: none;
    width: auto;
    color:black;
    transform: translateX(0);
  }
  ul.nav {
    flex-direction: row;
    gap: 10em;
  }

  ul li.active {
    font-weight: bold;
    border-bottom: 2px solid #fca503;
    color: #fca503;
    padding-bottom:8px;
  }
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background-color: #fca503;
    color: #fff;
}

.dropdown {
    position: relative;
    display: inline-block;
}

/* .dropbtn {
    background-color: #f1f1f1;
    color: #000;
    padding: 10px;
    border: none;
    cursor: pointer;
} */

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    z-index: 1;
}
.dropdown-content.actv {
    display: block;
    position: fixed;
    right: 10px;
}

.dropdown-content a {
    font-size:16px;
    color: #000;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.show {
    display: block;
    z-index:60;
}
.dropdown-content a:hover {
    background:#fff;
    color:#fca503;
}
/* .active {
    color: red;
} */
.navbar-links {
  list-style-type: none;
  display: flex;
}
.navbar-links li a {
  display: block;
  text-decoration: none;
  color: #444;
  padding: 0 0 0px 10px;
  font-weight: 700;
  transition: 0.4s all;
}

.navbar-links li.navbar-dropdown {
  position: relative;
}

.navbar-links li.navbar-dropdown:hover .dropdown {
  visibility: visible;
  opacity: 1;
  transform: translateY(0px);
}

.navbar-links li.navbar-dropdown .dropdown {
  visibility: hidden;
  opacity: 0;
  position: absolute;
  padding: 20px 0;
  top: 100%;
  transform: translateY(50px);
  left: 0;
  width: 250px;
  background-color: #fff;
  box-shadow: 0px 10px 10px 3px rgba(0, 0, 0, 0.3);
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  z-index: 111;
  transition: 0.4s all;
}
.navbar-links li.navbar-dropdown .dropdown a {
  padding-top: 10px;
  padding-bottom: 10px;
  font-weight: 400;
}
.navbar-dropdown .dropdown a:hover {
  padding-left: 30px;
}
.navbar-links li a:hover {
  color: #fca503;
}

/* width */
::-webkit-scrollbar {
  width: 5px;
  height: 3px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #fca503;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000;
}

 /* Modal Styling */
 .modal-wrapper {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgb(0 0 0 / 67%);
  z-index: 9999;
  display: flex;
  justify-content: center;
  animation: fadeIn 0.5s ease-in-out;
  outline: 0;
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
}

.modal-content {
  min-width: 500px;
  max-width: 700px;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  animation: slideIn 0.5s ease-in-out;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 25px;
  font-weight: bold;
}

/* Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideIn {
  from {
    transform: translateY(-50px);
  }
  to {
    transform: translateY(0);
  }
}

    .modal.fade.top.show{
top:0px !important
    }
    .sl {
    font-size: 18px;
    /* padding: 4px; */
}

.w-full {
    width: 100% !important;
    height: 20px;
    font-size: small;
    background: white;
    border: 1px solid #e2e8f0;
}

  </style>
</head>
<link rel="stylesheet" href="{{ asset('assets/build/css/intlTelInput.css') }}">
<body style="background-color:white;">
<header class="box" style="box-shadow: 0 30px 40px #0000000b;">
 <div class=" navbar">

  <nav>
    <svg class="close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41L17.59 5Z" fill="black"/>
</svg>
    <ul class="nav navbar-links">
      <li class="d-flex driver-list"><i data-feather="user"></i><a href="{{ url('/dispatch/home') }}" id="driver-list">@lang('view_pages.drivers_list')</a></li>
      <li class="d-flex bookride navbar-dropdown"><i data-feather="play"></i><a  id="bookride">@lang('view_pages.book_ride')</a>
          <div class="dropdown">
            @if(config('app.app_for') !== 'delivery')
            <a href="{{ url('/book-ride') }}?type=taxi"><i class="fa fa-car me-2"></i>@lang('view_pages.taxi')</a>
            @endif
            @if(config('app.app_for') !== 'taxi')
            <a href="{{ url('/book-ride') }}?type=delivery"><i class="fa-solid fa-truck me-2"></i>@lang('view_pages.delivery')</a>
            @endif
            <a href="{{ url('/book-ride') }}?type=rental"><i class="fa-solid me-2 fa-clock"></i>@lang('view_pages.rental')</a>
          </div>
      </li>
      <li class="d-flex request"><i data-feather="file-text"></i><a href="{{ url('/dispatch/requests-list') }}" id="link3" >@lang('view_pages.request_list')</a></li>
      <li class="d-flex ongoing"><i data-feather="truck" class="me-2"></i><a href="{{ url('/ongoing-trip') }}" id="link4">@lang('view_pages.ongoing_trip')</a></li>
    </ul>
  </nav>

  <div class="profile dropdown">
      <div  onclick="toggleDropdown()" class="dropbtn w-24 h-24 rounded-pill overflow-hidden shadow-lg image-fit zoom-in">
          <img alt="" src="{{ asset('assets/img/user-dummy.svg') }}">
      </div>
      <div class="dropdown-content" id="myDropdown">
        <a href="{{url('/api/spa/logout')}}"><i class="fa fa-sign-out me-3" style="color:#fca503;"></i>@lang('view_pages.logout')</a>
      </div>
  </div>

  <svg class="hamburger" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 22.5H3.75V20H15V22.5ZM26.25 16.25H3.75V13.75H26.25V16.25ZM26.25 10H15V7.5H26.25V10Z" fill="black"/>
  </svg>
  </div>
</div>
</header>

<script>
  document.querySelector(".hamburger").addEventListener("click", function () {
            document.querySelector("nav").classList.toggle("toggle-menu")
        });

        document.querySelector(".close").addEventListener("click", function () {
            document.querySelector("nav").classList.toggle("toggle-menu")
        });
</script>
<script>
    document.querySelectorAll("nav ul li a").forEach(item => {
        item.addEventListener("click", function() {
            // Remove active class from all menu items
            document.querySelectorAll("nav ul li a").forEach(item => {
                item.classList.remove("active");
            });
            // Add active class to the clicked menu item
            this.classList.add("active");
        });
    });

</script>
<script>
  function toggleDropdown() {
    var dropdownMenu = document.getElementById("myDropdown");
    dropdownMenu.classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
// onclick() = function(event) {
//     if (!event.target.matches('.dropbtn')) {
//         var dropdowns = document.getElementsByClassName("dropdown-content");
//         var i;
//         for (i = 0; i < dropdowns.length; i++) {
//             var openDropdown = dropdowns[i];
//             if (openDropdown.classList.contains('show')) {
//                 openDropdown.classList.remove('show');
//             }
//         }
//     }
// }
</script>
<script>
  // Add event listeners to navlinks to handle click events
// document.getElementById("link1").addEventListener("click", function() {
//     setActiveNavLink("link1"); // Call function to set this as the active navlink
// });

// document.getElementById("link2").addEventListener("click", function() {
//     setActiveNavLink("link2"); // Call function to set this as the active navlink
// });

// document.getElementById("link3").addEventListener("click", function() {
//     setActiveNavLink("link3"); // Call function to set this as the active navlink
// });

// Function to set the active navlink
function setActiveNavLink(linkId) {
    // Remove 'active' class from all navlinks
    document.querySelectorAll("nav ul li a").forEach(link => {
        link.classList.remove("active");
    });

    // Add 'active' class to the clicked navlink
    document.getElementById(linkId).classList.add("active");
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(document).ready(function(){

$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
   $('.navbar-toggle').click();
});


});
var modal;
function popup_init(){
     modal = document.getElementById("modal1");
    modal.style.display = "flex";
  }
  function popup_data(model_content){
    $(".model-content-wrapping").html(model_content);
    modal.style.display = "flex";

  }
  function popup_close()
  {
     modal = document.getElementById("modal1");
    modal.style.display = "none";
  }
</script>
</body>
</html>
