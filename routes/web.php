<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogSectionSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\FeedbackSectionSettingController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\PortfolioSectionSetting;
use App\Http\Controllers\Admin\PortfolioSectionSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillItemController;
use App\Http\Controllers\Admin\SkillSectionSettingController;
use App\Http\Controllers\Admin\TyperTitleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\TyperTitle;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/blog-details', function () {
    return view('frontend.blog-details');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('portfolio-details/{id}', [HomeController::class, 'showPortfolio'])->name('show.portfolio');
Route::get('blog-details/{id}', [HomeController::class, 'showBlog'])->name('show.blog');
Route::get('blog', [HomeController::class, 'blog'])->name('blog');

// 'prefix' => 'admin' is for URI prefix
// 'as' => 'admin.' is for naming prefix
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('hero', HeroController::class);
    Route::resource('typer-title', TyperTitleController::class);

    // Service route
    Route::resource('service', ServiceController::class);

    // About route
    Route::get('resume/download', [AboutController::class, 'resumeDownload'])->name('resume.download');
    Route::resource('about', AboutController::class);

    // Portfolio category route
    Route::resource('category', CategoryController::class);

    // Portfolio item route
    Route::resource('portfolio-item', PortfolioItemController::class);

    // Section setting route
    Route::resource('portfolio-section-setting', PortfolioSectionSettingController::class);

    // Skill section setting route
    Route::resource('skill-section-setting', SkillSectionSettingController::class);

    // Skill item route
    Route::resource('skill-item', SkillItemController::class);

    // Experience route
    Route::resource('experience', ExperienceController::class);

    // Feedback route
    Route::resource('feedback', FeedbackController::class);

    // Feedback section setting route
    Route::resource('feedback-section-setting', FeedbackSectionSettingController::class);

    // Blog category route
    Route::resource('blog-category', BlogCategoryController::class);

    // Blog  route
    Route::resource('blog', BlogController::class);

    // Blog section setting  route
    Route::resource('blog-section-setting', BlogSectionSettingController::class);
});
