<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\HealthCard;
use App\Models\DoctorModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HospitalModel;
use App\Models\DepartmentModel;
use App\Models\HealthCardApplicaton;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Notification;
use App\Notifications\HealthCard as NotificationsHealthCard;

class FrontEndController extends Controller
{
    //Appoinmnet
    function appoinmentLink(){
        SEOMeta::setTitle('Appoinment'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        return view('frontend.appoinment.index');
    }
    function loginLink(){
        return view('frontend.login');
    }
    function loginAccess(Request $request){
        $request->validate([
            'number'    => 'required',
            'password'  => 'required',
        ]);
        if (Auth::guard()->attempt(['number'=> $request->number,'password'=>$request->password],$request->remember)) {
            return redirect()->route('profile')->with('succ','Successfully logged in');
        }else {
            return back()->with('err','Password not matching');
        }


    }
    function registerLink(){
        return view('frontend.register');
    }
    function registerAccess(Request $request){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'number'    => 'required',
            'password'  => 'required |min:8|max:16',
        ]);
        if (!User::where('email', $request->email)->exists()) {
            User::insert([
                'name'      => $request->name,
                'email'     => $request->email,
                'number'    => $request->number,
                'password'  => bcrypt($request->password),
            ]);
            Auth::guard()->attempt([
                'number'    => $request->number,
                'password'  =>$request->password
            ],$request->remember);
            return redirect()->route('profile')->with('succ','Account Created');
        }else{
            return back()->with('err','Email Already Exists');
        }
    }
    function reset(){
        return view('frontend.auth.reset');
    }
    function contact(){
        return view('frontend.contact');
    }
    function thankyou(){
        return view('frontend.thankyou');
    }
    function index(){
        SEOMeta::setTitle('Health Card'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        $healths = HealthCard::where('status',1)->get()->first();
        return view('frontend.health-card.index',compact('healths'));
    }
    function healthCardStore(Request $request){

        $request->validate([
            'name' => 'required',
            'number' => 'required|numeric|digits:11',
            'address' => 'required',
        ],[
            'name'=>'Please Input Name!',
            'number'=>'Please Input Phone Numebr!',
            'number.numeric'=>'Please Input Numebr Type!',
            'number.digits'=>'Number Should Be 11 Digits!',
            'address'=>'Please Input Address!',
        ]);
        if($request->pass_nid_number){
            $request->validate([
                'pass_nid_number' =>'max:17',
            ],[
                'pass_nid_number.max'=>'Maximu 17 Digits!',

            ]);

            $application = new HealthCardApplicaton();
            $application->name = $request->name;
            $application->number = $request->number;
            $application->address = $request->address;
            $application->passport_nid = $request->pass_nid_number;
            $application->slug = 'MT-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
            $application->status = "PROCESSING";
            $application->save();


        }else{
            $application = new HealthCardApplicaton();
            $application->name = $request->name;
            $application->number = $request->number;
            $application->address = $request->address;
            $application->slug = 'MT-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
            $application->status = "PROCESSING";
            $application->save();

        }
        $adminEmails = [
            'admin1@example.com',
            // Add more admin emails as needed
        ];
        $messageAdmin = 'New health card requested! Take a look.';
        // $messageUser = 'Thank you for your health card request. We will contact you soon.';
        Notification::route('mail', $adminEmails)->notify(new NotificationsHealthCard($messageAdmin,true));
        // Notification::route('mail', $request->email)?->notify(new NotificationsHealthCard($messageUser, false));
        return redirect(route('thank.you'));
    }
    public function hospitalDetails($slug){
        $hospital = HospitalModel::where('slug',$slug)->first();
        return view('frontend.hospital.hospital_details',[
            'hospital' => $hospital
        ]);
    }
    public function findDoctor(){
        $departments = DepartmentModel::where('status',1)->get();
        $doctors = DoctorModel::where('status',1)->get();
        return view('frontend.doctor.doctor_filter',[
            'departments' => $departments,
            'doctors' => $doctors
        ]);
    }
    public function department_result($id) {
        $doctors = DoctorModel::with(['con_department', 'con_hospital'])
                              ->where('department_id', $id)
                              ->where('status', 1)
                              ->get();
        return response()->json($doctors);
    }
    public function search_result($search) {
        $doctors = DoctorModel::with(['con_department', 'con_hospital'])
        ->where('name', 'like' , "%$search%")
        ->where('status', 1)
        ->get();
        return response()->json($doctors);
    }

    public function blogIndex()
    {
        $category = Category::where('status', 'active')->get();
        //getting most view alltime blog
        // $best = Blog::orderBy('view_count', 'desc')->take(4)->get();
        //Recent
        // $recent = Blog::orderBy('id', 'desc')->take(4)->get();
        //category product
        $categoryBlog = Blog::where('status', 'active')->paginate(8);
        return view('frontend.blog.index',[
            'blogs'     => $categoryBlog,
            // 'recent'    => $recent,
            // 'bests'     => $best,
            'cats'      => $category,
        ]);

    }
    public function blog_category_show($slug)
    {
        $cat = Category::query()->select('slug', 'id','name')->where('slug',$slug)->where('status', 'active')->first();
        $category = Category::where('status', 'active')->get();
        // $category = Category::where('slug',$slug)->where('status', 'active')->get();
        //getting most view alltime blog
        // $best = Blog::orderBy('view_count', 'desc')->take(4)->get();
        //Recent
        // $recent = Blog::orderBy('id', 'desc')->take(4)->get();
        //category product
        $categoryBlog = Blog::where('category_id',$cat->id)->where('status', 'active')->paginate(8);


        // where('status', 'active')->paginate(8);
        return view('frontend.blog.index',[
            'blogs'     => $categoryBlog,
            // 'recent'    => $recent,
            // 'bests'     => $best,
            'cats'      => $category,
        ]);

    }
    public function blog_view($slug){
        $blog = Blog::where('slug', $slug)->first();
        $category = Category::where('status', 'active')->get();

        //getting related blog
        $related = Blog::where('category_id', $blog->category_id)->where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->take(4)->get();

        //getting most view alltime blog
        // $best = Blog::orderBy('view_count', 'desc')->take(4)->get();

        //Recent
        // $recent = Blog::orderBy('id', 'desc')->take(4)->get();

        if ($blog) {
            //incerement view count
            $blog->increment('view_count');
            $blog->save();

            return view('frontend.blog.blog-preview', [
                'blog'      => $blog,
                'related'   => $related,
                // 'recent'    => $recent,
                // 'bests'     => $best,
                'cats'      => $category,
            ]);
        } else {
            return back();
        }
    }

    function hctc(){
        SEOMeta::setTitle('Health Card Terms And Conditions'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        return view('frontend.health-card-terms-and-conditions');
    }
    function privacypolicy(){
        SEOMeta::setTitle('Privacy Policy'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        return view('frontend.privacyandpolicy');
    }
    function terms(){
        SEOMeta::setTitle('Terms And Conditions'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        return view('frontend.terms-and-condition');
    }
    function aboutus(){
        SEOMeta::setTitle('About Us'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        return view('frontend.aboutus');
    }
}
