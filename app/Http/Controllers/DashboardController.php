<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use App\Models\CertificationType;
use App\Models\EmployeeCertification;
use Carbon\Carbon;


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
                'value' => $query->cert_types,
                'sortable'=>false
            ];
        })->toArray();

         $header_default_1 = [['text'=>'OCN','align'=>'start','sortable'=>'false', 'value'=>'employee_id'],['text'=>'Employee Name','value'=>'employee_name']];
         $header_default_2 = [['text'=>'Action','value'=>'actions', 'sortable'=>false]];

        //  ....................table items..........................

        $certif_type = CertificationType::all()->pluck('cert_types')->toArray();
        $certis = EmployeeCertification::all()->toArray();

        $arr = array();
        foreach($certis as $ca){
            $arr[] = array_combine($certif_type,explode(',',$ca['certification_type']));
        }
        $di=array();
        foreach($certis as $cert){
            $di[] = $cert;
        }
        $result = array();
        foreach($arr as $k => $v){
            $result[$k] = array_merge($di[$k],$arr[$k]);
        }

        return response()->json(array(array_merge($header_default_1,$cert_data,$header_default_2),$result));
    }

    public function addData(Request $request){

        EmployeeCertification::create([
            'employee_id'=>$request->employee_id,
            'employee_name'=>$request->employee_name,
            'certification_type'=>implode(',',$request->except(['employee_id','employee_name'])),
            'cert_effectivity_date'=>Carbon::now(),
            'cert_expiration_date'=>Carbon::now()
        ]);

        return response()->json("Data inserted successfully");

    }

    public function editData(Request $request){
        EmployeeCertification::where('employee_id',$request->employee_id)->update(
            [
                'employee_id'=>$request->employee_id,
                'employee_name'=>$request->employee_name,
                'certification_type'=>implode(',',$request->except(['id','employee_id','employee_name','created_at','updated_at','cert_effectivity_date','cert_expiration_date','certification_type'])),
                'cert_effectivity_date'=>Carbon::now(),
                'cert_expiration_date'=>Carbon::now()
            ]);

            return response()->json('success updated');
    }

    public function deleteData(Request $request){
        EmployeeCertification::where('employee_id',$request->employee_id)->delete();
        return response()->json('deleted updated');
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
