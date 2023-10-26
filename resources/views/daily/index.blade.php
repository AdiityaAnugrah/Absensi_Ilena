
@extends('layouts.admin')

@section('page-title')
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
@endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                {{-- <h5></h5> --}}
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('Employee ID') }}</th>
                                <th>{{ __('Activity') }}</th>
                                <th>{{ __('Progress') }}</th>
                                <th width="200px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dailys)
                            <tr>
                                <td>{{ $dailys['employee_id'] }}</td>
                            <td>{{ $dailys['activity'] }}</td>
                            <td>{{ $dailys['progress'] }}</td>
                            <td>
                                <button type="button" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-success">Delelete</button>
                            </td>
                            </tr>
                            
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
