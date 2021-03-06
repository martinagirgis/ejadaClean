<?php

namespace App\Http\Controllers\CleanMaintananceManager;

use App\models\Task;
use App\models\Team;
use App\models\TeamMember;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function allTasks($id)
    {
        $tasks = Task::where('branch_id', Auth::guard('clean_mantanance_manager')->user()->branch->id)->where('support_type',1)->where('support_id',$id)->get();
        return view('cleanMaintananceManager.teams.tasks', compact('tasks'));
    }

    public function showTask($id)
    {
        $task = Task::find($id);
        return view('cleanMaintananceManager.tasks.show', compact('task'));
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

        return redirect()->route('teams.index')->with('success', '???? ?????????????? ??????????');
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
        return redirect()->route('teams.index')->with('success', '???? ?????????????? ??????????');
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
        return redirect()->route('teams.index')->with('success', '???? ?????????? ??????????');
    }

    public function deleteMember($id)
    {
        $old = TeamMember::find($id);
        $old->delete();
        return redirect()->back()->with('success', '???? ?????????? ??????????');
    }
}
