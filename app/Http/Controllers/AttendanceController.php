<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Attendance;
use App\Company;
use App\Http\Requests\ReportAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Mesmo se o agente, usuário e empresa estiverem "deletada" poderá ver o atendimento, pois é um histórico.
        $attendances = Attendance::with([
            'agent' => function($query) {
                $query->withTrashed();
            }
        ])
        ->orderByDesc('id')
        ->get();

        return view('attendance.index', ['attendances' => $attendances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param StoreAttendanceRequest $request
     * @return mixed
     */
    public function store(StoreAttendanceRequest $request)
    {
        try {
            $request['note'] = str_replace(["'", '"'], '', $request['note']);
            Attendance::create($request->all() + ['user_id' => auth()->id()]);
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Atendimento não cadastrado! Verifique com o suporte.');
        }

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
     * @param Attendance $attendance
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Attendance $attendance)
    {
        $attendance = $attendance->with(['agent' => function($query) {
                                            $query->withTrashed();
                                        }])->first();
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
     * @param UpdateAttendanceRequest $request
     * @param Attendance $attendance
     * @return mixed
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        try {
            $attendance = Attendance::findOrFail($attendance->id);
            $attendance->update($request->all());
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Atendimento não atualizado! Verifique com o suporte.');
        }

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
        try {
            $attendance->delete();
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Atendimento não deletado! Verifique com o suporte.');
        }

        return back()->withSuccess('Atendimento deletado!');
    }

    /**
     * Display view report
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report()
    {
        $companies = Company::all();
        return view('report.attendance', ['companies' => $companies]);
    }

    /**
     * Download this file from database.
     *
     * @param ReportAttendanceRequest $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(ReportAttendanceRequest $request)
    {
        $company = Company::find($request->company_id);
        return Excel::download(new AttendanceExportController($request->company_id, $request->month, $request->year), "$company->name-$request->month-$request->year.xlsx");
    }
}
