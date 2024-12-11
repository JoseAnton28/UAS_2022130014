<?php

namespace App\Http\Controllers;

use App\Models\Servant;
use App\Models\Material;
use App\Models\CharacterPlanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CharacterPlannerController extends Controller
{
    protected $classes = [
        'Saber',
        'Archer',
        'Lancer',
        'Rider',
        'Caster',
        'Assassin',
        'Berserker',
        'Ruler',
        'Avenger',
        'Moon Cancer',
        'Alter Ego',
        'Foreigner',
        'Pretender',
        'Shielder'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $planners = CharacterPlanner::where('user_id', Auth::id())
            ->with('servant', 'materials')
            ->get();
        return view('character-planner.index', compact('planners'));
    }

    public function create()
    {
        $servants = Servant::all();
        $materials = Material::all();
        return view('character-planner.create', compact('servants', 'materials'));
    }

    public function store(Request $request)
{
    // Validasi data input
    $validatedData = $request->validate([
        'servant_id' => 'required|exists:servants,id',
        'materials' => 'nullable|array',
        'materials.*.id' => 'nullable|exists:materials,id',
        'materials.*.quantity' => 'nullable|integer|min:1'
    ]);

    // Mulai transaksi database
    DB::beginTransaction();
    try {
        // Buat Character Planner
        $planner = CharacterPlanner::create([
            'user_id' => Auth::id(),
            'servant_id' => $validatedData['servant_id']
        ]);

        // Proses attachment materials
        if (isset($validatedData['materials'])) {
            $materialsToAttach = [];
            foreach ($validatedData['materials'] as $materialData) {
                // Hanya tambahkan jika material_id tidak kosong
                if (!empty($materialData['id'])) {
                    $materialsToAttach[$materialData['id']] = [
                        'quantity' => $materialData['quantity'] ?? 1
                    ];
                }
            }

            // Attach materials ke character planner
            $planner->materials()->attach($materialsToAttach);
        }

        // Commit transaksi
        DB::commit();

        // Redirect dengan pesan sukses
        return redirect()->route('character-planner.index')
            ->with('success', 'Character Planner berhasil dibuat');

    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi error
        DB::rollBack();

        // Redirect kembali dengan pesan error
        return back()->withErrors('Gagal membuat Character Planner: ' . $e->getMessage())
            ->withInput();
    }
}

    public function show($id)
    {
        $planner = CharacterPlanner::where('user_id', Auth::id())
            ->with('servant', 'materials')
            ->findOrFail($id);
        return view('character-planner.show', compact('planner'));
    }

    public function edit($id)
    {
        $planner = CharacterPlanner::where('user_id', Auth::id())
            ->with('materials')
            ->findOrFail($id);

        $servants = Servant::all();
        $materials = Material::all();

        return view('character-planner.edit', compact(
            'planner',
            'servants',
            'materials'
        ));
    }

    public function update(Request $request, $id)
{
    // Validasi data input
    $validatedData = $request->validate([
        'servant_id' => 'required|exists:servants,id',
        'materials' => 'nullable|array',
        'materials.*.id' => 'nullable|exists:materials,id',
        'materials.*.quantity' => 'nullable|integer|min:1'
    ]);

    // Mulai transaksi database
    DB::beginTransaction();
    try {
        // Temukan Character Planner
        $planner = CharacterPlanner::where('user_id', Auth::id())->findOrFail($id);

        // Update servant
        $planner->update([
            'servant_id' => $validatedData['servant_id']
        ]);

        // Hapus materials yang ada
        $planner->materials()->detach();

        // Proses attachment materials baru
        if (isset($validatedData['materials'])) {
            $materialsToAttach = [];
            foreach ($validatedData['materials'] as $materialData) {
                // Hanya tambahkan jika material_id tidak kosong
                if (!empty($materialData['id'])) {
                    $materialsToAttach[$materialData['id']] = [
                        'quantity' => $materialData['quantity'] ?? 1
                    ];
                }
            }

            // Attach materials ke character planner
            $planner->materials()->attach($materialsToAttach);
        }

        // Commit transaksi
        DB::commit();

        // Redirect dengan pesan sukses
        return redirect()->route('character-planner.index')
            ->with('success', 'Character Planner berhasil diperbarui');

    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi error
        DB::rollBack();

        // Redirect kembali dengan pesan error
        return back()->withErrors('Gagal memperbarui Character Planner: ' . $e->getMessage())
            ->withInput();
    }
}

    public function destroy($id)
    {
        $planner = CharacterPlanner::where('user_id', Auth::id())->findOrFail($id);

        DB::beginTransaction();
        try {
            // Hapus relasi materials
            $planner->materials()->detach();

            // Hapus planner
            $planner->delete();

            DB::commit();
            return redirect()->route('character-planner.index')
                ->with('success', 'Character Planner berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }
}
