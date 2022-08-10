<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleCreateRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
{
    /**
     * Controller con la información de los vehículos.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Método para listar los informes de los vehículos.
     *
     * @return View
     * @author Santiago Echeverri
     */
    public function index(): View
    {
        $vehicles = Vehicle::select('id', 'plate', 'brand', 'owner_id', 'driver_id')
            ->with(['owner', 'driver'])
            ->orderBy('id', 'DESC')
            ->get();

        return view('informes', [
            'vehicles' => $vehicles
        ]);
    }
    
    /**
     * Método para visualizar un vehículo.
     *
     * @param int $id
     * @return Vehicle
     * @author Santiago Echeverri
     */
    public function show(int $id): Vehicle
    {
        $vehicle = Vehicle::select('plate', 'brand', 'color', 'type', 'owner_id', 'driver_id')
            ->where('id', $id)
            ->with(['owner', 'driver'])
            ->first();

        return $vehicle;
    }

    /**
     * Método para actualizar la información de un vehículo.
     *
     * @param Vehicle $vehicle
     * @param VehicleUpdateRequest $request
     * @return Redirect
     * @author Santiago Echeverri
     */
    public function update(Vehicle $vehicle, VehicleUpdateRequest $request)
    {
        try {
            $vehicle->update($request->all());

            return redirect()->back()->with('message', [
                'text' => 'La información del vehículo ha sido actualizada!',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('message', [
                'text' => 'Ha habido un error al actualizar la información del vehículo',
                'type' => 'danger'
            ]);
        }
    }

    /**
     * Método para registrar la información de un vehículo.
     *
     * @param VehicleUpdateRequest $request
     * @return Redirect
     * @author Santiago Echeverri
     */
    public function store(VehicleCreateRequest $request)
    {
        try {
            Vehicle::create($request->all());

            return redirect()->back()->with('message', [
                'text' => 'La información del vehículo ha sido registrada!',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('message', [
                'text' => 'Ha habido un error al registrar el vehículo',
                'type' => 'danger'
            ]);
        }
    }

    /**
     * Método para eliminar un vehículo.
     *
     * @param Vehicle $vehicle
     * @return Redirect
     * @author Santiago Echeverri
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();

            return redirect()->back()->with('message', [
                'text' => 'El vehículo ha sido eliminado!',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('message', [
                'text' => 'Ha habido un error al eliminar el vehículo',
                'type' => 'danger'
            ]);
        }
    }
}
