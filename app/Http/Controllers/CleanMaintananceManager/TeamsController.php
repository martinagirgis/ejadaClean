<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TeamMember;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\For_;

class TeamsController extends Controller
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
        $teams = Team::where('clean_mantanance_manager_id', Auth::guard('clean_mantanance_manager')->id())->get();
        return view('cleanMaintananceManager.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cleanMaintananceManager.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teamId = Team::insertGetId([
            'name' => $request->name,
            'leader_name' => $request->leader_name,
            'leader_phone' => $request->leader_phone,
            'clean_mantanance_manager_id' => Auth::guard('clean_mantanance_manager')->id(),
        ]);

        for ($i=0; $i < intval($request->memberNum); $i++) { 
            TeamMember::create([
                'name' => $request['name'.$i],
                'phone' => $request['phone'.$i],
                'team_id' => $teamId,
            ]);
        }

        return redirect()->route('teams.index')->with('success', 'تم الاضافة بنجاح');
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
        $team = Team::find($id);
        return view('cleanMaintananceManager.teams.edit', compact('team'));
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
        $team = Team::find($id);

        $team->update([
            'name' => $request->name,
            'leader_name' => $request->leader_name,
            'leader_phone' => $request->leader_phone,
        ]);
        for ($i=0; $i < count($team->members); $i++) { 
            $member = TeamMember::find($team->members[$i]->id);
            $member->update([
                'name' => $request['name'.$member->id],
                'phone' => $request['phone'.$member->id],
            ]);
        }
        return redirect()->route('teams.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Team::find($id);
        $old->delete();
        return redirect()->route('teams.index')->with('success', 'تم الحذف بنجاح');
    }

    public function deleteMember($id)
    {
        $old = TeamMember::find($id);
        $old->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
