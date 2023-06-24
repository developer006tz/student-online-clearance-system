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

    {{dd($user->student->id)}}
@endisset
