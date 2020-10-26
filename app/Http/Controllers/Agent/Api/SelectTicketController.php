<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SelectTicket;
use App\BusSchedule;
use App\SeatReserve;

class SelectTicketController extends Controller
{
    public function select(Request $request)
    {
        SelectTicket::whereTime('time', '<', now())->delete();

        $seat = SelectTicket::create([
            'seat' => $request->seat,
            'bus_schedule_id' => $request->bus_schedule_id ,
            'date' => $request->date,
            'time' => date('H:i:s', strtotime("+1 minutes"))
        ]);

        return response([
            'status' => 200,
            'success' => true,
            'data' => $seat
        ], 200);
    }

    public function get($seat, $id, $date)
    {
        SelectTicket::whereTime('time', '<', now())->delete();
        $result = SelectTicket::where('seat', $seat)->where('bus_schedule_id', $id)->where('date', $date)->first();

        if(empty($result))
        {
            $result = BusSchedule::whereHas('tickets', function($query) use ($seat, $date){
                $query->where('date', $date)->whereHas('ticket_seat', function($query) use ($seat){
                    $query->where('seat_id', $seat);
                });
            })->where('id', $id)->first();

            if(empty($result))
            {
                $result = SeatReserve::where('seat', $seat)->where('bus_schedule_id', $id)->where('date', $date)->first();
                if(empty($result))
                {
                    return response([
                        'status' => 200,
                        'success' => false,
                        'data' => null
                    ], 200);
                }

                return response([
                    'status' => 200,
                    'success' => true,
                    'data' => 'reserved'
                ], 200);
            }

            return response([
                'status' => 200,
                'success' => true,
                'data' => 'booked'
            ], 200);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => 'selected'
        ], 200);
    }

    // public function test($seat, $id, $date)
    // {
    //     $seat = BusSchedule::whereHas('tickets', function($query) use ($seat, $date){
    //         $query->where('date', $date)->whereHas('ticket_seat', function($query) use ($seat){
    //             $query->where('seat_id', $seat);
    //         });
    //     })->where('id', $id)->first();

    //     if(empty($seat))
    //     {
    //         return response([
    //             'status' => 200,
    //             'success' => true,
    //             'data' => null
    //         ], 200);
    //     }

    //     return response([
    //         'status' => 200,
    //         'success' => true,
    //         'data' => $seat
    //     ], 200);
    // }

    public function remove(Request $request, $seat, $id, $date)
    {
        $seat = SelectTicket::where('seat', $seat)->where('bus_schedule_id', $id)->where('date', $date)->delete();

        if($seat)
        {
            return response([
                'status' => 200,
                'success' => true
            ], 200);
        }

        return response([
            'status' => 400,
            'success' => true
        ], 400);
    }

}
