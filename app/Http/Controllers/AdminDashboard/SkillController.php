<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Requests\CategoryRequest;
class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::paginate(5);
		return view('dashboard.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::get();
        return view('dashboard.skills.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',

        ]) ;

        $data = $request->all();
       $skill= Skill::create($data);
        return redirect()->route('skills.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);
        return View('dashboard.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',

        ]) ;
        $skill = Skill::findOrFail($id);
        $skill->update($request->all());
        return redirect()->route('skills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('skills.index');
    }
}
