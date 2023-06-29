@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
             <h2 class="text h2">
              Welcome <strong>{{auth()->user()->name}}</strong>
            </h2>
        </div>
    </div>
    <div class="row">


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
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Student Name: </strong> <span>{{$clearance->name ?? '-'}} </span></li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Reg Number: </strong><span>{{$clearance->registration_number ?? '-'}}</span></li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Block/Hall Number: </strong> <span>{{$clearance->block_number ?? '-'}}</span> <strong>  Room Number: </strong> <span>{{$clearance->room_number ?? '-'}}</span> </li>
                    <li class="mb-1 clear-student-list" ><strong class="p-2">Level: </strong> <span>{{$clearance->level ?? '-'}}</span> </li>
                  </ul>
                </div>
                <div class="col-sm-4">
                  <img src="{{ $student->user->image ? url(\Storage::url($student->user->image)) : asset('default.png') }}" width="132" height="132" style="margin-left: 120px; margin-top:-20px;" alt="{{$student->user->image}}">
                </div>
              </div>
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
                        <span class=""> <img src="{{asset('logo.png')}}" width="32" height="34" alt="cleared"> verified</span>
                        @else
                        <span class="badge badge-danger">not signed</span>
                        @endif
                      </td>
                      <td class="p-4 row-3">{{ \Carbon\Carbon::parse($clear->date)->format('d/m/Y') ?? '-' }}</td>
                      <td class="p-4 row-3">
                        @if($clear->status == 1)
                        <span class="print_text_only badge badge-success">cleared</span>
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
              <div class="row d-flex justify-content-center no_print">
                <div class="col-6">
                  <p>
                    <strong>Your Clearance Status: </strong>
                    @if($clearance->completed_clears() == true)
                    <span class="badge badge-success">clearance completed</span>
                    @else
                    <span class="badge badge-danger">on-progress</span>
                    @endif
                  </p>
                </div>
                <div class="col-5"></div>
              </div>
              @if($clearance->completed_clears() == true)
             <div class="row d-flex justify-content-center mt-4">
                <div class="show_certify  col-11"  style="display: none;">
                  <p>
                    I certify that the above named is cleared/not cleared, <br>
                    I recommend that in view of the debts shown above, his/her transcript and certificate should not <br>
                    be withheld/withheld until the debts are recovered.
                  </p>
                  <p>Signature <span>_________________</span>Date <span>________________</span>Official Stamp</p>
                  <p >Head, CSE Department.</p>
                </div>
              </div>
              @endif
              <div class="row no_print">
                <div class="col-12">
                  <button type="button" class="no_print btn btn-primary float-right" id="print_button" style="margin-right: 5px;" @if($clearance->completed_clears() == false) {{__('disabled')}}@endif >
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
        printContents.find('.show_certify').show();
        printContents.find('.print_text_only').removeClass('badge badge-success');

        var originalContents = $('body').html();

        $('body').empty().append(printContents);
        window.print();
        $('body').html(originalContents);
      });
    });
  </script>
@endsection