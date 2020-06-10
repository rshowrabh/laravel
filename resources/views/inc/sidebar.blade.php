<div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{Auth::user()->avatar ? '/storage/users-avatar/'.Auth::user()->avatar : 'dist/img/user2-160x160.jpg'}}" class="img-circle elevation-2" alt="User Image">
                        
                    </div>
                    <div class="info">
                        <a href="/" class="d-block">{{Auth::user()->name}}  ({{Auth::user()->role->name}})</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @can('isAdmin')  
                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        @endcan
                       {{--   <li class="nav-item">
                            <router-link to="/profile" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li> --}}
                        @if(Gate::check('isTutor') || Gate::check('isStudent'))
                        @can('isStudent')
                        <li class="nav-item">
                            <router-link to="/find_teacher" class="nav-link ">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Request For Teacher
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        @endcan
                        @can('isTutor')
                        <li class="nav-item">
                            <router-link to="/student_request" class="nav-link ">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Student Request
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        @endcan
                          
                         <li class="nav-item">
                            <router-link to="/calendar" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Calendar
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/payment" class="nav-link">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Payment
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        @can('isTutor')
                         <li class="nav-item">
                            <router-link to="/my_students" class="nav-link">
                                <i class=" nav-icon fas fa-user-graduate"></i>
                                <p>
                                    My students
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        @endif
                        <li class="nav-item">
                            <router-link to="/my_classes" class="nav-link">
                                <i class="nav-icon fas fa-binoculars"></i>
                                <p>
                                    My Classes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/my_courses" class="nav-link">
                                <i class="nav-icon fab fa-discourse"></i>
                                <p>
                                    My Courses
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>
                            @endcan
                        </li>
                       
                        @can('isAdmin')
                        <li class="nav-item">
                            <router-link to="/academic" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Academic
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                         <li class="nav-item">
                            <router-link to="/skill" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Skills
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                         <li class="nav-item">
                            <router-link to="/grade" class="nav-link">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Grade
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        
                        
                         <li class="nav-item">
                                    <router-link to="/user" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User</p>
                                    </router-link>
                                </li>
                        <li class="nav-item">
                            <router-link to="/developer" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                   Developer
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </router-link>

                        </li>
                        @endcan
                       
                             <li class="nav-item">
                                 
                                 <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class=" nav-icon fas fa-power-off"></i>
                                                    
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>