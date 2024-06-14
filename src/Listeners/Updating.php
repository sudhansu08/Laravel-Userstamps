<?php

namespace Wildside\Userstamps\Listeners;

use Filament\Facades\Filament;

class Updating
{
    /**
     * When the model is being updated.
     *
     * @param  Illuminate\Database\Eloquent  $model
     * @return void
     */
    public function handle($model)
    {
        if (! $model->isUserstamping() || is_null($model->getUpdatedByColumn()) || is_null(Filament::auth()->user()->id)) {
            return;
        }

        $model->{$model->getUpdatedByColumn()} = Filament::auth()->user()->id;
    }
}
