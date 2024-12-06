<?php

namespace App\Http\Controllers;

use App\Models\CharacterPlanner;
use App\Models\Servant;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CharacterPlannerController extends Controller
{
    public function index()
    {

        $planners = CharacterPlanner::where('user_id', Auth::id())->get();
        return view('character_planners.index', compact('planners'));
    }

    public function create()
{
    $servants = Servant::all();
    $materials = Material::all(); 
    return view('character_planners.create', compact('servants', 'materials'));
}



public function store(Request $request)
{
    // Validasi form
    $request->validate([
        'servant_id' => 'required|exists:servants,id',
        'materials' => 'required|array|min:1|max:3',
        'materials.*.id' => 'required|exists:materials,id',
        'materials.*.amount' => 'required|integer|min:1',
    ]);

    try {
        DB::beginTransaction();

        // Membuat planner baru
        $planner = new CharacterPlanner();
        $planner->user_id = Auth::id();
        $planner->servant_id = $request->servant_id;
        $planner->save();

        // Menyimpan data materials menggunakan tabel servant_material
        $materials = [];
        foreach ($request->materials as $material) {
            $materials[$material['id']] = ['amount' => $material['amount']];
        }

        // Menyimpan data ke tabel pivot servant_material
        $planner->servant->materials()->sync($materials);

        DB::commit();

        // Redirect ke halaman index
        return redirect()->route('character_planners.index')->with('success', 'Character Planner berhasil disimpan!');
    } catch (Exception $e) {
        DB::rollback();
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}


public function edit($id)
{
    $planner = CharacterPlanner::findOrFail($id);
    $servants = Servant::all();
    $materials = Material::all();
    return view('character_planners.edit', compact('planner', 'servants', 'materials'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'servant_id' => 'required|exists:servants,id',
        'materials' => 'required|array|min:1|max:3',
        'materials.*.id' => 'required|exists:materials,id',
        'materials.*.amount' => 'required|integer|min:1',
    ]);

    try {
        DB::beginTransaction();

        $planner = CharacterPlanner::findOrFail($id);
        $planner->servant_id = $request->servant_id;
        $planner->save();

        $materials = [];
        foreach ($request->materials as $material) {
            $materials[$material['id']] = ['amount' => $material['amount']];
        }
        $planner->materials()->sync($materials);

        DB::commit();

        return redirect()->route('character_planners.index')->with('success', 'Character Planner berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}




    public function destroy($id)
    {
        $planner = CharacterPlanner::findOrFail($id);
        $planner->servant->materials()->detach();
        $planner->delete();

        return redirect()->route('character_planners.index')->with('success', 'Character Planner berhasil dihapus!');
    }

    public function show($id)
    {
        
        $planner = CharacterPlanner::findOrFail($id);
        return view('character_planners.show', compact('planner'));
    }
}
