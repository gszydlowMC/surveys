<?php

namespace App\Services;


use PhpOffice\PhpSpreadsheet\IOFactory;

class SubscriberImportService extends BaseService
{
    public function __construct()
    {

    }

    public function getDataObjectFromXls($input)
    {
        if (strpos($input['files'][0]->getClientOriginalName(), 'xlsx') != false) {
            $reader = IOFactory::createReader('Xlsx');
        } else {
            $reader = IOFactory::createReader('Xls');
        }

        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($input['files'][0]->getPathName());

        $sheets = $spreadsheet->getAllSheets();
        $out = [];
        $out[$sheets[0]->getTitle()] = $sheets[0]->toArray();

        return $out;
    }


}
