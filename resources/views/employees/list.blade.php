@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                @include('employees.create')
                <hr>
                <h1>User list</h1>
                <div class="mt-3">
                    @foreach($employees as $employee)
                        <div class="card">
                            <div class="d-flex align-items-center gap-3 px-3 ">
                                Username:
                                <h3 style="font-weight: bold">
                                    {{ $employee->username }}
                                </h3>
                            </div>
                            <div class="d-flex align-items-center gap-3 px-3 ">
                                Name:
                                <h3 style="font-weight: bold">
                                    {{ $employee->name }}
                                </h3>
                            </div>
                            <div class="d-flex align-items-center gap-3 px-3 ">
                                Email:
                                <h3 style="font-weight: bold">
                                    {{ $employee->email }}
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($employees->isNotEmpty())
                    {{ $employees->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
        </div>
    </div>
@endsection