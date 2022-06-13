<?php

namespace App\Jobs;

use App\Mail\petitionReject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPetitionRejectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $petition, $reason;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($petition, $reason)
    {
        $this->petition = $petition;
        $this->reason = $reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->petition->user->email)->send(new petitionReject($this->reason));
    }
}
