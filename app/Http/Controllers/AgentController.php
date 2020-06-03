<?php

namespace App\Http\Controllers;

use App\Client;
use App\Mail\MessageToClient;
use App\RealEstate;
use App\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function estates() {
        // $estates = RealEstate::withCount(['clients'])->with('category', 'reviews')
        //     ->whereAgentId(auth()->user()->agent->id)->paginate(5);

            $estates = RealEstate::withCount(['clients'])->with('category', 'reviews')
            ->whereAgentId(auth()->user()->agent->id)->withTrashed()->paginate(5);
        return view('agents.estates', compact('estates'));
    }

    public function clients() {
        $clients = Client::with('user', 'realEstate.reviews')
            ->whereHas('realEstate', function($q) {
                // $q->where('agent_id', auth()->user()->agent->id)->select('id', 'agent_id', 'name');
                $q->where('agent_id', auth()->user()->agent->id)->select('id', 'agent_id', 'name')->withTrashed();
            })->get();

        $actions = 'clients.datatables.actions';

        return \DataTables::of($clients)->addColumn('actions', $actions)->rawColumns(['actions'])->make(true);
    }

    public function sendMessageToClient() {
        $info = \request('info');
        $data = [];
        parse_str($info, $data);
        $user = User::findOrFail($data['user_id']);
        try {
            \Mail::to($user)->send(new MessageToClient( auth()->user()->name, $data['message'] ));
            $success = true;
        } catch (\Exception $exception) {
            $success = false;
        }

        return response()->json(['res' => $success]);
    }
}
