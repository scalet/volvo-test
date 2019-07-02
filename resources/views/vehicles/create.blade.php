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

            <h3>Chassis ID</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="chassisSeries">Series</label>
                    <input type="text" class=" form-control" id="chassisSeries" name="chassisSeries" value="{{old('chassisSeries')}}" placeholder="" maxlength="11" required>
                    <small>Ex. YV1DZ825C2</small>
                </div>

                <div class="form-group col-md-6">
                    <label for="chassisNumber">Number</label>
                    <input type="number" class="form-control" id="chassisNumber" name="chassisNumber" value="{{old('chassisNumber')}}" placeholder="" max="999999" maxlength="6" required>
                    <small>Ex. 271234</small>
                </div>
            </div>

            <h3>Characteristics</h3>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="typeBus">Type</label>
                    <div>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-volvo {{(old('type') == 'BUS') ? 'active' : ''}}">
                            <input type="radio" name="type" id="typeBus" value="BUS" class="radio-type" data-passenger="{{$number_passengers['BUS']}}" autocomplete="off" {{(old('type') == 'BUS') ? 'CHECKED' : ''}}> <i class="fas fa-bus"></i> Bus
                        </label>
                        <label class="btn btn-volvo {{(old('type') == 'CAR') ? 'active' : ''}}">
                            <input type="radio" name="type" id="typeCar" value="CAR" class="radio-type" data-passenger="{{$number_passengers['CAR']}}" autocomplete="off" {{(old('type') == 'CAR') ? 'CHECKED' : ''}}> <i class="fas fa-car"></i> Car
                        </label>
                        <label class="btn btn-volvo {{(old('type') == 'TRUCK') ? 'active' : ''}}">
                            <input type="radio" name="type" id="typeTruck" value="TRUCK" class="radio-type" data-passenger="{{$number_passengers['TRUCK']}}" autocomplete="off" {{(old('type') == 'TRUCK') ? 'CHECKED' : ''}}> <i class="fas fa-truck"></i> Truck
                        </label>
                    </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="numberOfPassengers">Number of Passengers</label>
                    <input type="number" class="form-control" id="numberOfPassengers" name="numberOfPassengers" required readonly="">
                </div>
                <div class="form-group col-md-6">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{old('color')}}" required>
                </div>
            </div>

            <a href="{{route('vehicles-dashboard')}}" class="btn btn-danger mt-5">Cancel</a>
            <button type="submit" class="btn btn-primary mt-5">Create</button>
        </form>
    </div>
{{--@endsection--}}
