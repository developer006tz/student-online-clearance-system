{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('students.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.students.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.user_id')</h5>
                    <span>{{ optional($student->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.id_number')</h5>
                    <span>{{ $student->id_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.block_number')</h5>
                    <span>{{ $student->block_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.students.inputs.room_number')</h5>
                    <span>{{ $student->room_number ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('students.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Student::class)
                <a href="{{ route('students.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection








 --}}

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
                             src="{{ $student->user->image ? url(\Storage::url($student->user->image)) : asset('default.png') }}"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $student->user->name ?? '-' }}</h3>

                    <p class="text-muted text-center">student</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Id Number</b> <a class="float-right">{{ $student->id_number ?? '-' }}</a>
                        </li>
                         <li class="list-group-item">
                            <b>Level</b> <a class="float-right">{{ $student->level ?? '-' }}</a>
                        </li>
                    </ul>
                    @can('update', $student)
                    <a href="{{ route('student-profile.edit', $student) }}" class="btn btn-primary btn-block"><b> <i class="icon ion-md-create"></i> edit</b></a>
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
                                <h3 class="card-title">student Birth details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 30%">Name</th>
                                        <th>{{ $student->user->name ?? '-' }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr >
                                        <td>Id Number</td>
                                        <td>

                                          {{ $student->id_number ?? '-' }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class Level</td>
                                        <td>
                                            {{-- {{ \Carbon\Carbon::parse($student->birthdate)->format('l H:i:s') ?? '-' }} --}}
                                            {{ $student->level ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Block Number</td>
                                        <td>
                                            {{ $student->block_number ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Room Number</td>
                                        <td>
                                            {{ $student->room_number ?? '-'}}
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

