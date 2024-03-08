<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- <title>Gestion des actions des employés</title> -->
    <title>Action CiDeP</title>

    <script src="{{ asset('js/jspdf.umd.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ URL::to('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('fontawesome-free/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ URL::to('assets/plugins/datatables/cdn.datatables.net_1.13.6_css_jquery.dataTables.min.css') }}">
    <link rel="stylesheet"
        href="{{ URL::to('assets/plugins/datatables/cdn.datatables.net_buttons_2.4.1_css_buttons.dataTables.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/aos/aos.css') }}">
    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>



    <style>
        body {
            /*background: linear-gradient(35deg, #f4823c, #07da9763);*/



        }
    </style>


</head>

<body>
    <style>
        
        a .imge {

            margin: 15px;
            margin-left: 55px;
            border-radius: 15px 5px;
            border: 2px solid black;
            margin-top: 8px;
        }

        a p {
            margin-top: 10px;
            color: #f4823c;
        }
      
    .main-wrapper.sidebar-open .header {
        margin-left: 0;
    }
    </style>
    <div class="main-wrapper">
        <div class="header" style=" background-color:blue;">
           

            <div class="top-nav-search">


            </div>
            <div class="menu-toggle" style="margin-left: 20px;">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <p style="font-size: 26px;  margin-top:12px; font-family:'Times New Roman', Times, serif; font-weight: bold; color:chartreuse ;margin-left: 20px; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">PROCEDURE Action CiDeP</p>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav user-menu">


                <li class="nav-item" style="color:aqua; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">
                <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                             <span>
                                <h5
                                    style="font-size: 20px; color:white; margin-top:12px;font-family:'Times New Roman', Times, serif; font-weight: bold;">
                                    {{ Auth::user()->name }}</h5>
                            </span>

                            <div class="user-text">
                                <h6>{{ Session::get('name') }}</h6>
                                <p class="text-muted mb-0">{{ Session::get('role_name') }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">

                        <a class="dropdown-item fas fa-power-off" 
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            DECONNEXION</a>
                            <a class="fas fa-cog"
                            href="{{ route('modifierMdp') }}">

                            PARAMETRE DE MDP</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>
            </ul>

        </div>
        <!-- pour le side bar-->
        {{-- side bar --}}

        @include('sidebar.sidebar')


        {{-- content page --}}




        @yield('content')
        

    </div>

    <script src="jav/script.js"></script>

    <script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ URL::to('assets/js/calander.js') }}"></script>
    <script src="{{ URL::to('assets/js/circle-progress.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/plugins/datatables/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js') }}">
    </script>
    <script src="{{ URL::to('assets/plugins/datatables/cdn.datatables.net_buttons_2.4.1_js_dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ URL::to('assets/plugins/datatables/cdnjs.cloudflare.com_ajax_libs_jszip_3.10.1_jszip.min.js') }}">
    </script>
    <script src="{{ URL::to('assets/plugins/datatables/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_pdfmake.min.js') }}">
    </script>
    <script src="{{ URL::to('assets/plugins/datatables/cdnjs.cloudflare.com_ajax_libs_pdfmake_0.1.53_vfs_fonts.js') }}">
    </script>
    <script src="{{ URL::to('assets/plugins/datatables/cdn.datatables.net_buttons_2.4.1_js_buttons.html5.min.js') }}">
    </script>
    <script src="{{ URL::to('assets/plugins/datatables/cdn.datatables.net_buttons_2.4.1_js_buttons.print.min.js') }}">
    </script>

    <script src="{{ URL::to('assets/plugins/datatables/cdnjs.cloudflare.com_ajax_libs_jspdf_2.4.0_jspdf.umd.min.js') }}">
    </script>

    <script src="{{ URL::to('assets/plugins/datatables/jspdf.umd.min.js') }}"></script>

    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/script.js') }}"></script>
    <script src="{{ URL::to('assets/aos/aos.js') }}"></script>
    <script src="{{ URL::to('assets/aos/aos.js') }}"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>

    <script src="dashboard/script.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    @yield('script')





</body>

</html>
