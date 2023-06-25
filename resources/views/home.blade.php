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
@include('dashboards.super-admin')
@else

@include('dashboards.clearer-dashboard')

@endif 
@endif
@endauth
    
@endsection
