<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;
use App\Models\Project;
use App\Models\Church;
use App\Models\Ministry;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function handle()
    {
        $this->info('Generating sitemap...');

        try {
            $sitemap = Sitemap::create();

            // Add static routes
            $this->addStaticRoutes($sitemap);

            // Add dynamic routes
            $this->addDynamicRoutes($sitemap);

            // Write sitemap to public directory
            $sitemap->writeToFile(public_path('sitemap.xml'));

            $this->info('Sitemap generated successfully at: ' . public_path('sitemap.xml'));
            
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('Failed to generate sitemap: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function addStaticRoutes(Sitemap $sitemap)
    {
        $staticRoutes = [
            ['url' => '/', 'priority' => 1.0, 'changefreq' => 'daily'],
            ['url' => '/about', 'priority' => 0.8, 'changefreq' => 'monthly'],
            ['url' => '/contact', 'priority' => 0.7, 'changefreq' => 'yearly'],
            ['url' => '/ministries', 'priority' => 0.9, 'changefreq' => 'weekly'],
            ['url' => '/galleries', 'priority' => 0.6, 'changefreq' => 'monthly'],
            ['url' => '/ministry-events', 'priority' => 0.8, 'changefreq' => 'weekly'],
            ['url' => '/churches', 'priority' => 0.8, 'changefreq' => 'monthly'],
            ['url' => '/sermons', 'priority' => 0.9, 'changefreq' => 'weekly'],
            ['url' => '/donate', 'priority' => 0.7, 'changefreq' => 'yearly'],
            ['url' => '/projects', 'priority' => 0.8, 'changefreq' => 'weekly'],
            ['url' => '/blog', 'priority' => 0.9, 'changefreq' => 'daily'],
            ['url' => '/leadership', 'priority' => 0.7, 'changefreq' => 'monthly'],
            ['url' => '/info-hub', 'priority' => 0.6, 'changefreq' => 'monthly'],
        ];

        foreach ($staticRoutes as $route) {
            $url = Url::create($route['url'])
                ->setLastModificationDate(Carbon::now())
                ->setPriority($route['priority'])
                ->setChangeFrequency($route['changefreq']);

            $sitemap->add($url);
        }

        $this->info('Added ' . count($staticRoutes) . ' static routes');
    }

    private function addDynamicRoutes(Sitemap $sitemap)
    {
        $count = 0;

        // Add blog articles
        if (class_exists(Article::class)) {
            try {
                Article::where('status', 'published')
                    ->chunk(100, function ($articles) use ($sitemap, &$count) {
                        foreach ($articles as $article) {
                            $url = Url::create('/blog/' . $article->slug)
                                ->setLastModificationDate($article->updated_at)
                                ->setPriority(0.8)
                                ->setChangeFrequency('monthly');
                            
                            $sitemap->add($url);
                            $count++;
                        }
                    });
                $this->info('Added blog articles');
            } catch (\Exception $e) {
                $this->warn('Could not add blog articles: ' . $e->getMessage());
            }
        }

        // Add projects
        if (class_exists(Project::class)) {
            try {
                Project::where('status', 'active')
                    ->chunk(100, function ($projects) use ($sitemap, &$count) {
                        foreach ($projects as $project) {
                            $url = Url::create('/project/' . $project->slug)
                                ->setLastModificationDate($project->updated_at)
                                ->setPriority(0.7)
                                ->setChangeFrequency('monthly');
                            
                            $sitemap->add($url);
                            $count++;
                        }
                    });
                $this->info('Added projects');
            } catch (\Exception $e) {
                $this->warn('Could not add projects: ' . $e->getMessage());
            }
        }

        // Add churches
        if (class_exists(Church::class)) {
            try {
                Church::where('is_active', true)
                    ->chunk(100, function ($churches) use ($sitemap, &$count) {
                        foreach ($churches as $church) {
                            $url = Url::create('/churches/' . $church->id)
                                ->setLastModificationDate($church->updated_at)
                                ->setPriority(0.7)
                                ->setChangeFrequency('monthly');
                            
                            $sitemap->add($url);
                            $count++;
                        }
                    });
                $this->info('Added churches');
            } catch (\Exception $e) {
                $this->warn('Could not add churches: ' . $e->getMessage());
            }
        }

        // Add ministries
        if (class_exists(Ministry::class)) {
            try {
                Ministry::where('is_active', true)
                    ->chunk(100, function ($ministries) use ($sitemap, &$count) {
                        foreach ($ministries as $ministry) {
                            $url = Url::create('/ministries/' . $ministry->id)
                                ->setLastModificationDate($ministry->updated_at)
                                ->setPriority(0.7)
                                ->setChangeFrequency('monthly');
                            
                            $sitemap->add($url);
                            $count++;
                        }
                    });
                $this->info('Added ministries');
            } catch (\Exception $e) {
                $this->warn('Could not add ministries: ' . $e->getMessage());
            }
        }

        $this->info('Added ' . $count . ' dynamic routes');
    }
}