<?php

namespace App\Http\Controllers;

use App\Mail\EstateApproved;
use App\Mail\EstateRejected;
use App\RealEstate;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function realestates() {
        return view('admin.realestates');
    }

    public function realestatesJson() {
        if(\request()->ajax()) {
            $vueTables = new EloquentVueTables;
            $data = $vueTables->get(new RealEstate, ['id', 'name', 'status'], ['reviews']);
            return response()->json($data);
        }
        return abort(401);
    }

    public function updateRealestatesStatus() {
        if(\request()->ajax()) {
            $estate = RealEstate::find(\request('realestateId'));
            
            if( //Si el status es distinto de publicado, el estate no ha sido publicado previamente y el status del estate enviado es publicado
                (int) $estate->status !== RealEstate::PUBLISHED && 
                ! $estate->previous_approved && 
                \request('status') === RealEstate::PUBLISHED
            ) {
                 $estate->previous_approved = true;
                 \Mail::to($estate->agent->user)->send(new EstateApproved($estate));
            }

            if( //Si el status es distinto de rechazado, el estate no ha sido rechazado previamente y el status del estate enviado es rechazado
                (int) $estate->status !== RealEstate::REJECTED && 
                ! $estate->previous_rejected && 
                \request('status') === RealEstate::REJECTED
            ) {
                 $estate->previous_rejected = true;
                 \Mail::to($estate->agent->user)->send(new EstateRejected($estate));
            }

            $estate->status = \request('status');
            $estate->save();
            return response()->json(['msg', 'OK']);
        }
        return abort(401);
    }
}
