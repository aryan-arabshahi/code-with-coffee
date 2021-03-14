<?php

namespace App\Jobs;

use App\Services\SitemapService;
use App\Traits\Logger;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateSitemap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Logger;

    /**
     * @var \App\Services\SitemapService $service
     */
    protected $service;

    /**
     * Create a new job instance.
     * 
     * @param \App\Services\SitemapService $service
     * 
     * @return void
     */
    public function __construct(SitemapService $service)
    {
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->debug('Generating the Sitemap');
        $this->service->generate();
    }
}
