<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreCategoryRequest;
use App\Models\Log;
use App\Models\ScoreCategory;
use Illuminate\Http\Request;

class ScoreCategoriesController extends Controller
{
    private $scoreCategories;

    public function __construct()
    {
        $this->middleware('auth');

        $this->scoreCategories = resolve(ScoreCategory::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scoreCategories = $this->scoreCategories->paginate();
        return view('pages.score-categories', compact('scoreCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.score-categories_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoreCategoryRequest $request)
    {
        ScoreCategory::create([
            'name' => $request->input('name')
        ]);

        Log::create([
            'description' => auth()->user()->employee->name . " đã tạo một danh mục điểm có tên '" . $request->input('name') . "'"
        ]);

        return redirect()->route('score-categories')->with('status', 'Tạo danh mục điểm thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScoreCategory  $scoreCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ScoreCategory $scoreCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScoreCategory  $scoreCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoreCategory $scoreCategory)
    {
        return view('pages.score-categories_edit', compact('scoreCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreCategory  $scoreCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoreCategory $scoreCategory)
    {
        ScoreCategory::whereId($scoreCategory->id)
            ->update([
            'name' => $request->input('name')
        ]);

        Log::create([
            'description' => auth()->user()->employee->name . " đã cập nhật danh mục điểm từ '" . $scoreCategory->name . "' thành '" . $request->input('name') . "'"
        ]);

        return redirect()->route('score-categories')->with('status', 'Cập nhật danh mục điểm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoreCategory  $scoreCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreCategory $scoreCategory)
    {
        ScoreCategory::whereId($scoreCategory->id)->delete();

        Log::create([
            'description' => auth()->user()->employee->name . " đã xóa danh mục điểm có tên '" . $scoreCategory->name . "'"
        ]);

        return redirect()->route('score-categories')->with('status', 'Xóa danh mục điểm thành công.');
    }

    public function print ()
    {
        $scoreCategories = $this->scoreCategories->all();
        return view('pages.score-categories_print', compact('scoreCategories'));
    }
}
