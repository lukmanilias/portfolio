<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogSectionSetting;
use App\Models\Category;
use App\Models\ContactSectionSetting;
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
use Illuminate\Support\Facades\Mail;

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
        $blogs = Blog::latest()->take(5)->get();
        $blogTitle = BlogSectionSetting::first();
        $contactTitle = ContactSectionSetting::first();

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
            'feedbackTitle',
            'blogs',
            'blogTitle',
            'contactTitle'
        ));
    }

    public function showPortfolio($id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details', compact('portfolio'));
    }

    public function showBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $previousBlog = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextBlog = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
        return view('frontend.blog-details', compact('blog', 'previousBlog', 'nextBlog'));
    }

    public function blog()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('frontend.blog', compact('blogs'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:300'],
            'message' => ['required', 'max:2000']
        ]);

        // Send the data in array form
        Mail::send(new ContactMail($request->all()));

        return response(['status' => 'success', 'message' => 'Mail sent successfully.']);
    }
}
