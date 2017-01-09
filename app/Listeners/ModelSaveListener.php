<?php

namespace App\Listeners;

use App\Traits\RevisionsTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModelSaveListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle($model)
    {
        if ($model->id == null) {
            return;
        }
        $traits = class_uses_recursive(get_class($model));
        $shouldLogChanges = array_key_exists(RevisionsTrait::class, $traits);

        if ($shouldLogChanges) {
            $dirty = $model->getDirty();
            $original = $model->getOriginal();
            foreach ($original as $key => $item) {
                if (!array_key_exists($key, $dirty)) {
                    unset($original[$key]);
                }
            }
            if ($dirty != []) {
                $model->revisions()->create([
                    'changedFrom' => $original,
                    'changedTo' => $dirty,
                    'keys' => array_keys($dirty),
                    'made_by_id' => auth()->id()
                ]);
            }
        }
    }

}
