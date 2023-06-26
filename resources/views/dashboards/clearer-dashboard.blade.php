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
                                <h3>{{count($clearances)}}</h3>
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
                                <h3>{{count($clearances->where('status','<>','1'))}}<sup style="font-size: 20px"></sup></h3>

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
                                <h3>{{count($clearances->where('status','=','1')->where('signature','1'))}}</h3>

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
                <h3 class="card-title">Previous clearance</h3>
                <div class="row d-flex justify-content-end my-2">
                    <a href="{{route('clears.index')}}" class="btn btn-primary">view all</a>
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
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">reg-number</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">level</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">status</th>
                </tr>
                  </thead>
                  <tbody>
                    @forelse($clearances as $clear)
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{ $clear->clearance->name?? '-' }}</td>
                     <td class="dtr-control sorting_1" tabindex="0">{{ $clear->clearance->registration_number?? '-' }}</td>
                     <td class="dtr-control sorting_1" tabindex="0">{{ $clear->clearance->level?? '-' }}</td>
                    <td style="width: 134px;">
                       @if($clear->status == 1)
                    <span class="badge badge-success">cleared</span>
                    @else
                    <span class="badge badge-danger">not cleared</span>
                    @endif
                    </td>
                  </tr>
                   @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                not requested yet
                            </td>
                        </tr>
                        @endforelse
                </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                </div>
            </div>
             </div>
        </div>
     </div>
              <!-- /.card-body -->
            </div>
                    </div>
                </div>
@endauth