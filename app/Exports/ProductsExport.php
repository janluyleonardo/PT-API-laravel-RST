<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, WithChunkReading, WithHeadings
{
    public function query()
    {
        return Product::query();
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headings(): array
    {
        return [
            'id',
            'Nombre',
            'Descripcion',
            'Precio',
            'Stock',
            'Categoria',
        ];
    }
}
