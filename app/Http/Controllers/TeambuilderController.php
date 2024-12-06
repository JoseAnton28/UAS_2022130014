<?php

namespace App\Http\Controllers;

use App\Models\Teambuilder;
use App\Models\Servant;
use App\Models\Craftessence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeambuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    
    $teambuilders = Teambuilder::where('user_id', Auth::id())
        ->with(['servants' => function($query) {
            $query->withPivot('craftessence_id'); 
        }])
        ->get();

    
    return view('teambuilders.index', compact('teambuilders'));
}


    public function create()
    {
        $servants = Servant::all();
        $craftEssences = Craftessence::all();
        return view('teambuilders.create', compact('servants', 'craftEssences'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name_team' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'servants' => 'required|array|min:6|max:6',
            'servants.*' => 'exists:servants,id',
            'craft_essences' => 'required|array|min:6|max:6',
            'craft_essences.*' => 'exists:craftessences,id',
        ]);

        
        DB::beginTransaction();
        try {
            
            $teambuilder = Teambuilder::create([
                'user_id' => Auth::id(),
                'name_team' => $request->name_team,
                'description' => $request->description,
            ]);

            
            foreach ($request->servants as $index => $servantId) {
                $craftEssenceId = $request->craft_essences[$index] ?? null;

                $teambuilder->servants()->attach($servantId, [
                    'craftessence_id' => $craftEssenceId, 
                ]);
            }

            
            DB::commit();

            return redirect()->route('teambuilders.index')
                ->with('success', 'Team berhasil dibuat.');
        } catch (\Exception $e) {
            
            DB::rollBack();
            return back()->with('error', 'Gagal membuat team: ' . $e->getMessage());
        }
    }

    public function show($id)
{
    
    $teambuilder = Teambuilder::with(['servants' => function($query) {
        $query->withPivot('craftessence_id');  
    }])->findOrFail($id);

    
    return view('teambuilders.show', compact('teambuilder'));
}





public function edit($id)
{
    
    $teambuilder = Teambuilder::findOrFail($id);
    $servants = Servant::all();
    $craftEssences = Craftessence::all();
    $selectedServants = $teambuilder->servants()->pluck('servants.id')->toArray();
    $selectedCraftEssences = $teambuilder->servants()->pluck('craftessence_id')->toArray();

    
    return view('teambuilders.edit', compact(
        'teambuilder',
        'servants',
        'craftEssences',
        'selectedServants',
        'selectedCraftEssences'
    ));
}


    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name_team' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'servants' => 'required|array|min:6|max:6',
            'craft_essences' => 'required|array|min:6|max:6',
        ]);

        DB::beginTransaction();
        try {
            $teambuilder = Teambuilder::findOrFail($id);

            
            $teambuilder->update([
                'name_team' => $request->name_team,
                'description' => $request->description,
            ]);

            
            $teambuilder->servants()->detach();

            
            for ($i = 0; $i < 6; $i++) {
                $teambuilder->servants()->attach($request->servants[$i], [
                    'craftessence_id' => $request->craft_essences[$i], 
                ]);
            }

            DB::commit();
            return redirect()->route('teambuilders.index')
                ->with('success', 'Team berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui team: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $teambuilder = Teambuilder::findOrFail($id);
        $teambuilder->servants()->detach();
        $teambuilder->delete();

        return redirect()->route('teambuilders.index')
            ->with('success', 'Team berhasil dihapus');
    }
}
