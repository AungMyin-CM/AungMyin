<?php

namespace App\Console\Commands;

use App\Models\Patient;
use Illuminate\Console\Command;
use Elastic\Elasticsearch\ClientBuilder;

class IndexExistingPatients extends Command
{
    protected $signature = 'index:existing-patients';
    protected $description = 'Index existing patients in Elasticsearch';

    public function handle()
    {
        $client = ClientBuilder::create()->setBasicAuthentication('elastic','lEr2fYII__No_eKik3_G')->build();
        $indexName = 'patients';

        $params = [
            'index' => $indexName,
            'body' => [
                'mappings' => [
                    'properties' => [
                        'status' => [
                            'type' => 'keyword',
                        ],
                        'clinic_code' => [
                            'type' => 'keyword',
                        ],
                    ],
                ],
            ],
        ];


        $indexExists = $client->indices()->exists(['index' => $indexName]);

        if (!$indexExists) {
            $client->indices()->create($params);
            $this->info("Index created: $indexName");
        }

        $patients = Patient::all();

        $params = ['body' => []];

        foreach ($patients as $patient) {
            $params['body'][] = [
                'index' => [
                    '_index' => $indexName,
                    '_id' => $patient->id,
                ],
            ];

            $params['body'][] = $patient->toArray();
        }

        $client->bulk($params);

        $this->info('Indexing completed.');
    }
}

