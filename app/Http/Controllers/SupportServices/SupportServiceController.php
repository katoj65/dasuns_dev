<?php

namespace App\Http\Controllers\SupportServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SupportServiceModel;

class SupportServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
$data['title']='Support Services';
$data['response']=[
'service'=>SupportServiceModel::orderby('name','ASC')->get(),



];

return Inertia::render('SupportServicesPage',$data);


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


//support service list
public function support_services_list(Request $request){
$data['title']='Support Services';
$data['response']=[];
return Inertia::render('SupportServicesList',$data);

}


//get support services by ID

static function support_servicebyID($id){
$get=SupportServiceModel::where('id',$id)->limit(1)->get();
$row=null;
if(count($get)==1){
foreach($get as $row);
}
return $row;
}











}

