<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary bg-primary text-light elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-primary">
        <img src="{{asset('assets/images/logo.png')}}" alt="Vemto Logo" class="brand-image bg-white img-circle">
        <span class="brand-text font-weight-bold">Online USCS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon  fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                 @can('view-any', App\Models\Student::class)
                 @if(Auth::user()->hasRole('student') && !empty(Auth::user()->student))
                 <li class="nav-item">
                                <a href="{{ route('students.show',Auth::user()->student) }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>profile</p>
                                </a>
                            </li>
                 @endif
                 @if(Auth::user()->hasRole('super-admin'))
                   <li class="nav-item">
                                <a href="{{ route('students.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Students</p>
                                </a>
                            </li>
                @endif
                @if(!Auth::user()->hasRole('super-admin') && !Auth::user()->hasRole('student'))
                            <li class="nav-item">
                                <a href="{{ route('users.show',Auth::user()) }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>profile</p>
                                </a>
                            </li>
                @endif
            @endcan

                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Clearance::class)
                            @if(Auth::user()->hasRole('super-admin'))
                            <li class="nav-item">
                                <a href="{{ route('clearances.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>Clearances</p>
                                </a>
                            </li>
                            @endif
                            @if(!Auth::user()->hasRole('super-admin') && !Auth::user()->hasRole('student'))
                            <li class="nav-item">
                                <a href="{{route('clears.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>Clearances</p>
                                </a>
                            </li>
                            @endif
                            @endcan
                            @can('view-any', App\Models\Clear::class)
                            @if(Auth::user()->hasRole('student') && !empty(Auth::user()->student))
    <?php  
        $student = Auth::user()->student;
    ?>
    <li class="nav-item">
        <a href="{{ $student->clearance ? route('student-clearance.show',$student) : '#' }}" class="nav-link {{ $student->clearance ? '' : 'disabled' }}">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>Clearance @if($student->clearance && ($student->clearance->completed_clears()==true))<span class="badge badge-secondary">complete</span>@elseif($student->clearance && ($student->clearance->completed_clears()==false)) <span class="badge badge-warning">on-progress</span>@else <span class="badge badge-danger">not requested</span> @endif</p>
        </a>
    </li>
@endif


                            @if(Auth::user()->hasRole('super-admin'))
                            <li class="nav-item">
                                <a href="{{ route('clears.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file-signature"></i>
                                    <p>Clears process</p>
                                </a>
                            </li>
                            @endif
                            @endcan

                            @can('view-any', App\Models\Message::class)
                            <li class="nav-item">
                                <a href="{{ route('messages.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-comments"></i>
                                    <p>Messages</p>
                                </a>
                            </li>
                            @endcan

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            Access Management
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endauth

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit text-danger"></i>
                        <p class="text-danger">{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>