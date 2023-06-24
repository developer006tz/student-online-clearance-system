@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('students.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @if(Auth::user()->hasRole('student'))
                Complete your student profile
                @else
                @lang('crud.students.create_title')
                @endif
            </h4>

            <x-form
                method="POST"
                action="{{ route('students.store') }}"
                class="mt-4"
            >
                @include('app.students.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('students.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        submit
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
