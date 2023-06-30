@extends('auth.auth_layout')
@section('content')
    
 <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label>Name<span class="login-danger">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email <span class="login-danger">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span class="profile-views"><i class="fas fa-envelope"></i></span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Role <span class="login-danger">*</span></label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                    <option value="">__select role__</option>
                                    <option value="student">Student</option>
                                    <option value="hall-wadern">Hall Wadern/Usab</option>
                                    <option value="librarian-udsm">Librarian-udsm</option>
                                    <option value="librarian-cse">Librarian-cse</option>
                                    <option value="coordinator">Coordinator</option>
                                    <option value="principal">Principal</option>
                                    <option value="smart-card">Smart Card</option>
                                </select>
                                <span class="profile-views"><i class="fas fa-user"></i></span>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block" type="submit">Register</button>
                            </div>
                        </form>

@endsection