<?php

namespace App\Http\Controllers;

use App\Models\Craftessence;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CraftessenceController extends Controller
{
    
    protected $rarities = [1, 2, 3, 4, 5];

    public function index(Request $request)
    {
        $query = Craftessence::query();

        
        if ($request->filled('search')) {
            $query->where('name_ce', 'like', '%' . $request->search . '%');
        }

        
        if ($request->filled('rarity')) {
            $query->where('rarity_ce', $request->rarity);
        }

        
        $query->orderBy('rarity_ce', 'desc')
              ->orderBy('name_ce', 'asc');

        
        $craftessences = $query->paginate(10);
        $rarities = $this->rarities;

        
        $craftessences->appends($request->only(['search', 'rarity']));

        return view('craftessences.index', compact('craftessences', 'rarities'));
    }

    public function create()
    {
        $rarities = $this->rarities;
        return view('craftessences.create', compact('rarities'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_ce' => 'required|unique:craftessences,name_ce|max:255',
            'rarity_ce' => 'required|in:' . implode(',', $this->rarities),
            'max_level_ce' => 'required|integer|min:1|max:100',
            'base_attack_ce' => 'required|integer|min:0',
            'base_hp_ce' => 'required|integer|min:0',
            'effects_ce' => 'nullable|array',
            'img_ce' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        if ($request->hasFile('img_ce')) {
            $photo = $request->file('img_ce');
            
            
            $filename = Str::slug($validatedData['name_ce']) . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            
            $uploadPath = public_path('uploads/craftessences');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            
            $photo->move($uploadPath, $filename);

            
            $validatedData['img_ce'] = 'uploads/craftessences/' . $filename;
        }

        
        $validatedData['effects_ce'] = $request->has('effects_ce') ? 
            json_encode($request->effects_ce) : null;

        $craftessence = Craftessence::create($validatedData);

        return redirect()->route('craftessences.index')
            ->with('success', 'Craft Essence berhasil ditambahkan');
    }

    
public function show(Craftessence $craftessence)
{
    
    $craftessence->effects_ce = $craftessence->effects_ce ?? [];

    return view('craftessences.show', compact('craftessence'));
}

    public function edit(Craftessence $craftessence)
    {
        $rarities = $this->rarities;

        
        $craftessence->effects = $craftessence->effects_ce ? 
            json_decode($craftessence->effects_ce, true) : [];

        return view('craftessences.edit', compact('craftessence', 'rarities'));
    }

    public function update(Request $request, Craftessence $craftessence)
    {
        $validatedData = $request->validate([
            'name_ce' => 'required|unique:craftessences,name_ce,'.$craftessence->id.'|max:255',
            'rarity_ce' => 'required|in:' . implode(',', $this->rarities),
            'max_level_ce' => 'required|integer|min:1|max:100',
            'base_attack_ce' => 'required|integer|min:0',
            'base_hp_ce' => 'required|integer|min:0',
            'effects_ce' => 'nullable|array',
            'img_ce' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        if ($request->hasFile('img_ce')) {
            
            if ($craftessence->img_ce && File::exists(public_path($craftessence->img_ce))) {
                File::delete(public_path($craftessence->img_ce));
            }

            $photo = $request->file('img_ce');
            
            
            $filename = Str::slug($validatedData['name_ce']) . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            
            $uploadPath = public_path('uploads/craftessences');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            
            $photo->move($uploadPath, $filename);

            
            $validatedData['img_ce'] = 'uploads/craftessences/' . $filename;
        }

        
        $validatedData['effects_ce'] = $request->has('effects_ce') ? 
            json_encode($request->effects_ce) : null;

        $craftessence->update($validatedData);

        return redirect()->route('craftessences.index')
            ->with('success', 'Craft Essence berhasil diperbarui');
    }

    public function destroy(Craftessence $craftessence)
    {
        
        if ($craftessence->img_ce && File::exists(public_path($craftessence->img_ce))) {
            File::delete(public_path($craftessence->img_ce));
        }

        $craftessence->delete();

        return redirect()->route('craftessences.index')
            ->with('success', 'Craft Essence berhasil dihapus');
    }

    
    public function uploadPhoto(Request $request, Craftessence $craftessence)
    {
        $request->validate([
            'img_ce' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        
        if ($craftessence->img_ce && File::exists(public_path($craftessence->img_ce))) {
            File::delete(public_path($craftessence->img_ce));
        }

        $photo = $request->file('img_ce');
        $filename = Str::slug($craftessence->name_ce) . '_' . time() . '.' . $photo->getClientOriginalExtension();
        
        
        $uploadPath = public_path('uploads/craftessences');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        
        $photo->move($uploadPath, $filename);

        
        $craftessence->img_ce = 'uploads/craftessences/' . $filename;
        $craftessence->save();

        return redirect()->route('craftessences.index')
            ->with('success', 'Foto Craft Essence berhasil diunggah');
    }
}