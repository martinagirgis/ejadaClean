<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ComplaintsList;
use Illuminate\Support\Facades\Auth;

class ComplaintsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaintsLists = ComplaintsList::get();
        return view('cleanMaintananceManager.ComplaintsList.index', compact('complaintsLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fcilities = Facility::where('branch_id',  Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        return view('cleanMaintananceManager.ComplaintsList.create', compact('fcilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ComplaintsList::create([
            'name' => $request->name,
            'facility_id' => $request->facility_id,
            'type' => $request->type,
        ]);
        return redirect()->route('complaintsLists.index')->with('success', 'تم الاضافة بنجاح');
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
        $complaintsList = ComplaintsList::find($id);
        $fcilities = Facility::where('branch_id',  Auth::guard('clean_mantanance_manager')->user()->branch->id)->get();
        return view('cleanMaintananceManager.ComplaintsList.edit', compact('fcilities','complaintsList'));
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
        $complaintslist = ComplaintsList::find($id);

        $complaintslist->update([
            'name' => $request->name,
            'facility_id' => $request->facility_id,
            'type' => $request->type,
        ]);

        return redirect()->route('complaintsLists.index')->with('success', 'تم التعديل بنجاح');
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
