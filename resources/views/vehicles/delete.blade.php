<div class="container">
    <h2 class="text-center">Are you sure?</h2>
    <form action="{{route('vehicles-delete', ['id' => $vehicle->id])}}" method="POST">
        @method('DELETE')
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
            <div class="card-header bg-danger text-white"><strong>Chassis ID</strong></div>
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
            <div class="card-header bg-danger text-white"><strong>Characteristics</strong></div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="typeBus">Type</label>
                        <div>
                            <i class="fas fa-{{strtolower($vehicle->type)}}"></i> {{$vehicle->type}}
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="numberOfPassengers">Number of Passengers</label>
                        <div>{{$vehicle->number_passengers}}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="color">Color</label>
                        <label class="badge" style="background-color: {{$vehicle->color}}">&nbsp;</label>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger right-sidebar-close mt-5" data-toggle="tooltip" data-placement="top"
                title="Close">Cancel
        </button>
        <button type="submit" class="btn btn-primary mt-5">Delete</button>
    </form>
</div>

