<?php

namespace App\Http\Controllers;

use App\Vehicles;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    const NUMBER_OF_PASSENGERS = ['BUS' => 42, 'CAR' => 4, 'TRUCK' => 1];
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $vehicles = Vehicles::all();

        $dasboardInformation = New \stdClass();
        $dasboardInformation->totBuses = 0;
        $dasboardInformation->totCars = 0;
        $dasboardInformation->totTrucks = 0;
        $dasboardInformation->vehicles = [];

        //split the totals by type
        if (count($vehicles) > 0) {
           foreach ($vehicles as $vehicle) {
               $dasboardInformation->vehicles[] = $vehicle;
               switch ($vehicle->type) {
                   case 'BUS':
                       $dasboardInformation->totBuses++;
                       break;
                   case 'CAR':
                       $dasboardInformation->totCars++;
                       break;
                   case 'TRUCK':
                       $dasboardInformation->totTrucks++;
                       break;
               }
           }
        }

        //total vehicles
        $dasboardInformation->totVehicles = $dasboardInformation->totBuses + $dasboardInformation->totCars + $dasboardInformation->totTrucks;

        return view('vehicles.dashboard', ['dashboardInformation' => $dasboardInformation]);
    }

    public function create (Request $request)
    {

        if ($request->isMethod('get')) {
            return view('vehicles.create');

        } else if ($request->isMethod('post')) {

            //validate the data
            $this->validate($request, [
                'chassisSeries' => 'required|regex:/[a-zA-Z0-9\s]+/|min:11|max:11',
                'chassisNumber' => 'required|numeric|min:6|max:999999',
                'type' => 'required:BUS,CAR,TRUCK',
                'color' => 'required|regex:/#[a-zA-Z0-9]{6}/'
            ]);

            //Creating the Chassis ID insert rule
            $chassisID = $request->input('chassisSeries') . $request->input('chassisNumber');

            //get the number of passengers
            $numberOfPassengers = array_key_exists($request->input('type'), self::NUMBER_OF_PASSENGERS);
            if ($numberOfPassengers) {
                $numberOfPassengers = self::NUMBER_OF_PASSENGERS[$request->input('type')];
            }

            $newVehicle = new \stdClass();
            $newVehicle->chassisID = $chassisID;
            $newVehicle->type = $request->input('type');
            $newVehicle->number_passengers = $numberOfPassengers;
            $newVehicle->color = $request->input('color');

            $insert =$this->insert($newVehicle);
            if ($insert) {
                return redirect('/vehicles/dashboard');
            } else {
                return redirect()->route('vehicles-create')->withErrors(['Chassis ID already exists.'])->withInput();
            }
        }
    }

    private static function checkChassisID ($chassisID)
    {
        $vehicles = Vehicles::where('chassis_id', $chassisID)->get();
        if (count($vehicles) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function insert ($fields)
    {
        //IF chassis existes return false
        if (self::checkChassisID($fields->chassisID)) {
            return false;
        }

        $vehicles = new Vehicles();
        $vehicles->chassis_id = $fields->chassisID;
        $vehicles->type = $fields->type;
        $vehicles->number_passengers = $fields->number_passengers;
        $vehicles->color = $fields->color;
        return $vehicles->save();
    }
}
