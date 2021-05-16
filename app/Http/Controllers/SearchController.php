<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function dashboard()
    {
        $stations = DB::table('stations')->get();
        return view('dashboard',compact('stations'));
    }

    public function searchTrain(Request $request)
    {
        $from_station = $request->from_station;
        $to_station = $request->to_station;
        $sdate = $request->sdate;
        $user_id = Auth::user()->id;

        if($from_station<$to_station)
        {
            $going_to = 'Petta';
            $order_by = 'asc';
        } else {
            $going_to = 'Aluva';
            $order_by = 'desc';
        }

        $sel_train = DB::table('trains')->where('to','=',$going_to)->first();
        $chk_booking_exist = DB::table('bookings')
                                ->where([
                                    'from_station'=>$from_station,
                                    'to_station'=>$to_station,
                                    'train_id'=>$sel_train->id,
                                    'user_id'=>$user_id
                                ])->count();
        
        return response()->json(['result'=>'success','selected_train_id'=>$sel_train->id,'selected_train_name'=>$sel_train->train_name]);
    }

    public function bookTrain(Request $request)
    {
        $from_station = $request->from_station;
        $to_station = $request->to_station;
        $sdate = $request->sdate;
        $user_id = Auth::user()->id;
        $compartment_id = $request->compartment_id;
        $train_id = $request->train_id;
        $seat = $request->seat;

        if($from_station<$to_station)
        {
            $going_to = 'Petta';
            $order_by = 'asc';
        } else {
            $going_to = 'Aluva';
            $order_by = 'desc';
        }

        $stations = DB::table('stations')->orderBy('id', $order_by)->get();
        $start_time = "08:00";
        foreach($stations as $st)
        {
            $station_time[] = array('station_id' => $st->id, 'time' => $start_time);
            if($st->station_name == 'Muttom' || $st->station_name == 'Palarivattom')
            {
                $start_time = strtotime("+12 minutes", strtotime($start_time));
                $start_time = date('h:i', $start_time);
            } else 
            {
                $start_time = strtotime("+10 minutes", strtotime($start_time));
                $start_time = date('h:i', $start_time);
            }
        }
        
        for($i=0;$i<count($station_time);$i++)   
        {
            if($station_time[$i]['station_id']==$from_station)
            {
                $passenger_start_time = $station_time[$i]['time'];
            }

            if($station_time[$i]['station_id']==$to_station)
            {
                $passenger_stop_time = $station_time[$i]['time'];
            }
        }
        $chk_booking_exist = DB::table('bookings')
                            ->where([
                                'train_id'=>$train_id,
                                'compartment_number' => $compartment_id,
                                'seat_number' => $seat,
                                'booked_date' => date("Y-m-d", strtotime($sdate))
                            ])
                            ->whereBetween('booked_time', [$passenger_start_time, $passenger_stop_time
                            ])->count();
        
        if($chk_booking_exist==0)
        {
            $seat_status = "true";
        } else {
            $seat_status = "false";
        }


        if($seat == '1')
        {
            $after_seat = $seat+1;
            $before_seat_status = "free";
            $chk_afterSeat_booking_exist = DB::table('bookings')
                            ->where([
                                'train_id'=>$train_id,
                                'compartment_number' => $compartment_id,
                                'seat_number' => $after_seat,
                                'booked_date' => date("Y-m-d", strtotime($sdate))
                            ])
                            ->whereBetween('booked_time', [$passenger_start_time, $passenger_stop_time
                            ])->count();

            if($chk_afterSeat_booking_exist > 0)
            {
                $after_seat_status = 'occupied';
            } else {
                $after_seat_status = 'free';
            }
        } else {
            $after_seat = $seat+1;
            $before_seat = $seat-1;
            $chk_afterSeat_booking_exist = DB::table('bookings')
                            ->where([
                                'train_id'=>$train_id,
                                'compartment_number' => $compartment_id,
                                'seat_number' => $after_seat,
                                'booked_date' => date("Y-m-d", strtotime($sdate))
                            ])
                            ->whereBetween('booked_time', [$passenger_start_time, $passenger_stop_time
                            ])->count();

            if($chk_afterSeat_booking_exist > 0)
            {
                $after_seat_status = 'occupied';
            } else {
                $after_seat_status = 'free';
            }
            
            $chk_beforeSeat_booking_exist = DB::table('bookings')
                            ->where([
                                'train_id'=>$train_id,
                                'compartment_number' => $compartment_id,
                                'seat_number' => $before_seat,
                                'booked_date' => date("Y-m-d", strtotime($sdate))
                            ])
                            ->whereBetween('booked_time', [$passenger_start_time, $passenger_stop_time
                            ])->count();

            if($chk_beforeSeat_booking_exist > 0)
            {
                $before_seat_status = 'occupied';
            } else {
                $before_seat_status = 'free';
            }
        }
        
        return response()->json(['status'=>$seat_status,'after_seat_status'=>$after_seat_status,'before_seat_status'=>$before_seat_status]);

    }

    public function saveBooking(Request $request)
    {
        $from_station = $request->from_station;
        $to_station = $request->to_station;
        $sdate = $request->sdate;
        $user_id = Auth::user()->id;
        $compartment_id = $request->compartment_id;
        $train_id = $request->train_id;
        $seat = $request->seat;

        if($from_station<$to_station)
        {
            $going_to = 'Petta';
            $order_by = 'asc';
        } else {
            $going_to = 'Aluva';
            $order_by = 'desc';
        }

        $stations = DB::table('stations')->orderBy('id', $order_by)->get();
        $start_time = "08:00";
        foreach($stations as $st)
        {
            $station_time[] = array('station_id' => $st->id, 'time' => $start_time);
            if($st->station_name == 'Muttom' || $st->station_name == 'Palarivattom')
            {
                $start_time = strtotime("+12 minutes", strtotime($start_time));
                $start_time = date('h:i', $start_time);
            } else 
            {
                $start_time = strtotime("+10 minutes", strtotime($start_time));
                $start_time = date('h:i', $start_time);
            }
        }
        
        for($i=0;$i<count($station_time);$i++)   
        {
            if($station_time[$i]['station_id']==$from_station)
            {
                $passenger_start_time = $station_time[$i]['time'];
            }

            if($station_time[$i]['station_id']==$to_station)
            {
                $passenger_stop_time = $station_time[$i]['time'];
            }
        }

        $booked_date = date("Y-m-d", strtotime($sdate));  
        DB::table('bookings')->insert([
            'booked_date' => $booked_date,
            'booked_time' => $passenger_start_time,
            'train_id' => $train_id,
            'from_station' => $from_station,
            'to_station' => $to_station,
            'compartment_number' => $compartment_id,
            'seat_number' => $seat,
            'user_id' => $user_id
        ]);

        return response()->json(['saved_status'=>"success"]);
    }
}
