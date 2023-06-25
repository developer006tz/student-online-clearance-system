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
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Once you clear This student you can't undo it.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="printable_div">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="{{asset('logo.png')}}" width="120" alt="">
                    UDSM  STUDENT CLEARANCE FORM
                  </h4>
                </div>
              </div>
              <div class="row invoice-info d-flex flex-row justify-content-between">
                <div class="col-sm-4">
                  <address>
                    <strong>Student Name: {{$clear->clearance->name ?? '-'}} </strong><br>
                    <strong>Reg Number: </strong>{{$clear->clearance->registration_number ?? '-'}}<br>
                    <strong>Class Level: </strong>{{$clear->clearance->level ?? '-'}}<br>
                    <strong>Block Number: </strong>{{$clear->clearance->block_number ?? '-'}}<br>
                    <strong>Room Number: </strong>{{$clear->clearance->room_number ?? '-'}} 
                  </address>
                </div>
                <div class="col-sm-4">
                  <img src="{{ $clear->clearance->student->user->image ? url(\Storage::url($clear->clearance->student->user->image)) : asset('default.png') }}" width="150" height="150" style="margin-left: 120px; margin-top:-30px;" alt="{{$clear->clearance->student->user->image}}">
                </div>
              </div>
              @php 
                $clears = $clear->clearance->clears;
              @endphp
              <div class="row my-2">
                <div class="col-12">
                    <div class="h5 text-center" style="text-transform: capitalize;">Clearance Form For Student {{$clear->clearance->name}} </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>role</th>
                      <th>comment</th>
                      <th>signature</th>
                      <th>date</th>
                      <th>status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clears as $clear)
                    <tr>
                      <td>{{$clear->role ?? '-'}}</td>
                      <td>{{$clear->comment ?? '-'}}</td>
                      <td>
                        @if($clear->signature == 1)
                        <span class="badge badge-primary">signed</span>
                        @else
                        <span class="badge badge-danger">not signed</span>
                        @endif
                      </td>
                      <td>{{$clear->date ?? '-'}}</td>
                      <td>
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
              <div class="row">
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
                <div class="col-6">
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
          </div><!-- /.col -->
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
