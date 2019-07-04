<?php

namespace App\Http\Controllers;

use App\Vehicles;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    const NUMBER_OF_PASSENGERS = ['BUS' => 42, 'CAR' => 4, 'TRUCK' => 1];
    const COLORS = ['#800000' => 'Red', '#cccccc' => 'Silver', '#262626' => 'Black', '#F1F1F1' => 'White', '#000066' => 'Blue', '#666666' => 'Grey'];
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard of vehicles
    */
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

        return view('vehicles.dashboard', ['dashboardInformation' => $dasboardInformation, 'colors' => self::COLORS]);
    }

    public function create (Request $request)
    {

        if ($request->isMethod('get')) {
            return view('vehicles.create', ['number_passengers' => self::NUMBER_OF_PASSENGERS, 'colors' => self::COLORS]);

        } else if ($request->isMethod('post')) {

            //validate the data
            $this->validate($request, [
                'chassisSeries' => 'required|regex:/[a-zA-Z0-9\s]+/|min:3|max:11',
                'chassisNumber' => 'required|numeric|min:6|max:999999',
                'type' => 'required:BUS,CAR,TRUCK',
                'color' => 'required|regex:/#[a-zA-Z0-9]{6}/'
            ]);

            //Creating the Chassis ID insert rule
            $chassisID = trim($request->input('chassisSeries')) . $request->input('chassisNumber');

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
                return redirect('/vehicles/dashboard')->with('success', 'Vehicle created with success!');
            } else {
                return redirect('/vehicles/dashboard')->withErrors(['Chassis ID already exists.'])->withInput();
            }
        }
    }

    public function setColor (int $vehicle_id, Request $request)
    {
        if ($request->isMethod('get')) {
            $vehicle = Vehicles::find($vehicle_id);

            $vehicle->chassisSeries = substr($vehicle->chassis_id, 0, 11);
            $vehicle->chassisNumber = substr($vehicle->chassis_id, -6);

            return view('vehicles.set-color', ['vehicle' => $vehicle, 'colors' => self::COLORS]);
        } else if ($request->isMethod('patch')) {

            $this->validate($request, [
                'color' => 'required|regex:/#[a-zA-Z0-9]{6}/'
            ]);

            $update = $this->updateColor($vehicle_id, $request->input('color'));

            if ($update) {
                return redirect('/vehicles/dashboard')->with('success', 'Vehicle updated with success!');
            } else {
                return redirect()->route('vehicles-create')->withErrors(['Error on update vehicle.'])->withInput();
            }

        }
    }

    public function confirmDelete (int $vehicle_id)
    {
        $vehicle = Vehicles::find($vehicle_id);

        $vehicle->chassisSeries = substr($vehicle->chassis_id, 0, 11);
        $vehicle->chassisNumber = substr($vehicle->chassis_id, -6);

        return view('vehicles.delete', ['vehicle' => $vehicle, 'colors' => self::COLORS]);
    }

    public function remove (int $vehicle_id)
    {
        if ($this->delete($vehicle_id)) {
            return redirect('/vehicles/dashboard')->with('success', 'Vehicle removed!');
        } else {
            return redirect()->route('vehicles-dashboard')->withErrors(['Error on delete the vehicle.']);
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

    private function delete ($vehicle_id)
    {
        $flight = Vehicles::find($vehicle_id);
        return $flight->delete();
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

    private function updateColor ($vehicle_id, $newColor)
    {
        $vehicle = Vehicles::find($vehicle_id);
        $vehicle->color = $newColor;
        return $vehicle->save();
    }
}
