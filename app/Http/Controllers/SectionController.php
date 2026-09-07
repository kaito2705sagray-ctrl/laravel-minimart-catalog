<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class SectionController extends Controller
{
    private $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function index()
    {
        $all_sections = $this->section->orderBy('id', 'asc')->get();

        return view('sections.index')->with('all_sections', $all_sections);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);

        $this->section->name = $request->name;
        $this->section->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $section = $this->section->findOrFail($id);

        if($section->products()->exists())
            {
                return redirect()->back()->withErrors(['section_delete' => 'You can not delete '. $section->name . ' section.']);
            }

        $section->delete();

        return redirect()->back();
    }


    public function edit($id)
    {
        $section = $this->section->findOrFail($id);

        return view('sections.edit')->with('section', $section);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);

        $section = $this->section->findOrfail($id);

        $section->name = $request->name;
        $section->save();

        return redirect()->route('section.index');
    }
}
