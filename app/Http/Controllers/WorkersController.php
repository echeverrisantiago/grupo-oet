<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerCreateRequest;
use App\Http\Requests\WorkerUpdateRequest;
use App\Models\Vehicle;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkersController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     * @author Santiago Echeverri
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Método para listar los conductores y propietarios de los vehículos.
     *
     * @param int $type
     * @return View
     * @author Santiago Echeverri
     */
    public function index(Request $request)
    {
        $workers = Worker::select('id','identification','first_name','second_name', 'last_name','address','telephone','city')
            ->selectRaw("CASE WHEN second_name IS NULL THEN '' ELSE second_name END AS second_name")
            ->get();

        if (!$request->type) {
            return view('workers', [
                'workers' => $workers
            ]);
        } else {
            return $workers ? $workers : [];
        }
    }

    /**
     * Método para registrar la información de un vehículo.
     *
     * @param VehicleUpdateRequest $request
     * @return Redirect
     * @author Santiago Echeverri
     */
    public function store(WorkerCreateRequest $request)
    {
        try {
            Worker::create($request->all());

            return redirect()->back()->with('message', [
                'text' => 'La información del empleado ha sido registrada!',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('message', [
                'text' => 'Ha habido un error al registrar el empleado',
                'type' => 'danger'
            ]);
        }
    }

    /**
     * Método para visualizar un trabajador.
     *
     * @param int $id
     * @return Worker
     * @author Santiago Echeverri
     */
    public function show(int $id): Worker
    {
        $worker = Worker::select('id','identification','first_name','second_name', 'last_name','address','telephone','city')
            ->where('id', $id)
            ->first();

        return $worker;
    }

    /**
     * Método para actualizar la información de un vehículo.
     *
     * @param Worker $worker
     * @param WorkerUpdateRequest $request
     * @return Redirect
     * @author Santiago Echeverri
     */
    public function update(Worker $worker, WorkerUpdateRequest $request)
    {
        try {
            $worker->update($request->all());

            return redirect()->back()->with('message', [
                'text' => 'La información del empleado ha sido actualizada!',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('message', [
                'text' => 'Ha habido un error al actualizar la información del empleado',
                'type' => 'danger'
            ]);
        }
    }

    /**
     * Método para eliminar un empleado.
     *
     * @param Worker $worker
     * @return Redirect
     * @author Santiago Echeverri
     */
    public function destroy(Worker $worker)
    {
        try {
            $vehicles = Vehicle::select('id')
                ->where('owner_id', $worker->id)
                ->orWhere('driver_id', $worker->id)
                ->get();

            if ($vehicles->count() > 0) {
                return redirect()->back()->with('message', [
                    'text' => 'El empleado conduce o es propietario de ' . $vehicles->count() . ' vehículo(s)',
                    'type' => 'danger'
                ]);
            }

            $worker->delete();

            return redirect()->back()->with('message', [
                'text' => 'El empleado ha sido eliminado!',
                'type' => 'success'
            ]);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('message', [
                'text' => 'Ha habido un error al eliminar el empleado',
                'type' => 'danger'
            ]);
        }
    }
}
