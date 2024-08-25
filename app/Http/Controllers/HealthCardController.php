<?php

namespace App\Http\Controllers;

use ArrayIterator;
use MultipleIterator;
use App\Models\HealthCard;
use Illuminate\Http\Request;
use App\Models\HealthCardApplicaton;
use Illuminate\Support\Facades\Auth;

class HealthCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $healths = HealthCard::all();

        if (Auth::guard('admin_model')->user()->can('database')) {
            return view('backend.health-card.index',compact('healths'));
            // Show the view page
        } else {
            return abort(404);
        }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'benifits.*'  => 'required',
            'photofirst'  => 'required',
            'photosecond'  => 'required',
        ]);
        $file1 = $request->photofirst;
        $file2 = $request->photosecond;
        $extension1 = $file1->getClientOriginalExtension();
        $extension2 = $file2->getClientOriginalExtension();
        $filename1 = 'HEALTH-CARD-FIRST-'.time().'.'.$extension1;
        $filename2 = 'HEALTH-CARD-SECOND-'.time().'.'.$extension2;
        $file1->move('uploads/healthcard/',$filename1);
        $file2->move('uploads/healthcard/',$filename2);
        $health = new HealthCard();
        $health->name = $request->name;
        $health->price = $request->price;
        $health->image_first = $filename1;
        $health->image_second = $filename2;
        $health->benifits = json_encode($request->benifits);
        $health->status = 1;
        $health->save();



        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $healths= HealthCard::find($id);

        if (Auth::guard('admin_model')->user()->can('database')) {
            if (Auth::guard('admin_model')->user()->can('edit')){

                return view('backend.health-card.edit', compact('healths',));
            }else {
                return abort(404);
            }
            // Show the view page
        } else {
            return abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required',

        ]);
        $health = HealthCard::find($id);
        $health->name = $request->name;
        $health->price = $request->price;
        $health->benifits = json_encode($request->benifits);
        $health->status = $request->status;
        $health->save();
        return redirect(route('health-card.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HealthCard::find($id)->delete();
        return back();
    }

    public function healthCardData(Request $request, ){

        // $applicatios = HealthCardApplicaton::all();
        $query = HealthCardApplicaton::query();


        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', "%{$searchTerm}%"); // Adjust column_name as needed
            $query->orWhere('slug', 'like', "%{$searchTerm}%"); // Adjust column_name as needed
            $query->orWhere('number', 'like', "%{$searchTerm}%"); // Adjust column_name as needed
            $query->orWhere('address', 'like', "%{$searchTerm}%"); // Adjust column_name as needed
            $query->orWhere('passport_nid', 'like', "%{$searchTerm}%"); // Adjust column_name as needed
        }

        $results = $query->latest()->paginate(12);

        if (Auth::guard('admin_model')->user()->can('health_card_application')){
            return view('backend.health-card.healthCardApplication',[
                'applicatios' => $results,

            ]);
        }else{
            return abort(404);
        }

    }

    // public function healthCardDataPaginate($id){
    //     $health_card = HealthCardApplicaton::where('id', $id)->first();
    // }
    public function healthCardDataEdit($id){
        $applications = HealthCardApplicaton::find($id);
        if (Auth::guard('admin_model')->user()->can('health_card_application')){
            return view('backend.health-card.editHealthCardApplication',compact('applications'));
        }else{
            return abort(404);
        }

    }
    public function healthCardDataUpdate(Request $request ){
        if (Auth::guard('admin_model')->user()->can('health_card_application')){
            $applications = HealthCardApplicaton::find($request->id);
            $applications->slug = $request->slug;
            $applications->status = $request->status;
            $applications->note = $request->note;
            $applications->save();
            return redirect(route('health.card.data'));
        }else{
            return abort(404);
        }

    }
}
