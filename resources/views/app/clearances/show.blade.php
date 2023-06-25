@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('clearances.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.clearances.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.student_id')</h5>
                    <span
                        >{{ optional($clearance->student)->id_number ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.name')</h5>
                    <span>{{ $clearance->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.registration_number')</h5>
                    <span>{{ $clearance->registration_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.block_number')</h5>
                    <span>{{ $clearance->block_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.room_number')</h5>
                    <span>{{ $clearance->room_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.level')</h5>
                    <span>{{ $clearance->level ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.hall-wadern')</h5>
                    <span>{{ $clearance->{'hall-wadern'} ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.librarian-udsm')</h5>
                    <span>{{ $clearance->{'librarian-udsm'} ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.librarian-cse')</h5>
                    <span>{{ $clearance->{'librarian-cse'} ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.coordinator')</h5>
                    <span>{{ $clearance->coordinator ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.principal')</h5>
                    <span>{{ $clearance->principal ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.clearances.inputs.smart-card')</h5>
                    <span>{{ $clearance->{'smart-card'} ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('clearances.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Clearance::class)
                <a
                    href="{{ route('clearances.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
