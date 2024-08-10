<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AboutModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AboutUsController extends Controller
{
    function about(){
        $data = AboutModel::all();
        if (Auth::guard('admin_model')->user()->can('settings')) {
            // Show the view page

            return view('backend.about.index',['datas' => $data]);
        } else {
            return abort(404);
        }
    }
    function aboutStore(Request $request){
        // AboutModel::where('status',1)->update([
        //     'status' => 0,
        // ]);
        // $request->validate([
        //     'photo'         => 'required',
        //     'title'         => 'required',
        //     'description'   => 'required',
        // ]);
        $about = AboutModel::all();
        if($about->count() == 0){
            $about = new AboutModel();
            if($request->photo){
                $photo = $request->photo;
                $extn = $photo->getClientOriginalExtension();
                $photoname = 'HOW-WE-WORK-PHOTO-'.rand(1,2000).'.'. $extn;
                Image::make($photo)->resize('1270','560')->save(public_path('uploads/about/'.$photoname));
                $about->photo = $photoname;
            }
            if($request->video){
                $video = $request->video;
                $extn = $video->getClientOriginalExtension();
                $videoname = 'HOW-WE-WORK-VIDEO-'.rand(1,2000).'.'. $extn;
                $video->move(public_path('uploads/about/'),$videoname);
                $about->video = $videoname;
            }
            $about->save();
            return back();
        }else{
            $about = AboutModel::where('title',null)->get()->first();
            if($request->photo){
                $path = public_path('uploads/about/'.$about->photo);
                unlink($path);
                $photo = $request->photo;
                $extn = $photo->getClientOriginalExtension();
                $photoname = 'HOW-WE-WORK-PHOTO-'.rand(1,2000).'.'. $extn;
                Image::make($photo)->resize('1270','560')->save(public_path('uploads/about/'.$photoname));
                $about->photo = $photoname;

            }
            if($request->video){
                $path = public_path('uploads/about/'.$about->video);
                unlink($path);
                $video = $request->video;
                $extn = $video->getClientOriginalExtension();
                $videoname = 'HOW-WE-WORK-VIDEO-'.rand(1,2000).'.'. $extn;
                $video->move(public_path('uploads/about/'),$videoname);
                $about->video = $videoname;
            }
            $about->save();
            return back();
        }
        // $photo = $request->photo;
        // $extn = $photo->getClientOriginalExtension();
        // $profileName = 'PRO'.rand(1,2000).'FILE'.rand(1,500).'.'. $extn;
        // Image::make($photo)->resize('500','500')->save(public_path('uploads/about/'.$profileName));

        // AboutModel::insert([
        //     'photo'         => $profileName,
        //     'title'         => $request->title,
        //     'description'   => $request->description,
        //     'created_at'    => Carbon::now(),
        // ]);
        // return back()->with('succ', 'Added Successfully');
    }
    function aboutDelete($id){

        $delPhoto = AboutModel::where('id',$id)->first();
        if($delPhoto->photo){
            $path = public_path('uploads/about/'.$delPhoto->photo);
            unlink($path);
        }
        if($delPhoto->video){
            $path = public_path('uploads/about/'.$delPhoto->video);
            unlink($path);
        }
        $delPhoto->delete();
        return back()->with('succ', 'Delete Successfully !');
    }
    function aboutEdit(Request $request){

        $request->validate([
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->id !=null) {
            if ($request->status == 1) {
                AboutModel::where('status',1)->update([
                    'status' => 0,
                ]);
            }
            if ($request->photo != null) {
                $delPhoto = AboutModel::where('id',$request->id)->first()->photo;
                $path = public_path('uploads/about/'.$delPhoto);
                unlink($path);
                $photo = $request->photo;
                $extn = $photo->getClientOriginalExtension();
                $profileName = 'PRO'.rand(1,2000).'FILE'.rand(1,500).'.'. $extn;
                Image::make($photo)->resize('500','500')->save(public_path('uploads/about/'.$profileName));

                AboutModel::where('id',$request->id)->update([
                    'photo' => $profileName,
                ]);
            }
            AboutModel::where('id',$request->id)->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'status'        => $request->status,
                'updated_at'    => Carbon::now(),
            ]);
            return back()->with('succ','Updated Successfully');
        }else {
            return back()->with('err','Invalid data, try again !');
        }
    }
}
