<?php

namespace Harlekoy\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait ControllerEvents
{
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
     * Pre-events triggering.
     *
     * @param  Request $request
     * @param  Model $model
     * @return void
     */
    public function pre($request, $model)
    {
        $events = array_get(config('controller.pre'), $request->method());

        foreach ($events as $event) {
            $this->triggerEvent($event, $request, $model);
        }
    }

    /**
     * Post-events triggering.
     *
     * @param  Request $request
     * @param  Model $model
     * @return void
     */
    public function post($request, $model)
    {
        $events = array_get(config('controller.post'), $request->method());

        foreach ($events as $event) {
            $this->triggerEvent($event, $request, $model);
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