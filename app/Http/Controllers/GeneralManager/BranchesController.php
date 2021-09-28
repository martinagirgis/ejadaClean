<?php

namespace App\Http\Controllers\GeneralManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company_general_manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::where('company_id', Auth::guard('company_general_manager')->id())->get();
        return view('generalManager.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('generalManager.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Branch::create([
            'name' => $request->name,
            'company_id' => Auth::guard('company_general_manager')->id(),
        ]);
        return redirect()->route('branches.index')->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::find($id);
        return view('generalManager.branchs.show', compact('qualityManager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('generalManager.branches.edit', compact('branch'));
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
        $branch = Branch::find($id);

        $branch->update([
            'name' => $request->name,
        ]);

        return redirect()->route('branches.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = Branch::find($id);
        $old->delete();
        return redirect()->route('branches.index')->with('success', 'تم الحذف بنجاح');
    }
}
