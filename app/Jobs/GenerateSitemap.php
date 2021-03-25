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

    public function __construct()
    {
        $this->service = app(SitemapService::class);
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
