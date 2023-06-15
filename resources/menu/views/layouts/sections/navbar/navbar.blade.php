@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

<style>
  #selectedImagesShow{
   position: absolute; 
   background-color: #fff;
   top: 62px;
    left: 0;
    width: 100%;
    cursor: pointer;
  }
  #overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgb(0 0 0 / 35%);
  z-index: 2;
  cursor: pointer;
}
  #selectedImagesShow li{
    color:#000;
    font-size: 14px;
  }
  #projectstyle
  {
    color: blue;
    display: flex;
    margin-top: 10px;
  }
  #imgstyle
  {
    border-radius:50%;
  }
 
</style>
<!-- Navbar -->
<div id="overlay"></div>
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])
          </span>
          <span class="app-brand-text demo menu-text fw-bolder">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center" id="myprojects">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none" name ="term" title="Search projects" onkeyup="myFunction()" id="term"  placeholder="Search..." aria-label="Search...">
            <div id="selectedImagesShow">
           </div>
          </div>
        </div>

        <div>
    </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- Place this tag where you want the button to render. -->
          <button type="button" class="btn btn-sm rounded-pill btn-icon btn-secondary mx-2">
            <span class="tf-icons bx bx-bell"></span>
          </button>
          <li class="nav-item lh-1 me-3">
            <a class="github-button" href="https://github.com/themeselection/sneat-html-laravel-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-laravel-admin-template-free on GitHub">{{session('fname')}}</a>
          </li>

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <input value="{{ENV('APP_URL')}}/project-all" id="projecturl" type="hidden"/>
            <input value="{{ENV('APP_URL')}}/Getpropertydata" id="propertyurl" type="hidden"/>
            <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ENV('APP_URL')}}/users/images/{{session('photo')}}" alt class="w-px-40 rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ENV('APP_URL')}}/users/images/{{session('photo')}}" alt class="w-px-40 rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">{{session('fname')}} {{session('lname')}}</span>
                      <small class="text-muted">{{session('role')}}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item"  href="{{url('/profile')}}">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{url('/setting')}}">
                  <i class='bx bx-cog me-2'></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item"  href="{{url('/logout')}}">
                  <i class='bx bx-power-off me-2'></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <script>
    function myFunction()
    {
      document.getElementById("overlay").style.display = "block";
     let getval= document.getElementById('term').value;
     if(getval =='')
     {
      document.getElementById("overlay").style.display = "none";
     }
      let term=document.getElementById('term').value;
      let data =  new FormData;
       data.append('term',term);
       axios.post('{{ENV("APP_URL")}}/submit-search',data).then((result) => {
       if(result.data != 0){
      let selectednamesArr=[];
       selectednamesArr = result.data;
       console.log(selectednamesArr);
       document.getElementById('selectedImagesShow').innerHTML = '';
       let term=document.getElementById('term').value;
       if(term !='')
       {
        selectednamesArr.map(x => {
        if(x !='')
        {
          let projecturl=document.getElementById('projecturl').value;
          let propertyurl=document.getElementById('propertyurl').value;
          var imgurl= document.getElementById('imgurl').value;
          if(x.type =='property')
          {
            $('#selectedImagesShow').append("<a href="+propertyurl+"/"+x.id+" id="+x.id+"><li class='list-group-item'>"+x.name+" <span id='projectstyle'> Property <span></li></a>");
          }
          if(x.type =='project')
          {
            $('#selectedImagesShow').append("<a href="+projecturl+" id="+x.id+"><li class='list-group-item'>"+x.name+"  <span id='projectstyle'> Project <span></li></a>");
            // <img src="+imgurl+"/"+x.imageurl+" alt='project Img' id='imgstyle' width='20px' height='20px'> 
          }
         
        }
    })

     }
     }
     if(result.data == 0){
          $('#selectedImagesShow').html(`<li class="list-group-item">Sorry No result Found</li>`);
          // document.getElementById('selectedImagesShow').innerHTML = '';
        }


    }).catch((err) => {
      console.log(err);
    });
    }
  </script>
  <!-- / Navbar -->
