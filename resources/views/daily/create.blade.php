{{-- {{ Form::open(['url' => 'daily', 'method' => 'post']) }} --}}
@extends('layouts.admin')

{{-- @section('page-title')
   {{ __('Manage Daily') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Daily Activity') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('employee.export') }}" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-original-title="{{ __('Export') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-file-export"></i>
    </a>

    <a href="#" data-url="{{ route('employee.file.import') }}" data-ajax-popup="true"
        data-title="{{ __('Import  employee CSV file') }}" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
        data-bs-original-title="{{ __('Import') }}">
        <i class="ti ti-file"></i>
    </a>
    @can('Create Employee')
        <a href="{{ route('daily.create') }}" 
            data-title="{{ __('Create New Employee') }}" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <h5></h5> --}}
                <div class="card">
                 <div class = "card-header">Tambah Data Daily</div>
                 <div class = "card-body">
                 <form method = "post" action="{{ route('insertdata') }}" enctype="multipart/form-data"><div class = "form-group row">
                    @csrf 
                    <div class="form-group">
                        <div class="form-group">
                            {{ Form::label('employee_id', __('ID Employee'), ['class' => 'col-form-label']) }}
                            {{ Form::text('employee_id', null, ['class' => 'form-control', 'placeholder' => __('Input ID')]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('activity', __('Activity'), ['class' => 'col-form-label']) }}
                            {{ Form::textarea('activity', null, ['class' => 'form-control', 'placeholder' => __('Input Activity')]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('progress', __('Progress'), ['class' => 'col-form-label']) }}
                            {{ Form::textarea('progress', null, ['class' => 'form-control', 'placeholder' => __('Input Progress')]) }}
                        </div>
                    <div class="modal-footer">
                        {{-- <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal"> --}}
                        <input type="submit"  class="btn  btn-primary">
                    
                    </div>
                    
                    </div>
                </div></form>
                 </div>
                </div>
            </div>
        </div>
    </div>

                        {{-- <tbody>
                            @foreach ($daily as $dailys)
                                <tr>
                                    <td>
                                        @can('Show Employee')
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                        @else
                                            <a href="#" class="btn btn-outline-primary">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                        @endcan
                                    </td>
                                    <td>{{ $dailys->activity }}</td>
                                    <td>{{ $dailys->progress }}</td>
                                    {{-- <td> --}}
                                        {{-- {{ !empty(\Auth::user()->getBranch($employee->branch_id)) ? \Auth::user()->getBranch($employee->branch_id)->name : '' }}
                                    </td>
                                    <td>
                                        {{ !empty(\Auth::user()->getDepartment($employee->department_id)) ? \Auth::user()->getDepartment($employee->department_id)->name : '' }}
                                    </td>
                                    <td>
                                        {{ !empty(\Auth::user()->getDesignation($employee->designation_id)) ? \Auth::user()->getDesignation($employee->designation_id)->name : '' }}
                                    </td>
                                    <td>
                                        {{ \Auth::user()->dateFormat($employee->company_doj) }}
                                    </td> --}}
                                    {{-- @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                        <td class="Action">
                                            @if ($dailys->is_active == 1)
                                                <span>
                                                    @can('Edit Activity')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('activity.edit', \Illuminate\Support\Facades\Crypt::encrypt($dailys->id)) }}"
                                                                class="mx-3 btn btn-sm  align-items-center"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan

                                                    @can('Delete Employee')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['daily.destroy', $dailys->id], 'id' => 'delete-form-' . $dailys->id]) !!}
                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="Delete" aria-label="Delete"><i
                                                                    class="ti ti-trash text-white text-white"></i></a>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                </span>
                                            @else
                                                <i class="ti ti-lock"></i>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="row"> --}}
        {{-- <div class="col-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Employee ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Branch') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Designation') }}</th>
                                    <th>{{ __('Date Of Joining') }}</th>
                                    @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                        <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>
                                            @can('Show Employee')
                                                <a
                                                    href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                            @else
                                                <a href="#">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                            @endcan
                                        </td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>
                                            {{ !empty(\Auth::user()->getBranch($employee->branch_id)) ? \Auth::user()->getBranch($employee->branch_id)->name : '' }}
                                        </td>
                                        <td>
                                            {{ !empty(\Auth::user()->getDepartment($employee->department_id)) ? \Auth::user()->getDepartment($employee->department_id)->name : '' }}
                                        </td>
                                        <td>
                                            {{ !empty(\Auth::user()->getDesignation($employee->designation_id)) ? \Auth::user()->getDesignation($employee->designation_id)->name : '' }}
                                        </td>
                                        <td>
                                            {{ \Auth::user()->dateFormat($employee->company_doj) }}</td>
                                        @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                            <td class="d-flex">
                                                @if ($employee->is_active == 1)
                                                    @can('Edit Employee')
                                                        <a href="{{ route('employee.edit', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}"
                                                            class="action-btn btn-primary me-1 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="{{ __('Edit') }}"><i class="ti ti-pencil"></i></a>
                                                    @endcan
                                                    @can('Delete Employee')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['employee.destroy', $employee->id], 'id' => 'delete-form-' . $employee->id]) !!}
                                                        <a href="#!"
                                                            class="action-btn btn-danger me-1 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="{{ __('Delete') }}">
                                                            <i class="ti ti-trash"></i></a>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                @else
                                                    <i class="fas fa-lock"></i>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
{{-- {{ Form::close() }} --}}


