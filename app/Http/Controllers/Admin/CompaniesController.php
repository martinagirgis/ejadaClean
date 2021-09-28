<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\models\CompanyPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\models\CompanyGeneralManager;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = CompanyGeneralManager::get();
        return view('admin.companies.index', compact('companies'));
    }

    public function getPasswords($id)
    {
        $companyPasswords = CompanyPassword::where('company_id', $id)->get();
        return view('admin.companies.passwords.index', compact('companyPasswords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:company_general_managers'],
        ];

        $this->validate($request,$rules);
        CompanyGeneralManager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'commercial_register' => $request->commercial_register,
        ]);
        return redirect()->route('companies.index')->with('success', 'تم اضافة الشركة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = CompanyGeneralManager::find($id);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = CompanyGeneralManager::find($id);
        return view('admin.companies.edit', compact('company'));
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
        $company = CompanyGeneralManager::find($id);

        $rules = [
            'email' => ['required', 'email', 'max:255', 'unique:company_general_managers,email,' . $company->id ],
        ];

        $this->validate($request,$rules);

        if($company->real_password != $request->password)
        {
            CompanyPassword::create([
                'new_real_password' => $request->password,
                'new_password' => Hash::make($request->password),
                'old_real_password' => $company->real_password,
                'old_password' => $company->password,
                'date' => date("Y-m-d"),
                'company_id' => $company->id,
            ]);
        }
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'real_password' => $request->password,
            'phone' => $request->phone,
            'job_num' => $request->job_num,
            'id_num' => $request->id_num,
            'commercial_register' => $request->commercial_register,
        ]);
        return redirect()->route('companies.index')->with('success', 'تم تعديل الشركة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $old = CompanyGeneralManager::find($id);
        $old->delete();
        return redirect()->route('companies.index')->with('success', 'تم الحذف بنجاح');
    }
}
