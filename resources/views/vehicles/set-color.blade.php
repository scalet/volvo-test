<div class="container">
    <h2>Vehicle details</h2>
    <form action="{{route('vehicles-update', ['id' => $vehicle->id])}}" method="post">
        @method('PATCH')
        @csrf
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
            <div class="card-header bg-primary text-white"><strong>Chassis ID</strong></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="chassisSeries">Series</label>
                        <div>{{$vehicle->chassisSeries}}</div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="chassisNumber">Number</label>
                        <div>{{$vehicle->chassisNumber}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-primary text-white"><strong>Characteristics</strong></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="typeBus">Type</label>
                        <div>
                            <i class="fas fa-{{$vehicle->type}}"></i> {{$vehicle->type}}
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="numberOfPassengers">Number of Passengers</label>
                        <div>{{$vehicle->number_passengers}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        @component('vehicles.form.colors', ['colors' => $colors, 'colorSelected' => $vehicle->color])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger right-sidebar-close mt-5" data-toggle="tooltip" data-placement="top"
                title="Close">Cancel
        </button>
        <button type="submit" class="btn btn-primary mt-5">Save changes</button>
    </form>
</div>

