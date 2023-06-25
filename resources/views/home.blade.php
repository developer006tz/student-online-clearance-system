@extends('layouts.app')

@section('content')

@auth
@php 
$user = Auth::user();
@endphp
@if($user->hasRole('student'))
@include('dashboards.student')
@else
@if($user->hasRole('super-admin'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> 
@else

@include('dashboards.clearer-dashboard')

@endif 
@endif
@endauth
    
@endsection
