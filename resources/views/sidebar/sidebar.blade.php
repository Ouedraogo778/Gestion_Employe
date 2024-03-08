<aside>
    <style>
        #sidebar {
            overflow-y: auto;
            max-height: 100vh;
            top: -27;
            
            font-weight: bold;
            /* Limitez la hauteur à 100% de la hauteur de la vue */
        }

        /* Styles pour les flèches de déroulement */
        #sidebar::-webkit-scrollbar {
            width: 8px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color:blue;
            border-radius: 10px;
        }

        #sidebar::-webkit-scrollbar-track {
            background-color:black
        }
    </style>

    <div class="sidebar" id="sidebar" style="background-color:#000000;  border-right: 2px solid black;">

        <style>
            .i {
                height: 30px;
                weight: 30px;
            }

            #sidebar-menu ul li a {
                color:chartreuse;
                text-decoration: none;
                display: flex;
                align-items: center;
            }
        </style>
        <div id="sidebar-menu" class="sidebar-menu">
            <br><br>
            <ul>
                <li class="submenu">
                <li>


                    <a href="/home"><i class="fas fa-clinic-medical" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span>ACCEUIL</span></a>

                </li>

                

                </li>

                <li class="submenu">
                <li>
                    @can('role-list')
                    <a href="/menu"><i class="fas fa-users" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span>ADMINISTRATION</span></a>
                    @endcan

                </li>

                </li>



                

                <li class="submenu ">


                    @if (auth()->user()->can('projet-liste') ||
                    auth()->user()->can('projet-ajouter') ||
                    auth()->user()->can('projet-modifier') ||
                    auth()->user()->can('projet-supprimer'))
                    <a class="btn"><i class="fas fa-drafting-compass" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span>PROJETS</span>
                        <span class="menu-arrow"></span>
                    </a>
                    @endif

                    <ul>
                        @if (auth()->user()->can('projet-liste') ||
                        auth()->user()->can('projet-modifier') ||
                        auth()->user()->can('projet-supprimer'))
                        <li><a href="{{ route('projets.index') }}" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Liste
                                projets</a></li>
                        @endif

                        @can('projet-ajouter')
                        <li><a href="{{ route('projets.create') }}" class=""><i class="fas fa-pen-alt" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Ajouter
                                projet</a></li>
                        @endcan

                        


                    </ul>
                </li>
                

                <li class="submenu  ">
                
                @if (auth()->user()->can('validation-coordination-activite') ||
                    auth()->user()->can('validation-raf-activite') ||
                    auth()->user()->can('validation-president-activite'))
                    <a class="btn"><i class="	fab fa-get-pocket" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span> VALIDATION ACTIVITE</span>
                        <span class="menu-arrow"></span>
                    </a>
                    @endif

                    <ul>
                    @can('validation-coordination-activite')
                            
                        <li><a href="/validation1" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Coordination</a></li>
                       @endcan 
                       @can('validation-raf-activite')
                        <li><a href="/validation2" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau RAF</a></li>
                        @endcan
                        <!-- @can('validation-president-activite')
                        <li><a href="/validation3" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Président</a></li>
                        @endcan -->
                    </ul>
                </li>


                <li class="submenu  ">
                @if (auth()->user()->can('validation-coordination-mission') ||
                    auth()->user()->can('validation-raf-mission') ||
                    auth()->user()->can('validation-president-mission'))

                    <a class="btn"><i class="fab fa-get-pocket" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span> VALIDATION MISSION</span>
                        <span class="menu-arrow"></span>
                    </a>
                    @endif

                    <ul>
                    @can('validation-coordination-mission')

                        <li><a href="/validationmission1" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Coordination</a></li>
                        
                        @endcan
                        @can('validation-raf-mission')
                        <li><a href="/validationmission2" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau RAF</a></li>
                       @endcan
                       <!-- @can('validation-president-mission')
                        <li><a href="/validationmission3" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Président</a></li>
                        @endcan -->
                    </ul>
                </li>

                <li class="submenu  ">
                @if (auth()->user()->can('validation-coordination-rapport-activite') ||
                    auth()->user()->can('validation-raf-rapport-activite') ||
                    auth()->user()->can('validation-president-rapport-activite'))

                    <a class="btn"><i class="fab fa-get-pocket" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span> VALIDATION RAPPORT ACTIVITE</span>
                        <span class="menu-arrow"></span>
                    </a>
                    @endif

                    <ul>
                    @can('validation-coordination-rapport-activite')

                        <li><a href="/validationractivite1" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Coordination</a></li>
                        
                        @endcan
                        @can('validation-raf-rapport-activite')
                        <li><a href="/validationractivite2" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau RAF</a></li>
                        @endcan
                        <!-- @can('validation-president-rapport-activite')
                        <li><a href="/validationractivite3" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Président</a></li>
                        @endcan -->
                    </ul>
                </li>

                <li class="submenu  ">
                @if (auth()->user()->can('validation-coordination-rapport-mission') ||
                    auth()->user()->can('validation-raf-rapport-mission') ||
                    auth()->user()->can('validation-president-rapport-mission'))

                    <a class="btn"><i class="fab fa-get-pocket" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>
                        <span> VALIDATION RAPPORT MISSION</span>
                        <span class="menu-arrow"></span>
                    </a>
                    @endif

                    <ul>
                        @can('validation-coordination-rapport-mission')
                        <li><a href="/validationrmission1" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Coordination</a></li>
                        @endcan
                        @can('validation-raf-rapport-mission')
                        <li><a href="/validationrmission2" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau RAF</a></li>
                        @endcan
                        <!-- @can('validation-president-rapport-mission')
                        <li><a href="/validationrmission3" class=""><i class="fas fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>Niveau Président</a></li>
                        @endcan -->
                    </ul>
                </li>
                

                <li class="submenu">
                <li>

                    <a href="{{ route('modifierMdp') }}"><i class="fa fa-cog" style="--fa-primary-color: #000000; --fa-secondary-color: #000000;"></i>

                        <span>PARAMETRE DE MDP</span>
                    </a>
                    



                </li>

               

                </li>


            </ul>
        </div>
    </div>
</aside>