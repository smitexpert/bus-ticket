<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SeatReserve;

class TicketReservation extends Controller
{
    public function reserve(Request $request)
    {

        $request->validate([
            'seat' => 'required'
        ]);

        for($i=0; $i<count($request->seat); $i++)
        {
            $seat[] = [
                'seat' => $request->seat[$i],
                'bus_schedule_id' => $request->bus_schedule_id,
                'date' => $request->date
            ];
        }

        $ins = SeatReserve::insert($seat);

        if($ins){
            return response([
                'status' => 200,
                'success' => true
            ], 200);
        }
        
        return response([
            'status' => 400,
            'success' => false
        ], 400);
    }

    public function seats($id, $date)
    {
        $seats = SeatReserve::where('bus_schedule_id', $id)->where('date', $date)->get();
        
        return response([
            'status' => 200,
            'success' => true,
            'data' => $seats
        ], 200);
    }

    public function remove($seat, $id, $date)
    {
        SeatReserve::where('seat', $seat)->where('bus_schedule_id', $id)->where('date', $date)->delete();

        return response([
            'status' => 200,
            'success' => true
        ], 200);
    }
}
