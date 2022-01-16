<?php
namespace App\Imports;

use App\Models\Storage;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class StorageImport implements ToModel {
    public function model(array $row)
    {
        return new Storage();
    }
}
