<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use Illuminate\Http\Request;

class DailyController extends Controller
{
    public function index()
    {
        $data=Daily::all();
        return view('daily.index',compact('data'));
    }
    public function create()
    {
        return view('daily.create');
    }

    public function insertdata(Request $request)
    {
        $dailys = Daily::create([
            'employee_id'=>$request->employee_id,
            'activity' => $request->activity,
            'progress'=> $request->progress
        ]);
        return redirect()->route('daily')->with('success', __('Award  successfully created.'));
    }
}
