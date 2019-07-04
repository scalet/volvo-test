{{--@extends('layouts.app')--}}

{{--@push('scripts')--}}
{{--<script type="text/javascript" src="{{asset('js/vehicles/create.js')}}"></script>--}}
{{--@endpush--}}

{{--@section('content')--}}

<div class="container">
    <form action="{{route('vehicles-insert')}}" method="post">
        @csrf
        <h2 class="text-center">Vehicle details</h2>

        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-success text-white"><strong>Chassis ID</strong></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="chassisSeries">Series</label>
                        <input type="text" class=" form-control" id="chassisSeries" name="chassisSeries"
                               value="{{old('chassisSeries')}}" placeholder="" maxlength="11" required>
                        <small>Ex. YV1DZ825C2</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="chassisNumber">Number</label>
                        <input type="number" class="form-control" id="chassisNumber" name="chassisNumber"
                               value="{{old('chassisNumber')}}" placeholder="" max="999999" maxlength="6" required>
                        <small>Ex. 271234</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-success text-white"><strong>Characteristics</strong></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="typeBus">Type</label>
                        <div>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-volvo {{(old('type') == 'BUS') ? 'active' : ''}}">
                                    <input type="radio" name="type" id="typeBus" value="BUS" class="radio-type"
                                           data-passenger="{{$number_passengers['BUS']}}"
                                           autocomplete="off" {{(old('type') == 'BUS') ? 'CHECKED' : ''}}> <i
                                        class="fas fa-bus"></i> Bus
                                </label>
                                <label class="btn btn-volvo {{(old('type') == 'CAR') ? 'active' : ''}}">
                                    <input type="radio" name="type" id="typeCar" value="CAR" class="radio-type"
                                           data-passenger="{{$number_passengers['CAR']}}"
                                           autocomplete="off" {{(old('type') == 'CAR') ? 'CHECKED' : ''}}> <i
                                        class="fas fa-car"></i> Car
                                </label>
                                <label class="btn btn-volvo {{(old('type') == 'TRUCK') ? 'active' : ''}}">
                                    <input type="radio" name="type" id="typeTruck" value="TRUCK" class="radio-type"
                                           data-passenger="{{$number_passengers['TRUCK']}}"
                                           autocomplete="off" {{(old('type') == 'TRUCK') ? 'CHECKED' : ''}}> <i
                                        class="fas fa-truck"></i> Truck
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="numberOfPassengers">Number of Passengers</label>
                        <input type="number" class="form-control col-4" id="numberOfPassengers" name="numberOfPassengers"
                               required readonly="">
                    </div>
                    <div class="form-group col-md-12">
                        @component('vehicles.form.colors', ['colors' => $colors, 'colorSelected' => old('color')])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger right-sidebar-close mt-5" data-toggle="tooltip" data-placement="top"
                title="Close">Cancel
        </button>
        <button type="submit" class="btn btn-success btn-create mt-5">Create</button>
    </form>
</div>
{{--@endsection--}}
