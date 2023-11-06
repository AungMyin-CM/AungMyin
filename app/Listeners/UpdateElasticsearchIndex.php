<?php

namespace App\Listeners;

use App\Events\PatientChanged;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateElasticsearchIndex implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\PatientChanged  $event
     * @return void
     */
    public function handle(PatientChanged $event)
    {
        $patient = $event->patient;
        $indexName = 'patients';

        $client = ClientBuilder::create()->build();

        if ($patient->trashed()) {
            $client->delete([
                'index' => $indexName,
                'id' => $patient->id,
            ]);
        } else {
            $client->index([
                'index' => $indexName,
                'id' => $patient->id,
                'body' => $patient->toArray(),
            ]);
        }
    }
}
