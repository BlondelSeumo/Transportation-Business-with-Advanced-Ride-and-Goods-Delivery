<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Base\Constants\Masters\DriverNeededDocument as DriverNeededDocumentSlug;
use App\Models\Admin\DriverNeededDocument;

class DriverNeededDocumentSeeder extends Seeder
{
    /**
     * List of all the documents to be created along with their details.
     *
     * @var array
     */
    protected $documents = [
        DriverNeededDocumentSlug::DOCUMENTONE=>[
            'doc_type'=>'image',
            'has_identify_number'=>true,
            'identify_number_locale_key'=>'identification number', //if id number true
            'has_expiry_date'=>true,
            'active'=>true,
        ],
        DriverNeededDocumentSlug::DOCUMENTTWO=>[
            'doc_type'=>'image',
            'has_identify_number'=>false,
            'has_expiry_date'=>true,
            'active'=>true,
        ],
        DriverNeededDocumentSlug::DOCUMENTTHREE=>[
            'doc_type'=>'image',
            'has_identify_number'=>false,
            'has_expiry_date'=>true,
            'active'=>true,
        ],
         DriverNeededDocumentSlug::DOCUMENTFOUR=>[
            'doc_type'=>'image',
            'has_identify_number'=>false,
            'has_expiry_date'=>true,
            'active'=>true,
        ],
        DriverNeededDocumentSlug::DOCUMENTFIVE=>[
            'doc_type'=>'image',
            'has_identify_number'=>false,
            'has_expiry_date'=>true,
            'active'=>true,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach ($this->documents as $documentSlug => $document) {

                // Create role if it doesn't exist
                $createdDocument = DriverNeededDocument::firstOrCreate(['name' => $documentSlug], $document);
            }
        });
    }
}
