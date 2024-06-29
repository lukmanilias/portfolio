<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Feedback;
use App\Models\FeedbackSectionSetting;
use App\Models\Hero;
use App\Models\PortfolioItem;
use App\Models\PortfolioSectionSetting;
use App\Models\Service;
use App\Models\SkillItem;
use App\Models\SkillSectionSetting;
use App\Models\TyperTitle;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Query all data needed and just pass it here
        $hero = Hero::first();
        $typertitles = TyperTitle::all();
        $services = Service::all();
        $about = About::first();
        $portfolioTitle = PortfolioSectionSetting::first();
        $portfolioCategories = Category::all();
        $portfolioItems = PortfolioItem::all();
        $skill = SkillSectionSetting::first();
        $skillItems = SkillItem::all();
        $experience = Experience::first();
        $feedbacks = Feedback::all();
        $feedbackTitle = FeedbackSectionSetting::first();
        // dd($skill);

        return view('frontend.home', compact(
            'hero',
            'typertitles',
            'services',
            'about',
            'portfolioTitle',
            'portfolioCategories',
            'portfolioItems',
            'skill',
            'skillItems',
            'experience',
            'feedbacks',
            'feedbackTitle'
        ));
    }

    public function showPortfolio($id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details', compact('portfolio'));
    }
}
