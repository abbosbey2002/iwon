<?php

namespace App\Http\Controllers\Admin;


use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('settings.index');
    }

    public function policy()
    {
        $policy = Policy::first();
        return view('admin.policy', compact('policy'));
    }


    public function policyUpdate(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'editor1' => 'required|string',
    ]);

    $policy = Policy::query()->first();

    $policy->title=$request->title;
    $policy->content=$request->editor1;
    $policy->save();

    return redirect()->route('admin.policy.index')->with('success', 'Policy updated successfully.');
}
}
