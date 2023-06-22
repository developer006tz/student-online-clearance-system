@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('clears.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.clears.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.clearance_id')</h5>
                    <span>{{ optional($clear->clearance)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.user_id')</h5>
                    <span>{{ optional($clear->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.role')</h5>
                    <span>{{ $clear->role ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.comment')</h5>
                    <span>{{ $clear->comment ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.signature')</h5>
                    <span>{{ $clear->signature ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.date')</h5>
                    <span>{{ $clear->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clears.inputs.status')</h5>
                    <span>{{ $clear->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('clears.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Clear::class)
                <a href="{{ route('clears.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
