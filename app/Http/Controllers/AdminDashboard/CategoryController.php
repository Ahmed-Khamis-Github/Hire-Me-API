<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryRequest;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
		return view('dashboard.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('dashboard.categories.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */

	public function store(CategoryRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'description' => 'required|string|min:10'

        ]) ;
        // $slug = $request->merge([
        //     "slug"=>Str::slug($request->name)
        // ]);
        // $data = $request->validated();

		$data = $request->validated();
    $data['slug'] = Str::slug($request->name);


       $category= Category::create($data);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)

    {



        $category = Category::findOrFail($id);
        return View('dashboard.categories.edit', compact('category'));



    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'description' => 'required|string|min:10'

        ]) ;


        // \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with("message","mahsiah");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
