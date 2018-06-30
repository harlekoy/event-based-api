<?php

namespace Harlekoy\Http\Controllers;

use Harlekoy\Traits\ControllerEvents;
use Harlekoy\Traits\ControllerRoutes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        ControllerRoutes, ControllerEvents;

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

        $this->pre($request, $model);
    }

    /**
     * Trigger events after the current route is finish.
     */
    public function __destruct()
    {
        $request = app(Request::class);
        $model = app(Model::class);

        $this->post($request, $model);
    }
}
