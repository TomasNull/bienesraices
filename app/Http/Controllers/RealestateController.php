<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\EstateRequest;
use App\Mail\ClientSaveEstate;
use App\RealEstate;
use App\Reviews;

class RealestateController extends Controller
{
    public function show (RealEstate $estate) {
        $estate->load([
            'category' => function ($q) {
                $q->select('id', 'name');
            },
            'reviews.user',
            'agent'
        ])->get();

        $related = $estate->relatedEstates();

        return view('realestates.detail', compact('estate', 'related'));
    }

    public function inscribe (RealEstate $estate) {
        //dd($estate);

        //preview del correo
        //return new ClientSaveEstate( $estate, "admin");

        $estate->clients()->attach(auth()->user()->client->id);

        \Mail::to($estate->agent->user)->send(new ClientSaveEstate($estate, auth()->user()->name));
        
        return back()->with('message', ['success', __("Añadido a favoritos")]);
    }

    public function subscribed () {
        $estates = RealEstate::whereHas('clients', function($query) {
            $query->where('client_id', auth()->id());
        })->get();
        
        return view('realestates.subscribed', compact('estates'));
    }

    public function addReview() {
        Reviews::create([
            "real_estate_id" => request('estate_id'),
            "user_id" => auth()->id(),
            "rating" => (int) request('rating_input'),
            "comment" => request('message')
        ]);

        return back()->with('message', ['success', __("Muchas gracias por tu valoración")]);
    }

    public function create() {
        $estate = new RealEstate;
        $btnText = __("Enviar publicación para revisión");
        return view('realestates.form', compact('estate', 'btnText'));
    }

    public function store(EstateRequest $estate_request) {
        //dd($estate_request->all());
        $picture = Helper::uploadFile('picture', 'realestates');
        //dd($picture);

        $estate_request->merge(['picture' => $picture]);
        $estate_request->merge(['agent_id' => auth()->user()->agent->id]);
        $estate_request->merge(['status' => RealEstate::PENDING]);
        //dd($estate_request);

        RealEstate::create($estate_request->except('_token'));

        return back()->with('message', ['success', __('Inmueble enviado correctamente, recibirá un correo con cualquier información')]);
    }

    public function edit($slug) {
        $estate = RealEstate::whereSlug($slug)->first();

        $btnText = __("Actualizar inmueble");
        return view('realestates.form', compact('estate', 'btnText'));
    }

    public function update(EstateRequest $estate_request, RealEstate $estate) {
        if($estate_request->hasFile('picture')) {
            \Storage::delete('realestates/' . $estate->picture);
            $picture = Helper::uploadFile("picture", 'realestates');
            $estate_request->merge(['picture' => $picture]);
        }
        $estate->fill($estate_request->input())->save();
        $newSlug = $estate->slug;

        return redirect("realestates/$newSlug/edit")->with('message', ['success', __('Inmueble actualizado')]);
    }

    public function destroy(RealEstate $estate) {
        try {
            $borrar = RealEstate::find($estate->id);
            //$estate->delete();
            $borrar->delete();
            return back()->with('message', ['success', __('Publicación eliminada correctamente')]);
        } catch (\Exception $exception) {
            return back()->with('message', ['succes', __('Error al eliminar la publicación. Contacte con el administrador.')]);
        }
    }
}
