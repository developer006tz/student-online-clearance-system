@empty($user->student->id)
@section('styles')
    <link rel="stylesheet" href="{{asset('wizard/wizard.css')}}">
@endsection
    <div class="row justify-content-center">
                        <div class="col-11 text-center p-0 mt-3 mb-2">
                            <div class="card px-0 pt-4 pb-0 mt-3 mb-3 text-success">
                                <h2 id="heading">Welcome {{$user->name}}</h2>
                                <p>Congratulation's, You are 1 step  to Finish your Registration</p>

                                <form id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Register</strong></li>
                                        <li class="active" id="personal"><strong>Choose Role</strong></li>
                                        <li id="payment"><strong>Fill {{$user->getRoleNames()[0]}} Info's</strong></li>
                                        <li id="confirm"><strong>Finish</strong></li>
                                    </ul>
                                    <br>
                                    <!-- fieldsets -->
                                    <fieldset class="d-flex justify-content-center">
                                        <a href="{{url('students/create')}}"  name="next" class="next action-button">Next</a>
                                    </fieldset>
                                    
                                
                                </form>
                            </div>
                        </div>
 </div>
@endempty

@isset($user->student->id)
<div class="row mb-3">
    <div class="col-sm-12 d-flex justify-content-end">
        Welcome <span class="badge badge-success ml-2" > {{Auth::user()->name}} </span> <span class="badge badge-primary ml-2">{{$role}}</span>
    </div>
</div>

    <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>100%</h3>

                                <p>Profile</p>
                            </div>
                            
                            <div class="icon">
                                <i class="icon fas fa-user-plus"></i>
                            </div>
                            <a href="{{route('students.show',$user->student)}}" class="small-box-footer">view your profile<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{$clearance ? $clearance->pending() :  '0'}}<sup style="font-size: 20px"></sup></h3>

                                <p>Pending clearance</p>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-sharp fa fa-folder-open"></i>
                            </div>
                            
                            <a href="{{ route('clearances.index') }}" class="small-box-footer">view<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$clearance ? $clearance->cleared() :'0'}}</h3>

                                <p>Complete</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <a href="#" class="small-box-footer">view <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Previous clearance</h3> --}}
                <div class="row d-flex justify-content-end my-2">
                    <a href="{{route('create-clearance.store',$student)}}" class="btn btn-primary">Request clearance</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="student_clearances_summary" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr role="row">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">student</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Level</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Wadern</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Librarian-Udsm</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Librarian-Cse</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Coordinator</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Principal</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Smart-Card</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Request Date</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">status</th>
                </tr>
                  </thead>
                  <tbody>
                    @forelse($clearances as $clearance)

                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{ $clearance->student->user->name?? '-' }}</td>
                     <td class="dtr-control sorting_1" tabindex="0">{{ $clearance->level?? '-' }}</td>
                    <td style="width: 134px;">
                        {!! $clearance->{'hall-wadern'} == '0' ? '<button class="btn btn-warning">pending</button>' : ($clearance->{'hall-wadern'} == '1' ? '<button class="btn btn-success">cleared</button>' : ($clearance->{'hall-wadern'} ?? '-')) !!}
                    </td>
                    <td style="width: 134px;">
                        {!! $clearance->{'librarian-udsm'} == '0' ? '<button class="btn btn-warning">pending</button>' : ($clearance->{'librarian-udsm'} == '1' ? '<button class="btn btn-success">cleared</button>' : ($clearance->{'librarian-udsm'} ?? '-')) !!}
                    </td>
                    <td style="width: 134px;">
                        {!! $clearance->{'librarian-cse'} == '0' ? '<button class="btn btn-warning">pending</button>' : ($clearance->{'librarian-cse'} == '1' ? '<button class="btn btn-success">cleared</button>' : ($clearance->{'librarian-cse'} ?? '-')) !!}
                    </td>
                    <td style="width: 134px;">
                        {!! $clearance->coordinator == '0' ? '<button class="btn btn-warning">pending</button>' : ($clearance->coordinator == '1' ? '<button class="btn btn-success">cleared</button>' : ($clearance->coordinator ?? '-')) !!}
                    </td>
                    <td style="width: 134px;">
                        {!! $clearance->principal == '0' ? '<button class="btn btn-warning">pending</button>' : ($clearance->principal == '1' ? '<button class="btn btn-success">cleared</button>' : ($clearance->principal ?? '-')) !!}
                    </td>
                    <td style="width: 134px;">
                        {!! $clearance->{'smart-card'} == '0' ? '<button class="btn btn-warning">pending</button>' : ($clearance->{'smart-card'} == '1' ? '<button class="btn btn-success">cleared</button>' : ($clearance->{'smart-card'} ?? '-')) !!}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($clearance->created_at)->format('d/m/Y') ?? '-' }}</td>
                    <td style="width: 134px;">
                        {!! $clearance->completed_clears() == false ? '<button class="btn btn-secondary">incomplete</button>' : ($clearance->completed_clears() == true ? '<button class="btn btn-success">cleared</button>' : '<button class="btn btn-info">not started</button>') !!}
                    </td>
                    
                  </tr>
                   @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                not requested yet
                            </td>
                        </tr>
                        @endforelse
                </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                        </div>
                    </div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
                    </div>
                </div>
@endisset
