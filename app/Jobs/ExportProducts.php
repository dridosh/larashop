<?php

namespace App\Jobs;

use App\Events\CategoriesExportFinishEvent;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public $exportColumns;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($exportColumns = true)
    {
        $this->exportColumns = $exportColumns;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $products = Product::get()->toArray();
        $file = fopen('exportProducts.csv', 'w');

        if ($this->exportColumns) {
            $columns = [
                'id',
                'name',
                'description',
                'picture',
                'price',
                'category_id',
                'created_at',
                'updated_at'
            ];
            fputcsv($file, $columns, ';');
        }

        foreach ($products as $product) {
            $product['name'] = iconv('utf-8', 'windows-1251//IGNORE', $product['name']);
            $product['description'] = iconv('utf-8', 'windows-1251//IGNORE', $product['description']);
            $product['picture'] = iconv('utf-8', 'windows-1251//IGNORE', $product['picture']);
            $product['price'] = iconv('utf-8', 'windows-1251//IGNORE', $product['price']);
            $product['category_id'] = iconv('utf-8', 'windows-1251//IGNORE', $product['category_id']);
            fputcsv($file, $product, ';');
        }
        fclose($file);

        event(new CategoriesExportFinishEvent('test'));
        CategoriesExportFinishEvent::dispatch('test');
    }
}
