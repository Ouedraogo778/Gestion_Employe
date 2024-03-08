@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <style>
            .icone {
                cursor: pointer;
                position: relative;
                display: block;
                transition: 0.5s;


            }

            .icone:hover::before {
                position: absolute;
                background: var(--color);
                transform: scale(0.9);
            }


            .digital-clock {
                position: absolute;

                text-align: center;
                color: white;
                background: #ffffff;
                width: 425px;
                padding: 20px 45px;
                box-shadow: 0 5px 25px rgba(37, 29, 14, 0.696);
                border-radius: 10px;
                border-left: 10px solid black;
                border-top-left-radius: 10px;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;

            }

            .digital-clock::before {
                content: '';
                position: absolute;
                background: linear-gradient(45deg, #24ff6d, #2f93f1, #ff5e9a);
                background-size: 200% 200%;
                top: -5px;
                left: -5px;
                bottom: -5px;
                right: -5px;
                z-index: -1;
                filter: blur(40px);
                animation: glowing 10s ease infinite;
            }

            @keyframes glowing {
                0% {
                    background-position: 0 50%
                }

                50% {
                    background-position: 100% 50%
                }

                100% {
                    background-position: 0 50%
                }
            }

            .time {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .hours,
            .dots,
            .minutes {
                display: flex;
                justify-content: center;
                align-items: center;
                font-weight: 600px;
                padding: 0 10px;
                line-height: 125px;
            }

            .hours,
            .minutes {
                font-size: 6.5em;
                width: 125px;
            }

            .dots {
                font-size: 5em;
                color: #929292;
            }

            .hours {
                background: -webkit-linear-gradient(90deg, #634dff, #5fd4ff);
                -webkit-text-fill-color: transparent;
                -webkit-background-clip: text;
            }

            .minutes {
                background: -webkit-linear-gradient(90deg, #ff5e9a, #ffb960);
                -webkit-text-fill-color: transparent;
                -webkit-background-clip: text;
            }

            .right-side {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                margin-left: 10px;
            }

            .period,
            .seconds {
                font-size: 1.2em;
                font-weight: 500
            }

            .period {
                transform: translateY(-20px);
                background: -webkit-linear-gradient(90deg, #f7b63f, #faf879);
                -webkit-text-fill-color: transparent;
                -webkit-background-clip: text;

            }

            .seconds {
                transform: translateY(16px);
                background: -webkit-linear-gradient(90deg, #24ff6d, #2f93f1);
                -webkit-text-fill-color: transparent;
                -webkit-background-clip: text;
            }

            .calendar {
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 1.8em;
                font-weight: 500;
                margin-bottom: 5px;
                transform: translateY(16px);
                background: -webkit-linear-gradient(90deg, #000000, #000000);
                -webkit-text-fill-color: transparent;
                -webkit-background-clip: text;
            }

            .day-name,
            .day-number,
            .year {
                margin-left: 8px;
            }

            .dot-menu-btn {
                position: absolute;
                top: 15px;
                right: 15px;
                margin: 10;
                color: #efefef;
                font-size: 1.5em;
                cursor: pointer;
            }

            .dot-menu {
                z-index: 999;
                position: absolute;
                top: 7px;
                right: 5px;
                list-style: none;
                background: #353e54;
                padding: 10px 20px;
                border-radius: 5px;
                box-shadow: 0 5px 25px rgba(0, 0, 0, 0.5);
                visibility: hidden;
                opacity: 0;
                transition: 0.3s ease;
            }

            .dot-menu.active {
                visibility: visible;
                opacity: 1;
            }

            .menu-item {
                display: flex;
                justify-content: center;
                align-items: center;

            }

            .clock-format-text {
                color: #efefef;
                font-size: 0.9em;
                margin-right: 20px
            }

            .format-switch-btn {
                width: 35px;
                height: 15px;
                background: #485470;
                border-radius: 75px;
                box-shadow: inset 2px 2px 4px rgba(255, 255, 255, 255, 0.1),
                    inset -2px -2px 4px rgba(0, 0, 0, 0, 0.2);
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .format-switch-btn:before {
                content: '';
                position: absolute;
                width: 14px;
                height: 14px;
                background: #ff5e9a;
                border-radius: 50px;
                box-shadow: 0 5px 25px #ff5e9a;
                transform: translateX(-10px);
                transition: 0.3s ease;
                transition-property: background, transform;
            }

            .format-switch-btn.active:before {
                background: #ef9e06;
                box-shadow: 0 5px 25px #ffffff;
            }







            .why-us .box {
                padding: 50px 20px;
                box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
                transition: all ease-in-out 0.3s;
                background: #fff;
                border-top: 20px solid #f17a18;
                border-radius: 30px;
                margin-top: 30px;


            }


            .why-us .box span {
                display: block;
                font-size: 35px;
                font-weight: 700;
                color: #f17a18;
            }

            .why-us .box h4 {
                font-size: 24px;
                font-weight: 600;
                padding: 0;
                margin: 20px 0;
                color: #000000;
            }

            .why-us .box p {
                color: #000000;
                font-size: 20px;
                margin: 0;
                padding: 0;
            }

            .why-us .box:hover {
                background: #ea8c3f;
                padding: 30px 30px 70px 20px;
                box-shadow: 10px 15px 30px rgba(0, 0, 0, 0.18);
                border-top: 20px solid rgb(80, 98, 216);
                border-bottom: 10px solid #000000;
                border-radius: 30px;
            }

            .why-us .box:hover span,
            .why-us .box:hover h4,
            .why-us .box:hover p {
                color: #fff;
            }


            .forme {
                width: 800px;
                height: 55px;
                background-color: #4039be71;
                border-radius: 10px;
                border: 2px solid red;
                animation: zoom 2s infinite alternate;
                margin: auto;
                text-align: center;
                font-size: 25px;
                cursor: pointer;

                /* Animation de zoom automatique */
            }

            @keyframes zoom {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(1.2);
                    /* Zoom de 20% */
                }
            }

            .message {
                margin: 4px;
            }
        </style>




        <div class="banner align-items-center">
            <h2 class="container  text-center" style=" font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); color:blue; ">GESTION ADMINISTRATIVE</h2>
        </div>

        <div class="col-lg-12 ">
            <section id="why-us" class="why-us">
                <div class="container" style="">


                    <div class="row">
                        <div class="container mt-5">
                            <div class="row text-center"> <!-- Ajoutez la classe text-center pour centrer horizontalement -->
                                <div class="col-lg-4">
                                    <a href="#">
                                        <div class="card" style="border: 8px solid darkturquoise; border-radius: 10px;">
                                            <h4 class="card-header text-white text-center" style="background-color:darkturquoise; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Gestion des utilisateurs</h4>
                                            <div class="card-body text-center">

                                                <a href="{{ route('users.create') }}"><i class="fa fa-plus-circle icon-center fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="card-footer text-muted text-center" style="background-color:darkturquoise; "><a href="{{ route('users.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste</a></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <a href="#">
                                        <div class="card" style="border: 8px solid darkturquoise; border-radius: 10px;">
                                            <h4 class="card-header text-white text-center" style="background-color:darkturquoise; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Gestion des roles</h4>
                                            <div class="card-body text-center">
                                                <a href="{{ route('roles.create') }}"><i class="fa fa-plus-circle icon-center fa-2x" aria-hidden="true"></i></a>

                                            </div>
                                            <div class="card-footer text-muted text-center" style="background-color:darkturquoise;"><a href="{{ route('roles.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste</a> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4">

                                    <div class="card" style="border: 8px solid darkturquoise; border-radius: 10px;">
                                        <h4 class="card-header text-white text-center" style="background-color:darkturquoise; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Gestion des employés</h4>
                                        <a href="">
                                            <div class="card-body text-center">
                                                <a href="{{ route('employes.create') }}"><i class="fa fa-plus-circle icon-center fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                        </a>

                                        <div class="card-footer text-muted text-center" style="background-color:darkturquoise;  "><a href=" {{route('employes.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste</a></div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="container mt-5">
                            <div class="row text-center"> <!-- Ajoutez la classe text-center pour centrer horizontalement -->
                                <div class="col-lg-4">

                                    <div class="card" style="border: 8px solid #F88E55; border-radius: 10px;">
                                        <h4 class="card-header text-white text-center" style="background-color: #F88E55; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Nouvelle Activité </h4>
                                        <div class="card-body text-center">
                                            <a href="{{ route('activites.create') }}">
                                                <i class="fa fa-plus-circle icon-center fa-2x"  ; aria-hidden="true"></i></a>
                                        </div>

                                        <div class="card-footer text-muted text-center" style="background-color:#F88E55;"><a href="{{ route('activites.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste</a></div>

                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <div class="card" style="border: 8px solid #F88E55; border-radius: 10px;">
                                        <h4 class="card-header text-white text-center" style="background-color: #F88E55; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Nouvelle Mission</h4>
                                        <div class="card-body text-center"><a href="{{ route('missions.create') }}">
                                                <i class="fa fa-plus-circle icon-center fa-2x"  aria-hidden="true"></i></a>
                                        </div>

                                        <div class="card-footer text-muted text-center" style="background-color:#F88E55;"><a href="{{ route('missions.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste </a></div>

                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="card" style="border: 8px solid #F88E55; border-radius: 10px;">
                                        <h4 class="card-header text-white text-center" style="background-color: #F88E55; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Rapport Activité</h4>
                                        <div class="card-body text-center">
                                            <a href="{{ route('ractivites.create') }}">
                                                <i class="fa fa-plus-circle icon-center fa-2x"   aria-hidden="true"></i>

                                            </a>
                                        </div>

                                        <div class="card-footer text-muted text-center" style="background-color:#F88E55;"> <a href="{{ route('ractivites.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste </a></div>

                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="card" style="border: 8px solid #ff5e9a; border-radius: 10px;">
                                        <h4 class="card-header text-white text-center" style="font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);  margin: left 25px; background-color:#ff5e9a;" >Rapport de Mission</h4>
                                        <div class="card-body text-center">
                                            <a href="{{ route('rmissions.create') }}">
                                                <i class="fa fa-plus-circle icon-center fa-2x" style="color:blue" ; aria-hidden="true" style=" text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);"></i></a>
                                        </div>

                                        <div class="card-footer text-muted text-center" style="background-color:#ff5e9a;"><a href="{{ route('rmissions.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste </a></div>

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <div class="card" style="border: 8px solid #ff5e9a; border-radius: 10px;">
                                        <h4 class="card-header text-white text-center" style="background-color:  #ff5e9a; font-family: 'Times New Roman', Times, serif;
            font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Matériel</h4>
                                        <div class="card-body text-center">
                                            <a href="{{ route('materiels.create') }}">
                                                <i class="fa fa-plus-circle icon-center fa-2x" style="color:blue" ; aria-hidden="true" style=" text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);"></i></a>
                                        </div>

                                        <div class="card-footer text-muted text-center" style="background-color: #ff5e9a;"><a href="{{ route('materiels.index') }}" style="font-family: 'Times New Roman', Times, serif; color:#000000; font-weight: bold; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.9);">Voir Liste </a></div>

                                    </div>

                                </div>
                            </div>
                        </div>




                    </div>


                </div>
            </section>

        </div>

    </div>
</div>

@section('script')
<script>
    let BR = document.getElementById("OK");
    let F = document.getElementById("autre");
    BR.addEventListener("click", () => {
        if (getComputedStyle(F).display != "none") {
            F.style.display = "none";
        } else {
            F.style.display = "block";
        }
    })
</script>
<script>
    const formatSwitchBtn = document.querySelector(".format-switch-btn");

    formatSwitchBtn.addEventListener("click", () => {
        formatSwitchBtn.classList.toggle("active");

        var formatValue = formatSwitchBtn.getAttribute("data-format");

        if (formatValue === "12") {
            formatSwitchBtn.setAttribute("data-format", "24");
        } else {
            formatSwitchBtn.setAttribute("data-format", "12");
        }
    });

    // fonction pour l'heur
    function clock() {
        var today = new Date();

        var hours = today.getHours();
        var minutes = today.getMinutes();
        var seconds = today.getSeconds();
        let period = "AM";

        if (hours >= 12) {
            period = "PM";
        }

        var formatValue = formatSwitchBtn.getAttribute("data-format");
        if (formatValue === "12") {
            hours = hours > 12 ? hours % 12 : hours;

        }

        if (hours < 10) {
            hours = "0" + hours;
        }

        if (minutes < 10) {
            minutes = "0" + minutes;
        }

        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        document.querySelector(".hours").innerHTML = hours;
        document.querySelector(".minutes").innerHTML = minutes;
        document.querySelector(".seconds").innerHTML = seconds;
        document.querySelector(".period").innerHTML = period;


    }
    var updateClock = setInterval(clock, 1000);

    //affichage de date
    var today = new Date();
    const dayNumber = today.getDate();
    const year = today.getFullYear();
    const dayName = today.toLocaleString("default", {
        weekday: "long"
    });
    const monthName = today.toLocaleString("default", {
        month: "short"
    });

    document.querySelector(".month-name").innerHTML = monthName;
    document.querySelector(".day-name").innerHTML = dayName;
    document.querySelector(".day-number").innerHTML = dayNumber;
    document.querySelector(".year").innerHTML = year;

    //click sur les trois points
    const dotmenuBtn = document.querySelector(".dot-menu-btn");
    const dotMenu = document.querySelector(".dot-menu");

    dotmenuBtn.addEventListener("click", () => {
        dotMenu.classList.toggle("active");
    });

    document.addEventListener("click", (e) => {
        if (e.target.id !== "active-menu") {
            dotMenu.classList.remove("active");
        }
    });
</script>
@endsection
@endsection