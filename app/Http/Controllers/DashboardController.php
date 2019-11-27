<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $attendances = [];
        foreach($companies as $company) {

            $attendances[$company->id] = $company;
            $month = "";

            for($i = 1; $i <= date('m'); $i++) {
                $monthObg = Attendance::groupBy('company_id')
                    ->selectRaw('count(*) as attendancesMonth')
                    ->join('companies', 'attendances.company_id', 'companies.id')
                    ->where('companies.id', '=', $company->id)
                    ->whereMonth('attendances.created_at', $i)
                    ->whereYear('attendances.created_at', date("Y"))
                    ->get();

                if($monthObg->isEmpty())
                    $month = $month."0, ";
                else
                    $month = $month.$monthObg[0]->attendancesMonth.", ";
            }

            $attendances[$company->id]['month'] = $month;
        };

        return view('index', ['attendances' => $attendances]);
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
