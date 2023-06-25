@auth 
<div class="row mb-3">
    <div class="col-sm-12 d-flex justify-content-end">
        Welcome <span class="badge badge-success ml-2" > {{Auth::user()->name}} </span> <span class="badge badge-primary ml-2">{{$role}}</span>
    </div>
</div>
<div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{count(\App\Models\Clearance::all())}}</h3>
                                <p>total Student Requested</p>
                            </div>
                            
                            <div class="icon">
                                <i class="icon fas fa-user-plus"></i>
                            </div>
                            <a href="{{route('clears.index')}}" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{count(\App\Models\User::all())}}<sup style="font-size: 20px"></sup></h3>

                                <p>Total user</p>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-sharp fa fa-folder-open"></i>
                            </div>
                            
                            <a href="{{ route('users.index') }}" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{count(\App\Models\Student::all())}}</h3>

                                <p>Students</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <a href="{{route('students.index')}}" class="small-box-footer">view <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
@endauth