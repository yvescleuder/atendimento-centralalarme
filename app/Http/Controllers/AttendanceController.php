<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Attendance;
use App\Company;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::orderBy('id', 'DESC')->get();
        return view('attendance.index', ['attendances' => $attendances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $agents = Agent::all();
        $requesters = Attendance::groupBy('requester')
            ->selectRaw('requester as name')
            ->get();
        return view('attendance.create', ['companies' => $companies, 'agents' => $agents, 'requesters' => $requesters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        $request['note'] = str_replace(["\r\n", "\n", "\r"], '<br />', $request['note']);
        $request['note'] = str_replace(["'", '"'], '', $request['note']);
        Attendance::create($request->all() + ['user_id' => 1]);
        return redirect()->route('attendance.index')->withSuccess('Atendimento finalizado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $attendance = Attendance::findOrFail($attendance->id);
        $companies = Company::all();
        $agents = Agent::all();
        $requesters = Attendance::groupBy('requester')
            ->selectRaw('requester as name')
            ->get();
        return view('attendance.edit', ['attendance' => $attendance, 'companies' => $companies, 'agents' => $agents, 'requesters' => $requesters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance = Attendance::find($attendance->id);
        $attendance->update($request->all());
        return redirect()->route('attendance.index')->withSuccess('Atendimento atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
