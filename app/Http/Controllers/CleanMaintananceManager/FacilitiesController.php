<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Facility;
use App\models\Supervisor;
use Illuminate\Http\Request;
use App\models\FacilityTimes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FacilitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clean_mantanance_manager');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)
            ->with('times')->get();
           
        return view('cleanMaintananceManager.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cleanMaintananceManager.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Facility::create([
            'name' => $request->name,
            'branch_id' => Auth::guard('clean_mantanance_manager')->user()->branch->id,
        ]);
        return redirect()->route('facilities.index')->with('success', 'تم الاضافة بنجاح');
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
        $facility = Facility::find($id);
        $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        return view('cleanMaintananceManager.facilities.edit', compact('facility','supervisors'));
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
        $facility = Facility::find($id);

        $facility->update([
            'name' => $request->name,
        ]);

        for ($i=0; $i < count($facility->times); $i++) { 
            $time = FacilityTimes::find($facility->times[$i]->id);
            $time->update([
                'day' => $request['day|'.$time->id],
                'time' => $request['time|'.$time->id],
                'period' => $request['period|'.$time->id],
                'employee_id' => $request['employee_id|'.$time->id],
            ]);
        }

        return redirect()->route('facilities.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Facility::find($id);
        $old->delete();
        return redirect()->route('facilities.index')->with('success', 'تم الحذف بنجاح');
    }

    public function cleanAddtimes($id)
    {
        $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        $facility = $id;
        return view('cleanMaintananceManager.facilities.cleanaddtimes', compact('supervisors','facility'));
    }

    public function cleanStoretimes(Request $request, $id)
    {
        for ($i=0; $i < intval($request->timesnum); $i++) { 
            FacilityTimes::create([
                'day' => $request->day,
                'time' => $request['time'.$i],
                'period' => $request['period'.$i],
                'type' => 'clean',
                'employee_id' => $request['employee_id'.$i],
                'facility_id' => $id,
            ]);
        }
        return redirect()->route('facilities.index')->with('success', 'تم الاضافة بنجاح');
    }

    public function mantananceAddtimes($id)
    {
        $supervisors = Supervisor::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        $facility = $id;
        return view('cleanMaintananceManager.facilities.mantananceaddtimes', compact('facility','supervisors'));
    }

    public function mantananceStoretimes(Request $request, $id)
    {
        for ($i=0; $i < intval($request->timesnum); $i++) { 
            FacilityTimes::create([
                'day' => $request->day,
                'time' => $request['time'.$i],
                'period' => $request['period'.$i],
                'type' => 'maintatance',
                'employee_id' => $request['employee_id'.$i],
                'facility_id' => $id,
            ]);
        }
        return redirect()->route('facilities.index')->with('success', 'تم الاضافة بنجاح');
    }

    public function deleteTime($id)
    {
        $old = FacilityTimes::find($id);
        $old->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
