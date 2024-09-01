<?php

namespace App\Http\Controllers;

use Image;
use Photo;
use ArrayIterator;
use Carbon\Carbon;
use App\Models\User;
use MultipleIterator;
use App\Models\VisaModel;
use Illuminate\Http\Request;
use App\Models\VisaModelResport;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoConsultAttendant;
use App\Notifications\VisaInvitation;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Notification;

class VisaController extends Controller
{
    function visaLink(){
        SEOMeta::setTitle('Visa'); //web title
        SEOTools::setDescription('this is description');
        SEOMeta::addKeyword('this is tags');
        OpenGraph::setTitle('this is seo title');
        SEOMeta::setCanonical('https://meditriangle.com' . request()->getPathInfo());
        return view('frontend.visa.index');
    }
    function visaStore(Request $request){

        // dd($request->all());

        $order_id ='#OR'.rand(1,5000).'DER'.rand(1,500);
        $fee = 2500;
        $request->validate([
            'name'              => 'required',
            'phone'            => 'required',
            'email'             => 'required',
            'passport'          => 'required',
            'prescription'      => 'required|mimes:pdf',

        ],[
            'prescription' => 'Report Must Be PDF!',
        ]);

        //Login
        // if (!Auth::check()) {
        //     if (User::where('number',$request->number)->exists()) {
        //         return back()->with('err', 'Number Exists ! Login Please');
        //     }else {
        //         $pass ='RAN'.rand(1,5000).'LOG'.rand(1,500);
        //         User::insert([
        //             'name' => $request->name,
        //             'number' => $request->newNumber,
        //             'email' => $request->newEmail,
        //             'password' => bcrypt($pass),
        //             'created_at' => Carbon::now(),
        //         ]);
        //         Auth::guard()->attempt(['number'=> $request->number,'password'=>$pass]);

        //         // SMS
        //         $url = "http://bulksmsbd.net/api/smsapi";
        //         $api_key = "5Ga7wUBj70JdpiqVhe8t";
        //         $senderid = "8809617611020";
        //         $number = $request->number;
        //         $message = 'Your Password is : '.$pass;

        //         $data = [
        //             "api_key" => $api_key,
        //             "senderid" => $senderid,
        //             "number" => $number,
        //             "message" => $message
        //         ];
        //         $ch = curl_init();
        //         curl_setopt($ch, CURLOPT_URL, $url);
        //         curl_setopt($ch, CURLOPT_POST, 1);
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //         $response = curl_exec($ch);
        //         curl_close($ch);
        //     }
        // }
        //login end
        $file = $request->file('prescription');
        $ext = $file->getClientOriginalExtension();
        $name = 'PRO' . rand(1, 2000) . 'FILE' . rand(1, 500) . '.' . $ext;
        // Store the file in the 'public/uploads' directory with the generated name
        $path = $file->storeAs('uploads/visareport', $name, 'public');
        VisaModelResport::insert([
            'order_id' => $order_id,
            'reports' => $name,
            'created_at' => Carbon::now(),
        ]);

        // //Attendant
        if ($request->attendantName[0] != null) {
            $request->validate([
                'attendantPassportNumber.*' => 'required',

            ]);
            if($request->attendantPassport){
                // dd($request->attendantPassport);
                $mi = new MultipleIterator();
                $mi->attachIterator(new ArrayIterator($request->attendantName));
                $mi->attachIterator(new ArrayIterator($request->attendantPassportNumber));
                $mi->attachIterator(new ArrayIterator($request->attendantPassport));
                foreach ($mi as list($name, $number, $photo) ) {
                    $make = $photo;
                    $extn = $make->getClientOriginalExtension();
                    $profileName = 'PRO'.rand(1,2000).'FILE'.rand(1,500).'.'. $extn;
                    $attendant = new VideoConsultAttendant();
                        $attendant->order_id  = $order_id;
                        $attendant->name  = $name;
                        $attendant->number  = $number;
                        $attendant->passport  = $profileName;
                        $attendant->save();

                    Image::make($make)->save(public_path('uploads/attendant/'.$profileName));
                }
            }else{
                return back()->with('err', 'Please Add Attendent Passport');
            }
        }
        $passport = $request->file('passport');
        $extn = $passport->getClientOriginalExtension();
        $profileName = 'PRO'.rand(1,2000).'FILE'.rand(1,500).'.'. $extn;
        $passport->move(public_path('uploads/visa/'), $profileName);
        // Photo::upload($request->passport,'uploads/visa','VIS');
        VisaModel::insert([
            'name'              => $request->name,
            'number'            => $request->phone,
            'email'             => $request->email,
            'order_id'          => $order_id,
            'passport'           => $profileName,
            'created_at'         => Carbon::now(),
        ]);

        $adminEmails = [
            'admin1@example.com',
            // Add more admin emails as needed
        ];
        $messageAdmin = 'New visa invitation requested! Take a look.';
        $messageUser = 'Thank you for your visa invitation request. We will contact you soon.';
        Notification::route('mail', $adminEmails)->notify(new VisaInvitation($messageAdmin,true));
        Notification::route('mail', $request->email)->notify(new VisaInvitation($messageUser, false));

         return redirect(route('thank.you'));
        // $data = array("id"=>Auth::user()->id, "amount"=>$fee,'order_id'=>$order_id);
        // $data = array("id"=>Auth::user()->id, "amount"=>$fee,'order_id'=>$order_id,'type' => 'visa');
        // return redirect()->route('pay')->with('data',$data);
    }
}
