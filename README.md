# event-based-api

### Sample resource controller event listener
```php
<?php


/**
 * Listen to the resource controller creating event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function creating($request, $model)

/**
 * Listen to the resource controller created event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function created($request, $model)

/**
 * Listen to the resource controller saving event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function saving()

/**
 * Listen to the resource controller saved event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function saved()

/**
 * Listen to the resource controller updating event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function updating()

/**
 * Listen to the resource controller updated event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function updated()

/**
 * Listen to the resource controller deleting event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function deleting()

/**
 * Listen to the resource controller deleted event.
 *
 * @param Request $request
 * @param Model $model
 *
 * @return void
 */
public function deleted()
```
