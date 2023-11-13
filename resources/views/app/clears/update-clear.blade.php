@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text h2">
                Student Clearance
            </h2>
        </div>
    </div>
    <div class="row">
          <div class="col-md-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Once you clear This student you can't undo it.
            </div>
          </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3 col-md-12" id="printable_div">
              <!-- title row -->
              <div class="row d-flex justify-content-center">
                <div class="col-12">
                  <h4 class="text-center">
                    <img src="{{asset('logo.png')}}" width="120" alt="">
                  </h4>
                </div>
              </div>
              <div class="row">
                <div class="col-12  d-flex flex-column align-items-center justify-content-between">
                  <h4 class="text h4 text-bold">
                    UNIVERSITY OF DAR ES SALAAM
                  </h4>
                  <h4 class="text text-bold h4">
                    COLLEGE OF INFORMATION AND COMMUNICATION TECHNOLOGIES
                  </h4>
                  <h4 class="text text-bold h4">
                    DEPARTMENT OF COMPUTER SCIENCE AND ENGINEERING
                  </h4>
                  <h4 class="text text-bold h4">
                    STUDENT CLEARANCE FORM
                  </h4>
                </div>
              </div>
              <div class="row invoice-info d-flex flex-row justify-content-between my-4">
                <style>
                    .clear-student-list{
                        list-style: none;
                    }
                    #printable_div{
                        font-family: Georgia, 'Times New Roman', Times, serif;
                    }
                </style>
                <div class="col-sm-8">
                  <ul class="clear-form-student-info">
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Student Name: </strong> <span>{{$clear->clearance->name ?? '-'}} </span></li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Reg Number: </strong><span>{{$clear->clearance->registration_number ?? '-'}}</span></li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Block/Hall Number: </strong> <span>{{$clear->clearance->block_number ?? '-'}}</span> <strong>  Room Number: </strong> <span>{{$clear->clearance->room_number ?? '-'}}</span> </li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Level: </strong> <span>{{$clear->clearance->level ?? '-'}}</span> </li>
                  </ul>
                </div>
                <div class="col-sm-4">
                  <img src="{{ $clear->clearance->student->user->image ? url(\Storage::url($clear->clearance->student->user->image)) : asset('default.png') }}" width="132" height="132" style="margin-left: 120px; margin-top:-20px;" alt="{{$clear->clearance->student->user->image}}">
                </div>
              </div>
              @php 
                $clears = $clear->clearance->clears;
              @endphp
              <div class="row d-flex justify-content-center">
                <div class="col-md-11 table-responsive">
                  <table class="table  table-bordered">
                    <thead>
                    <tr>
                      <th>NAME</th>
                      <th>COMMENT</th>
                      <th>SIGNATURE</th>
                      <th>DATE</th>
                      <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clears as $clear)
                    <tr>
                      <td class="p-4 row-3" >{{ strtoupper($clear->role)  ?? '-'}}</td>
                      <td class="p-4 row-3">{{$clear->comment ?? '-'}}</td>
                      <td class="p-4 row-3">
                        @if($clear->signature == 1)
                        <span class="badge badge-primary">signed</span>
                        @else
                        <span class="badge badge-danger">not signed</span>
                        @endif
                      </td>
                      <td class="p-4 row-3">{{ \Carbon\Carbon::parse($clear->date)->format('d/m/Y') ?? '-' }}</td>
                      <td class="p-4 row-3">
                        @if($clear->status == 1)
                        <span class="badge badge-success">cleared</span>
                        @else
                        <span class="badge badge-danger">not cleared</span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-6">
                  <p>
                    <strong>Your Clearance Status: </strong>
                    @if($clear_role->status == 1)
                    <span class="badge badge-success">cleared</span>
                    <span class="badge badge-success">signed</span>
                    @else
                    <span class="badge badge-danger">not cleared</span>
                    @endif
                  </p>
                </div>
                <div class="col-5">
                    @if($clear_role->status == 0)
                    <form action="{{route('clears.update', $clear_role)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="clearance_id" value="{{$clear_role->clearance_id}}" >
                    <input type="hidden" name="role" value="{{$clear_role->role}}" >
                    <input type="hidden" name="user_id" value="{{$clear_role->user_id}}" >
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                    <label>signature</label>
                    <select name="signature" class="form-control" style="width: 100%;">
                        <option value="0" {{ old('signature', $clear_role->signature) == 0 ? 'selected' : '' }}>Not signed</option>
                        <option value="1" {{ old('signature', $clear_role->signature) == 1 ? 'selected' : '' }}>Signed</option>
                    </select>

                    </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                    <label>Clear status</label>
                        <select name="status" class="form-control" style="width: 100%;">
                            <option value="0" {{ old('status', $clear_role->status) == 0 ? 'selected' : '' }}>Not Cleared</option>
                            <option value="1" {{ old('status', $clear_role->status) == 1 ? 'selected' : '' }}>Cleared</option>
                    </select>
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Comment</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Enter ...">
                            {{old('comment',$clear_role->comment)}}
                        </textarea>
                      </div>
                    </div>
                    <div class="no_print col-sm-6 d-flex justify-content-end align-items-end">
                      <div class="form-group">
                        <button type="submit" class="btn btn-danger" >clear</button>
                      </div>
                    </div>
                  </div>



                
                </form>
                @endif
                </div>
              </div>
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="no_print btn btn-primary float-right" id="print_button" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Download Pdf
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
        </div>
</div>

 <script>
   $(document).ready(function() {
      $('#print_button').click(function() {
        // Clone the printable div and remove elements with no_print class
        var printContents = $('#printable_div').clone();
        printContents.find('.no_print').remove();

        var originalContents = $('body').html();

        $('body').empty().append(printContents);
        window.print();
        $('body').html(originalContents);
      });
    });
  </script>
@endsection
