@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Clearance::class)
                <a
                    href="{{ route('clearances.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.clearances.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.student_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.registration_number')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.block_number')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.room_number')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.level')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.hall-wadern')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.librarian-udsm')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.librarian-cse')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.coordinator')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.principal')
                            </th>
                            <th class="text-left">
                                @lang('crud.clearances.inputs.smart-card')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clearances as $clearance)
                        <tr>
                            <td>
                                {{ optional($clearance->student)->id_number ??
                                '-' }}
                            </td>
                            <td>{{ $clearance->name ?? '-' }}</td>
                            <td>
                                {{ $clearance->registration_number ?? '-' }}
                            </td>
                            <td>{{ $clearance->block_number ?? '-' }}</td>
                            <td>{{ $clearance->room_number ?? '-' }}</td>
                            <td>{{ $clearance->level ?? '-' }}</td>
                            <td>{{ $clearance->{'hall-wadern'} ?? '-' }}</td>
                            <td>{{ $clearance->{'librarian-udsm'} ?? '-' }}</td>
                            <td>{{ $clearance->{'librarian-cse'} ?? '-' }}</td>
                            <td>{{ $clearance->coordinator ?? '-' }}</td>
                            <td>{{ $clearance->principal ?? '-' }}</td>
                            <td>{{ $clearance->{'smart-card'} ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $clearance)
                                    <a
                                        href="{{ route('clearances.edit', $clearance) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $clearance)
                                    <a
                                        href="{{ route('clearances.show', $clearance) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $clearance)
                                    <form
                                        action="{{ route('clearances.destroy', $clearance) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="13">{!! $clearances->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
