<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $c = 10 / 0;
        $categories = Category::get()->toArray();
        $file = fopen('exportCategories.csv', 'w');
        $columns = [
            'id',
            'name',
            'description',
            'picture',
            'created_at',
            'updated_at'
        ];
        fputcsv($file, $columns, ';');
        foreach ($categories as $category) {
            $category['name'] = iconv('utf-8', 'windows-1251//IGNORE', $category['name']);
            $category['description'] = iconv('utf-8', 'windows-1251//IGNORE', $category['description']);
            $category['picture'] = iconv('utf-8', 'windows-1251//IGNORE', $category['picture']);
            fputcsv($file, $category, ';');
        }
        fclose($file);
    }
}
