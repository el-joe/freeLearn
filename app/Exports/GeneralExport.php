<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class GeneralExport implements FromCollection
{

    protected $_data;

    public function __construct($_data)
    {
        $this->_data = $_data;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->_data;
    }
}
