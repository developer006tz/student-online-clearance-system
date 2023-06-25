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
                @can('create', App\Models\Clear::class)
                <a href="{{ route('clears.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.clears.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                Student Name
                            </th>
                            <th class="text-left">
                                Registration number
                            </th>
                            <th class="text-left">
                                Level
                            </th>
                            <th class="text-left">
                                Block Number
                            </th>
                            <th class="text-left">
                                Room Number
                            </th>
                            <th class="text-left">
                                date Requested
                            </th>
                            <th class="text-left">
                                status
                            </th>
                            <th class="text-center">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clears as $clear)
                        <tr>
                            <td>
                                {{ optional($clear->clearance)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($clear->clearance)->registration_number ?? '-' }}
                            </td>
                            <td>{{ $clear->clearance->level ?? '-' }}</td>
                            <td>{{ $clear->clearance->block_number ?? '-' }}</td>
                            <td>{{ $clear->clearance->room_number ?? '-' }}</td>
                            <td>{{ $clear->clearance->created_at ?? '-' }}</td>
                            <td>{!! $clear->status == '0' ? '<button class="btn btn-secondary">not-cleared</button>' : '<button class="btn btn-success">cleared</button>' !!}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $clear)
                                    <a
                                        href="{{ route('clears.edit', $clear) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                        >
                                            <i class="icon ion-md-create"></i>clear
                                        </button>
                                    </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                               no item found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">{!! $clears->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
