<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

class ExportProductsToCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(['id', 'Nombre', 'Descripción', 'Precio', 'Stock', 'Categoría']);

        // Procesar los productos en chunks de 1000
        Product::chunk(1000, function ($products) use ($csv) {
            foreach ($products as $product) {
                $csv->insertOne([
                    $product->id,
                    $product->nombre,
                    $product->descripcion,
                    $product->precio,
                    $product->stock,
                    $product->categoria,
                ]);
            }
        });

        // Guardar el archivo CSV en el almacenamiento
        $filename = 'products/products_' . now()->format('Y-m-d_H-i-s') . '.csv';
        Storage::disk('public')->put($filename, $csv->getContent());

        // Opcional: Enviar notificación o guardar el path del archivo en la base de datos
    }
}
