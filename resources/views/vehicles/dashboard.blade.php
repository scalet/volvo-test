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
                            <div class="round round-lg align-self-center round-info"><i class="fas fa-3x fa-car fa-inverse"></i>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Vehicles</h2>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('vehicles-create')}}" class="btn btn-primary">
                                    <i class="fas fa-inverse fa-2x fa-plus-circle"></i>
                                    Add Vehicle
                                </a>
                            </div>

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
                                                <td>
                                                    <div style="width: 70%; background-color: {{$vehicle->color}};">
                                                        &nbsp;
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-secondary btn-sm btn-change-color">
                                                        <i class="fas fa-brush"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert-info">This fleet of vehicles is empty. =(</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CHART --}}
            <div class="col-md-6 mt-3 text-center">
                <div class="card">
                    <div class="card-body">
                        <h2>Total of Vehicles</h2>
                        <div class="ct-chart" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
