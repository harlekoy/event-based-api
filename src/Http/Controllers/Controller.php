<?php

namespace Harlekoy\Http\Controllers;

use Harlekoy\Traits\ApiRoutes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        ApiRoutes;

    /**
     * Get resource record.
     *
     * @param  Request $request
     * @param  Model $model
     *
     * @return Model
     */
    public function record($request, $model)
    {
        $id = head($request->route()->parameters());

        if ($id && $model->find($id)) {
            $model = $model->find($id);
        }

        return $model;
    }

    /**
     * Event based constructor.
     *
     * @param Request $request
     *
     * @param Model   $model
     */
    public function __construct(Request $request, Model $model)
    {
        app()->instance(Request::class, $request);
        app()->instance(Model::class, $model = $this->record($request, $model));

        switch ($request->method()) {
            case 'POST':
                $this->triggerEvent('creating', $request, $model);
                $this->triggerEvent('saving', $request, $model);
                break;
            case 'PATCH':
                $this->triggerEvent('updating', $request, $model);
                $this->triggerEvent('saving', $request, $model);
                break;
            case 'DELETE':
                $this->triggerEvent('deleting', $request, $model);
                break;
        }
    }

    /**
     * Trigger events after the current route is finish.
     */
    public function __destruct()
    {
        $request = app(Request::class);
        $model = app(Model::class);

        switch ($request->method()) {
            case 'POST':
                $this->triggerEvent('created', $request, $model);
                $this->triggerEvent('saved', $request, $model);
                break;
            case 'PATCH':
                $this->triggerEvent('updated', $request, $model);
                $this->triggerEvent('saved', $request, $model);
                break;
            case 'DELETE':
                $this->triggerEvent('deleted', $request, $model);
                break;
        }
    }

    /**
     * Trigger event.
     *
     * @param  string $event
     * @param  Request $request
     * @param  Model $model
     *
     * @return void
     */
    protected function triggerEvent($event, $request, $model)
    {
        if (method_exists($this, $event)) {
            $this->$event($request, $model);
        }
    }
}
