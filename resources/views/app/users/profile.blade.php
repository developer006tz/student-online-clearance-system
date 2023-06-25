@extends('layouts.app')

@section('content')


<!-- /.col -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 profile">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $user->image ? url(\Storage::url($user->image)) : asset('default.png') }}"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name ?? '-' }}</h3>

                    <p class="text-muted text-center"> <span class="badge badge-primary">{{$role_name ?? '-'}}</span> </p>

                    @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-block"><b> <i class="icon ion-md-create"></i> edit</b></a>
                        @endcan
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div>
<div class="col-md-9" id="all-info">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link nine active" href="#student_birth_info" data-toggle="tab">Profile</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="student_birth_info">
                    <!-- Post -->
                    <div class="post">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Your Infos</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 30%">Name</th>
                                        <th>{{ $user->name ?? '-' }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr >
                                        <td>Role</td>
                                        <td>

                                          {{ $role_name ?? '-' }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>username</td>
                                        <td>
                                            {{-- {{ \Carbon\Carbon::parse($birthdate)->format('l H:i:s') ?? '-' }} --}}
                                            {{ $user->username ?? '-' }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.post -->



                    <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
             
                <!-- /.tab-pane -->

                </div>


                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
    </div>
    </div>


@endsection

