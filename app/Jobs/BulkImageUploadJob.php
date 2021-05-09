<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class BulkImageUploadJob implements ShouldQueue,Serialize
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Serializable;

    private $images;



    public function __construct($array )
    {

        $this->images=$array;

    }


    public function handle()
    {
        dd($this->files);
    }

}

