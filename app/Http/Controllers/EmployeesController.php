<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\PayHistory;

class EmployeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->image_path = public_path('/images');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::getBalancePerEmployee();
        return view('home', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'firstname' => 'required|min:5|max:255',
            'lastname' => 'required|min:5|max:255',
            'dob' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email'
        ]);

        $employee = new Employee;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $original_file_name = $file->getClientOriginalName();
            $file_name = str_replace(' ','-',$original_file_name);
            $file->move($this->image_path, $file_name);
            $employee->image = $file_name;
        }
        
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->dob = date('Y-m-d', strtotime($request->dob));
        $employee->contact_number = $request->contact_number;
        $employee->email = $request->email;
        $employee->save();
        return redirect('/employees')->with(['msg' => 'Record successfully added!']);
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
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
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
        $validator = $request->validate([
            'firstname' => 'required|min:5|max:255',
            'lastname' => 'required|min:5|max:255',
            'dob' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email'
        ]);

        // if ($validator->fails()) {
        //     Session::flash('error', $validator->messages()->first());
        //     return redirect()->back()->withInput();
        // }

        $employee = Employee::findOrFail($id);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $original_file_name = $file->getClientOriginalName();
            $file_name = str_replace(' ','-',$original_file_name);
            $file->move($this->image_path, $file_name);
            $employee->image = $file_name;
        }
        
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->dob = date('Y-m-d', strtotime($request->dob));
        $employee->contact_number = $request->contact_number;
        $employee->email = $request->email;
        $employee->save();
        return redirect('/employees')->with(['msg' => 'Record successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return back()->with(['msg', 'Record deleted!']);
    }

    public function addpay($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->get();
        $pay_history = $employee->payhistory()->orderBy('created_at', 'desc')->paginate(10);
        $employee->balance = $employee->payhistory()->sum('amount');
        return view('employees.addpay', compact('employee', 'pay_history'));
    }

    public function add_payment(Request $request)
    {
        // dd($request);
        if($request->amount >= 100000){
            return back()->with('payment-message', 'Amount entered exceeded Php 100,000.00');
        } else {
            //store and refresh page
            $payment = new PayHistory();
            $payment->employees_id = $request->employee_id;
            $payment->amount = $request->amount;
            $payment->save();

            return back()->with('msg', 'Payment successfully added');
        }
    }

    public function payhistory($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->get();
        $pay_history = $employee->payhistory()->orderBy('created_at', 'desc')->paginate(10);
        $employee->balance = $employee->payhistory()->sum('amount');
        return view('employees.pay-history', compact('employee', 'pay_history'));
    }
}
