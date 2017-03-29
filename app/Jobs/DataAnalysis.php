<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Data;
class DataAnalysis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $filename;
    protected $user_id;
    public function __construct($filename,$user_id)
    {
        //
        $this->filename = $filename;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        //echo $this->filename;
        $f = New Data;
        $f->user_id = $this->user_id;
        $f->file = $this->filename;
        $f->results = 'test';
        $f->save();
        echo "Done";
    }
}
