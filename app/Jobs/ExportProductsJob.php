<?php

namespace App\Jobs;

use App\Exports\ProductsExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $filename = 'products/products_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        Excel::store(new ProductsExport, $filename, 'public');
    }
}
