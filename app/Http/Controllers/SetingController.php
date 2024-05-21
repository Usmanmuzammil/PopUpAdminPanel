<?php

namespace App\Http\Controllers;
use App\Rules\ClosingDateTime;
use App\Models\pos_seting;
use Illuminate\Http\Request;

class SetingController extends Controller
{
    public function store(Request $req)
    {



        try {
            $req->validate([
                'opening_time' => 'required|date_format:H:i',
                'closing_time' => ['required'],
            ]);

            // Convert opening and closing times to Carbon instances
            $openingDateTime = now()->setTimeFromTimeString($req->opening_time);
            $closingDateTime = now()->setTimeFromTimeString($req->closing_time);


            // Check if closing time is greater than opening time
            $closingDate = $closingDateTime->greaterThan($openingDateTime)
                ? now()
                : now()->addDay();
                // check time is greate
                  $formattedClosingDateTime = $closingDate->format('Y-m-d') .' '. $req->closing_time.':00';
                  $opening = $openingDateTime->format('Y-m-d') .' '. $req->opening_time.':00';
                 if($formattedClosingDateTime < $opening ){
                    return redirect()->back()->with('error','Opening time is must be greater then closing time..!');
                }
                $created_at =  date('Y-m-d').' '.$req->opening_time . ':00';

            // pos_seting::create([
            //     'date' => now()->toDateString(),
            //     'closing_date' => $formattedClosingDateTime, // Adjust the format as needed
            //     'opening_time' => $req->opening_time,
            //     'closing_time' => $req->closing_time,
            //     'created_at' =>  $created_at,
            //     'status' => 1,
            // ]);
            $status = 0;
            if($req->has('status')){
                $status = 1;
            }

            pos_seting::createWithCustomCreatedAt([
                'date' => now()->toDateString(),
                'opening_time' => $req->opening_time,
                'closing_time' => $req->closing_time,
                'closing_date' => $formattedClosingDateTime,
                'status' => $status,
            ], $created_at);

            return redirect()->back()->with('success', 'Time set successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }





    public function update(Request $req ,$id){
        try {
            $req->validate([
                'opening_time' => 'required',
                'closing_time' => ['required'],
            ]);

            // Convert opening and closing times to Carbon instances
            $openingDateTime = now()->setTimeFromTimeString($req->opening_time);
            $closingDateTime = now()->setTimeFromTimeString($req->closing_time);

            // Check if closing time is greater than opening time
            $closingDate = $closingDateTime->greaterThan($openingDateTime)
                ? now()
                : now()->addDay();
                 $formattedClosingDateTime = $closingDate->format('Y-m-d') .' '. $req->closing_time.':00';


            // pos_seting::where('id',$id)->update([
            //     'date' => now()->toDateString(),
            //     'closing_date' => $formattedClosingDateTime, // Adjust the format as needed
            //     'opening_time' => $req->opening_time,
            //     'closing_time' => $req->closing_time,
            //     'status' => 1,
            // ]);
            $seting = pos_seting::where('id',$id)->first();



            $date = $seting->date;
          $created_at =  $date .' '.$req->opening_time;
                $seting->delete();

            pos_seting::createWithCustomCreatedAt([
                'date'=>$date,
                'opening_time' => $req->opening_time,
                'closing_time' => $req->closing_time,
                'closing_date' => $formattedClosingDateTime,
                'status' => 1,
            ], $created_at);




            return redirect()->back()->with('success','Time set updated successfully');
    }catch(\Exception $ex){
        return $ex->getMessage();
        return redirect()->back()->with('error',$ex->getMessage());
    }

    }
}
