<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use App\Models\CertificationType;
use App\Models\EmployeeCertification;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Inertia::render('Dashboard');
    }
    public function upload_file() {
        return Inertia::render('Upload');
    }
    public function certificationData() {
        $cert_data = CertificationType::all()
        ->map( function($query){
            return [
                'text' =>  strtoupper($query->cert_types),
                'value' => $query->cert_types
            ];
        })->toArray();

         $header_default_1 = [['text'=>'OCN','align'=>'start','sortable'=>'false', 'value'=>'id'],['text'=>'Employee Name','value'=>'name']];
         $header_default_2 = [['text'=>'Action','value'=>'actions', 'sortable'=>'false']];
        return response()->json(array_merge($header_default_1,$cert_data,$header_default_2));
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
        //
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
}
