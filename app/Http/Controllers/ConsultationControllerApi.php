<?php

namespace App\Http\Controllers;

use App\Consultation;
use Illuminate\Http\Request;

class ConsultationControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consultation = new Consultation();
        $consultation->user_id = $request->input('user_id');
        $consultation->sleep_time = $request->input('sleep_time');
        $consultation->weight = $request->input('weight');
        $consultation->pregnancy_age = $request->input('pregnancy_age');
        $consultation->calorie = $request->input('calorie');
        $consultation->activity = $request->input('activity');
        $consultation->created_at = date('Y-m-d H:i:s');
        $message = "Consultation Added Successfully";
        $error = false;
        try {
            $consultation->save();
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = true;
        }
        return json_encode([
            'message' => $message,
            'error' => $error
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getConsultation($id)
    {
        $consultation = Consultation::find($id);
        return json_encode($consultation);
    }

    public function getUserConsultations($id)
    {
        $c_repo = new Consultation();
        $consultations = $c_repo->getUserConsultations($id);
        return json_encode([
            'consultation_list' => $consultations
        ]);
    }
}
