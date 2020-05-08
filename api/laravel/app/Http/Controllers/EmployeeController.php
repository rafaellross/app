<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use DB;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::select(
            DB::raw(
                "select emp.id,
                        emp.name,
                        emp.phone,
                        emp.dob,
                        jobs.code as job_code,
                        emp.location,
                        emp.inactive,
                        emp.anniversary_dt,
                        emp.company,
                        emp.bonus,
                        emp.bonus_type,
                        emp.car_allowance,
                        emp.apprentice_year,
                        CAST(emp.rdo_bal AS DECIMAL(12,2)) as rdo_bal,
                        CAST(emp.pld AS DECIMAL(12,2)) as pld,
                        CAST(emp.anl AS DECIMAL(12,2)) as anl,
                        CAST(emp.sick_bal AS DECIMAL(12,2)) as sick_bal,
                        if(YEARWEEK(emp.anniversary_dt) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1))-1, 1, 0) as rollover,
                        (select id from time_sheets where employee_id = emp.id and YEARWEEK(week_end) = YEARWEEK((SELECT week_end_timesheet FROM parameters LIMIT 1)) order by id desc limit 1) as last_timesheet
                        from employees emp
                        left join jobs
                        on emp.job_id = jobs.id"));
        return $employees;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->phone = $request->input('phone');
        $employee->bonus = $request->input('bonus');
        $employee->car_allowance = $request->input('car_allowance');
        $employee->pld = $request->input('pld');
        $employee->rdo_bal = $request->input('rdo_bal');
        $employee->anl = $request->input('anl');
        $employee->dob = $request->input('dob');

        $employee->anniversary_dt = is_null($request->input('anniversary_dt')) ? null : $request->input('anniversary_dt');

        $employee->apprentice_year = $request->input('apprentice_year');

        $employee->location = $request->input('location');

        $employee->inactive = is_null($request->input('inactive')) ? 0 : $request->input('inactive');
        $employee->company = $request->input('company');
        $employee->rdo = false;
        $employee->travel = false;
        $employee->site_allow = false;
        $employee->entitled_anl = false;
        $employee->entitled_pld = false;
        $employee->bonus_type = $request->input('bonus_type');

        $employee->save();
        return 200;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $employee->name = $request->input('name');
        $employee->phone = $request->input('phone');
        $employee->bonus = $request->input('bonus');
        $employee->car_allowance = $request->input('car_allowance');
        $employee->pld = $request->input('pld');
        $employee->rdo_bal = $request->input('rdo_bal');
        $employee->anl = $request->input('anl');
        $employee->dob = $request->input('dob');

        $employee->anniversary_dt = is_null($request->input('anniversary_dt')) ? null : $request->input('anniversary_dt');

        $employee->apprentice_year = $request->input('apprentice_year');

        $employee->location = $request->input('location');

        $employee->inactive = $request->input('inactive');
        $employee->company = $request->input('company');
        $employee->rdo = false;
        $employee->travel = false;
        $employee->site_allow = false;
        $employee->entitled_anl = false;
        $employee->entitled_pld = false;
        $employee->bonus_type = $request->input('bonus_type');

        $employee->save();
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
