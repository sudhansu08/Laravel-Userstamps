<?php

namespace Wildside\Userstamps\Listeners;

use Filament\Facades\Filament;

class Creating
{
    /**
     * When the model is being created.
     *
     * @param  Illuminate\Database\Eloquent  $model
     * @return void
     */
    public function handle($model)
    {
        if (! $model->isUserstamping() || is_null($model->getCreatedByColumn())) {
            return;
        }

        if (is_null($model->{$model->getCreatedByColumn()})) {
            $model->{$model->getCreatedByColumn()} = Filament::auth()->user()->id;
        }

        if (is_null($model->{$model->getUpdatedByColumn()}) && ! is_null($model->getUpdatedByColumn())) {
            $model->{$model->getUpdatedByColumn()} = Filament::auth()->user()->id;
        }
    }
}
