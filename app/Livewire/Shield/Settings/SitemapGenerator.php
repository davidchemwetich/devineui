<?php

namespace App\Livewire\Shield\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SitemapGenerator extends Component
{
    public $isGenerating = false;
    public $lastGenerated = null;
    public $sitemapExists = false;
    public $sitemapSize = null;
    public $message = '';
    public $messageType = '';

    public function mount()
    {
        $this->checkSitemapStatus();
    }

    public function generateSitemap()
    {
        $this->isGenerating = true;
        $this->message = '';
        $this->messageType = '';

        try {
            // Call the artisan command to generate sitemap
            Artisan::call('sitemap:generate');
            
            $this->checkSitemapStatus();
            $this->message = 'Sitemap generated successfully!';
            $this->messageType = 'success';
            
            // Log the generation
            Log::info('Sitemap generated successfully by user', [
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);

        } catch (\Exception $e) {
            $this->message = 'Error generating sitemap: ' . $e->getMessage();
            $this->messageType = 'error';
            
            Log::error('Sitemap generation failed', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ]);
        } finally {
            $this->isGenerating = false;
        }
    }

    public function downloadSitemap()
    {
        $sitemapPath = public_path('sitemap.xml');
        
        if (File::exists($sitemapPath)) {
            return response()->download($sitemapPath);
        }
        
        $this->message = 'Sitemap file not found. Please generate it first.';
        $this->messageType = 'error';
    }

    public function checkSitemapStatus()
    {
        $sitemapPath = public_path('sitemap.xml');
        
        if (File::exists($sitemapPath)) {
            $this->sitemapExists = true;
            $this->lastGenerated = Carbon::createFromTimestamp(File::lastModified($sitemapPath));
            $this->sitemapSize = $this->formatBytes(File::size($sitemapPath));
        } else {
            $this->sitemapExists = false;
            $this->lastGenerated = null;
            $this->sitemapSize = null;
        }
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }

    public function render()
    {
        return view('livewire.shield.settings.sitemap-generator');
    }
}