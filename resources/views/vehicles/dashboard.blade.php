@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css//vehicles/dashboard.css')}}">
@endpush
@push('scripts')
    <script type="text/javascript" src="{{asset('js/vehicles/dashboard.js')}}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Fleet</h1>
            </div>
            @if($message = Session::get('success') || count($errors)>0)
                <div class="col-md-12">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            {{$message}}
                        </div>
                    @endif

                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            @endif

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-danger">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i
                                    class="fas fa-3x fa-bus fa-inverse"></i></div>
                            <div class="ml-5 align-self-center">
                                <h3 id="totBuses" class="text-light text-right">{{$dashboardInformation->totBuses}}</h3>
                                <h5 class="text-white">Total of Buses</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-info">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i
                                    class="fas fa-3x fa-car fa-inverse"></i>
                            </div>
                            <div class="ml-5 align-self-center">
                                <h3 id="totCars" class="text-light text-right">{{$dashboardInformation->totCars}}</h3>
                                <h5 class="text-white">Total of Cars</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-secondary">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i
                                    class="fas fa-3x fa-truck fa-inverse"></i></div>
                            <div class="ml-4 align-self-center">
                                <h3 id="totTrucks"
                                    class="text-light text-right">{{$dashboardInformation->totTrucks}}</h3>
                                <h5 class="text-white">Total of Trucks</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-success">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i
                                    class="fas fa-3x fa-wave-square fa-inverse"></i></div>
                            <div class="ml-2 align-self-center">
                                <h3 id="totVehicles"
                                    class="text-light text-right">{{$dashboardInformation->totVehicles}}</h3>
                                <h5 class="text-white">Total of Vehicles</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        <div class="col-md-6"><h2>Vehicles</h2></div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-success btn-add-vehicle" data-toggle="tooltip"
                                    data-placement="top" title="Add a vehicle">
                                <i class="fas fa-inverse fa-2x fa-plus-circle"></i>
                                Add Vehicle
                            </button>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                @if (count($dashboardInformation->vehicles) > 0)
                                    <table id="fleetTable" class="table" width="100%">
                                        <thead>
                                        <th>Chassis</th>
                                        <th>Type</th>
                                        <th>Start Date</th>
                                        <th>Color</th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($dashboardInformation->vehicles as $vehicle)
                                            <tr>
                                                <td>{{$vehicle->chassis_id}}</td>
                                                <td>
                                                    <i class="fas fa-{{strtolower($vehicle->type)}}"></i> {{ucfirst($vehicle->type)}}
                                                </td>
                                                <td class="text-right">{{$vehicle->created_at}}</td>
                                                <td nowrap="">
                                                    <a href="#" class="btn btn-sm"
                                                       style="background-color: {{$vehicle->color}};">
                                                        &nbsp;
                                                    </a>
                                                    <button class="btn btn-secondary btn-sm btn-change-color"
                                                            data-id="{{$vehicle->id}}" data-toggle="tooltip"
                                                            data-placement="top" title="Set the color">
                                                        <i class="fas fa-brush"></i>
                                                    </button>
                                                </td>
                                                <td>

                                                    <button class="btn btn-danger btn-sm btn-delete"
                                                            data-id="{{$vehicle->id}}" data-toggle="tooltip"
                                                            data-placement="top" title="Delete vehicle">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info">None vehicle found on this fleet.</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CHART --}}
            <div class="col-md-6 mt-3 text-center">
                <div class="card">
                    <div class="card-header"><h2>Vehicles by type</h2></div>
                    <div class="card-body">
                        @if ($dashboardInformation->totVehicles > 0)
                            <div class="ct-chart" style="width: 100%;"></div>
                        @else
                            <div class="alert alert-info">None vehicle found on this fleet.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
