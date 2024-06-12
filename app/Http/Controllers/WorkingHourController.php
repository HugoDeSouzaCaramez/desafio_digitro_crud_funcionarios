<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingHour;
use App\Models\Employer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\StoreWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;

class WorkingHourController extends Controller
{
    public function index()
    {
        $workingHours = WorkingHour::orderBy('date', 'desc')->paginate(10);

        foreach ($workingHours as $workingHour) {
            $workingHour->date = Carbon::parse($workingHour->date)->format('d-m-Y');
        }
        
        return view('working_hours.index', ['workingHours' => $workingHours]);
    }

    public function create()
    {
        $employers = Employer::all();
        return view('working_hours.create', compact('employers'));
    }

    public function store(StoreWorkingHourRequest $request)
    {
        WorkingHour::create($request->all());

        return redirect()->route('working-hours.index')->with('success', 'Hora lançada com sucesso!');
    }

    public function edit($id)
    {
        $workingHour = WorkingHour::findOrFail($id);
        return view('working_hours.edit', compact('workingHour'));
    }

    public function update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->all());

        return redirect()->route('working-hours.index')->with('success', 'Hora lançada com sucesso!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $dates = DB::table('working_hours')
                ->where(DB::raw('DATE_FORMAT(date, "%Y-%m-%d")'), 'LIKE', '%' . $query . '%')
                ->get();

        foreach ($dates as $date) {
            $date->date = Carbon::parse($date->date)->format('d-m-Y');
        }

        return response()->json($dates);
    }
}