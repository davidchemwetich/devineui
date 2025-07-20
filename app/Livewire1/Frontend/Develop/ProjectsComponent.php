<?php

namespace App\Livewire\Frontend\Develop;

use Livewire\Component;
use Livewire\WithPagination;

class ProjectsComponent extends Component
{
    use WithPagination;

    public $activeTab = 'all';
    public $search = '';
    public $showDetails = null;

    // Demo projects data
    public function getProjects()
    {
        $projects = [
            [
                'id' => 1,
                'title' => 'New Sanctuary Building',
                'category' => 'infrastructure',
                'raised' => 250000,
                'goal' => 500000,
                'end_date' => '2025-12-31',
                'image' => 'sanctuary.jpg',
                'description' => 'Our growing congregation needs more space! This project will fund the construction of a new 500-seat sanctuary with modern amenities to serve our community for years to come.',
                'updates' => [
                    ['date' => '2025-04-15', 'content' => 'Foundation work has begun!'],
                    ['date' => '2025-03-01', 'content' => 'Architectural plans finalized and permits approved.'],
                ],
                'featured' => true,
            ],
            [
                'id' => 2,
                'title' => 'Youth Ministry Expansion',
                'category' => 'programs',
                'raised' => 45000,
                'goal' => 75000,
                'end_date' => '2025-08-30',
                'image' => 'youth.jpg',
                'description' => 'Help us create dedicated spaces and programs for our growing youth ministry, including new recreational equipment, curriculum materials, and leadership training.',
                'updates' => [
                    ['date' => '2025-04-20', 'content' => 'Youth room renovation is 50% complete.'],
                ],
                'featured' => true,
            ],
            [
                'id' => 3,
                'title' => 'Community Food Pantry',
                'category' => 'outreach',
                'raised' => 12000,
                'goal' => 20000,
                'end_date' => '2025-07-15',
                'image' => 'foodpantry.jpg',
                'description' => 'Our food pantry serves over 100 families each month. This project will fund expanded storage, refrigeration, and allow us to increase our distributions.',
                'updates' => [
                    ['date' => '2025-04-10', 'content' => 'New refrigeration units installed.'],
                    ['date' => '2025-03-25', 'content' => 'Partnered with 3 local grocery stores for weekly donations.'],
                ],
                'featured' => false,
            ],
            [
                'id' => 4,
                'title' => 'Worship Technology Upgrade',
                'category' => 'worship',
                'raised' => 18000,
                'goal' => 35000,
                'end_date' => '2025-06-30',
                'image' => 'worship.jpg',
                'description' => 'Upgrading our sound system, lighting, and multimedia capabilities to enhance our worship experience with better audio quality and visual presentations.',
                'updates' => [
                    ['date' => '2025-04-05', 'content' => 'New mixing board and speakers installed.'],
                ],
                'featured' => true,
            ],
            [
                'id' => 5,
                'title' => 'Foreign Missions Support',
                'category' => 'missions',
                'raised' => 28000,
                'goal' => 50000,
                'end_date' => '2025-09-30',
                'image' => 'missions.jpg',
                'description' => 'Supporting our partner churches in Ghana, Haiti, and the Philippines with resources for church planting, clean water projects, and education initiatives.',
                'updates' => [
                    ['date' => '2025-04-18', 'content' => 'Water purification system installed in Ghana village.'],
                    ['date' => '2025-03-10', 'content' => 'Construction began on Haiti school building.'],
                ],
                'featured' => false,
            ],
            [
                'id' => 6,
                'title' => 'Children\'s Ministry Renovation',
                'category' => 'programs',
                'raised' => 30000,
                'goal' => 60000,
                'end_date' => '2025-08-15',
                'image' => 'children.jpg',
                'description' => 'Creating safe, engaging spaces for our children to learn and grow in faith, including classroom renovations, interactive learning materials, and outdoor play area.',
                'updates' => [
                    ['date' => '2025-04-12', 'content' => 'Classroom painting complete, new furniture arriving next week.'],
                ],
                'featured' => false,
            ],
        ];

        // Filter projects based on active tab
        if ($this->activeTab !== 'all') {
            $projects = array_filter($projects, function ($project) {
                return $project['category'] === $this->activeTab;
            });
        }

        // Filter projects based on search
        if (!empty($this->search)) {
            $search = strtolower($this->search);
            $projects = array_filter($projects, function ($project) use ($search) {
                return str_contains(strtolower($project['title']), $search) ||
                    str_contains(strtolower($project['description']), $search);
            });
        }

        return $projects;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function toggleDetails($projectId)
    {
        if ($this->showDetails === $projectId) {
            $this->showDetails = null;
        } else {
            $this->showDetails = $projectId;
        }
    }

    public function mount()
    {
        // Initialize with first project expanded on mobile
        if (empty($this->showDetails)) {
            $projects = $this->getProjects();
            if (!empty($projects)) {
                $this->showDetails = $projects[0]['id'];
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.develop.projects-component', [
            'projects' => $this->getProjects(),
            'featuredProjects' => array_filter($this->getProjects(), function ($project) {
                return $project['featured'] === true;
            }),
        ])->layout('front.layouts.front-layout');
    }
}