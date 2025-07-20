<?php

use App\Http\Controllers\Shield\ShieldController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Livewire\Shield\Article\ArticleForm;
use App\Livewire\Shield\Article\ArticleManagement;
use App\Livewire\Shield\Category\CategoryForm;
use App\Livewire\Shield\Category\CategoryManagement;
use App\Livewire\Shield\Church\ManageChurches;
use App\Livewire\Shield\Church\SermonForm;
use App\Livewire\Shield\Church\SermonManager;
use App\Livewire\Shield\Church\TeamCategories;
use App\Livewire\Shield\Church\TeamMemberForm;
use App\Livewire\Shield\Church\TeamMemberOrdering;
use App\Livewire\Shield\Church\TeamMembers;
use App\Livewire\Shield\Ministry\MinistryEventForm;
use App\Livewire\Shield\Ministry\MinistryEventList;
use App\Livewire\Shield\Ministry\MinistryForm;
use App\Livewire\Shield\Ministry\MinistryIndex;
use App\Livewire\Shield\Settings\AboutUsManager;
use App\Livewire\Shield\Settings\Announcements;
use App\Livewire\Shield\Settings\ContactMessages;
use App\Livewire\Shield\Settings\GeneralSettings;
use App\Livewire\Shield\Region\Index as RegionIndex;
use App\Livewire\Shield\Cluster\Index as ClusterIndex;

use App\Http\Controllers\ContactController;
use App\Livewire\Frontend\Article\ArticleIndex;
use App\Livewire\Frontend\Article\ArticleShow;
use App\Livewire\Frontend\Church\ChurchLeadership;
use App\Livewire\Frontend\Church\SermonsList;
use App\Livewire\Frontend\Develop\ProjectsComponent;
use App\Livewire\Frontend\Settings\Aboutsite;
use App\Livewire\Frontend\Settings\DonationPage;
use App\Livewire\Frontend\Settings\FrontChurch;
use App\Livewire\Frontend\Settings\MinistryGallery;
use App\Livewire\Frontend\Ministry\MinistryShowcase;
use App\Livewire\Frontend\Ministry\EventsDisplay;
use Illuminate\Support\Facades\Route;




// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');
// Contact Us Route
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// About Us page using Livewire component
Route::get('/about', Aboutsite::class)->name('about');
Route::get('/ministries', MinistryShowcase::class)->name('ministries.index');
Route::get('/ministries/{id}', MinistryShowcase::class)->name('ministries.show');
// Ministry Gallery route
Route::get('/galleries', MinistryGallery::class)->name('ministry.galleries');
Route::get('/ministry-events', EventsDisplay::class)->name('frontend.ministry.events');
// Church Directory Frontend Routes
Route::get('/churches', FrontChurch::class)->name('ministry.churches');
// All sermons page
Route::get('/sermons', SermonsList::class)->name('sermons');
//Donate Route
Route::get('/donate', DonationPage::class)->name('donate');
// Front-end Routes for the Church Blog
Route::get('/blog', ArticleIndex::class)->name('blog.index');
Route::get('/blog/{slug}', ArticleShow::class)->name('blog.show');
// Church Leadership route
Route::get('/leadership', ChurchLeadership::class)->name('church.leadership');
// Church Development Projects Route
Route::get('/develop', ProjectsComponent::class)->name('frontend.develop');
// You can also create additional routes for specific project details if needed
Route::get('/develop/{projectId}', ProjectsComponent::class)->name('frontend.develop.project');



// Jetstream normal user routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role.redirect:user'
])->group(function () {
    // Normal User Dashboard Route
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

// Support Routes
Route::middleware([
    'auth',
    'verified',
    'role.redirect:support'
])
    ->prefix('support')
    ->name('support.')
    ->group(function () {
        // Support Dashboard Route
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    });

// Shield (Admin) Routes
Route::middleware([
    'auth:sanctum',
    'verified',
    'role.redirect:admin'
])
    ->prefix(config('app.admin_prefix', 'shield'))
    ->name(config('app.admin_prefix', 'shield') . '.')
    ->group(function () {
        // Dashboard Route
        Route::get('/dashboard', [ShieldController::class, 'dashboard'])->name('dashboard');
        // Settings Routes
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/info', GeneralSettings::class)->name('general');
            //About Us manager
            Route::get('/about', AboutUsManager::class)->name('about');
            // Announcements module route
            Route::get('/announcements', Announcements::class)->name('announcements');
        });
        //Article Category Management Routes
        Route::prefix('categories')->name('categories.')->group(function () {
            // Route for displaying the list of categories
            Route::get('/', CategoryManagement::class)->name('index');
            // Route for creating a new category
            Route::get('/create', CategoryForm::class)->name('create');
            // Route for editing an existing category
            Route::get('/edit/{categoryId}', CategoryForm::class)->name('edit');
        });

        // Article Management Routes
        Route::prefix('articles')->name('articles.')->group(function () {
            // Route for displaying the list of articles
            Route::get('/', ArticleManagement::class)->name('index');
            // Route for creating a new article
            Route::get('/create', ArticleForm::class)->name('create');
            // Route for editing an existing article
            Route::get('/edit/{articleId}', ArticleForm::class)->name('edit');
        });

        // Contact Us Route
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/messages', ContactMessages::class)->name('messages');
        });

        // Church Management Routes
        Route::prefix('church')->name('church.')->group(function () {
            // Region Management Routes
            Route::get('/regions', RegionIndex::class)->name('regions');
            // Cluster Management Routes
            Route::get('/clusters', ClusterIndex::class)->name('clusters');
            // Church Management Routes
            Route::get('/sermons', SermonManager::class)->name('sermons.index');
            // Create new sermon
            Route::get('/sermons/create', SermonForm::class)->name('sermons.create');
            // Edit existing sermon
            Route::get('/sermons/{sermonId}/edit', SermonForm::class)->name('sermons.edit');
        });

        // Church Management Routes
        Route::prefix('churches')->name('churches.')->group(function () {
            Route::get('/shield/churches', ManageChurches::class)->name('shield.churches');
        });

        // Team Member Management Routes
        Route::prefix('team-members')->name('team-members.')->group(function () {
            // Team Categories Management
            Route::get('/categories', TeamCategories::class)->name('shield.church.team-categories');
            // Team Members Management
            Route::get('/R', TeamMembers::class)->name('team-members');
            Route::get('/create', TeamMemberForm::class)->name('team-members.create');
            Route::get('/{id}/edit', TeamMemberForm::class)->name('team-members.edit');
            Route::get('/order', TeamMemberOrdering::class)->name('team-members.order');
        });

        // Ministry Routes
        Route::prefix('ministry')->name('ministry.')->group(function () {
            Route::get('/', MinistryIndex::class)->name('index');
            Route::get('/create', MinistryForm::class)->name('create');
            Route::get('/edit/{id}', MinistryForm::class)->name('edit');
        });

        // Ministry Events Routes
        Route::prefix('ministry-events')->name('ministry.events.')->group(function () {
            Route::get('/', MinistryEventList::class)->name('index');
            Route::get('/create', MinistryEventForm::class)->name('create');
        });
    });

// Auto-redirect route after login
Route::middleware(['auth', 'verified'])->get('/redirect-by-role', function () {
    $user = auth()->user();
    if ($user->hasRole('admin')) {
        $prefix = config('app.admin_prefix', 'shield');
        return redirect()->route($prefix . '.dashboard');
    } elseif ($user->hasRole('support')) {
        return redirect()->route('support.dashboard');
    } else {
        return redirect()->route('dashboard');
    }
})->name('role.redirect');
