<?php

namespace Wildside\Userstamps\Listeners;

use Filament\Facades\Filament;

class Deleting
{
    /**
     * When the model is being deleted.
     *
     * @param  Illuminate\Database\Eloquent  $model
     * @return void
     */
    public function handle($model)
    {
        if (! $model->isUserstamping() || is_null($model->getDeletedByColumn())) {
            return;
        }

        if (is_null($model->{$model->getDeletedByColumn()})) {
            $model->{$model->getDeletedByColumn()} = Filament::auth()->user()->id;
        }

        $dispatcher = $model->getEventDispatcher();

        $model->unsetEventDispatcher();

        $model->save();

        $model->setEventDispatcher($dispatcher);
    }
}
