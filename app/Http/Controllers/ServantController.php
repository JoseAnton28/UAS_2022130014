<?php

namespace App\Http\Controllers;

use App\Models\Servant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ServantController extends Controller
{
    protected $classes = [
        'Saber', 'Archer', 'Lancer', 'Rider', 'Caster', 
        'Assassin', 'Berserker', 'Ruler', 'Avenger', 'Moon Cancer',
        'Alter Ego', 'Foreigner'
    ];

    public function index(Request $request)
    {
        $query = Servant::query();
    
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name_sv', 'like', '%' . $request->search . '%')
                  ->orWhere('class_sv', 'like', '%' . $request->search . '%');
            });
        }
    
        
        if ($request->filled('class')) {
            $query->where('class_sv', $request->class);
        }
    
        
        if ($request->filled('rarity')) {
            $query->where('rarity_sv', $request->rarity);
        }
    
        
        $query->orderBy('rarity_sv', 'desc')
              ->orderBy('name_sv', 'asc');
    
        
        $servants = $query->paginate(10);
    
        
        $classes = $this->classes;
    
        
        $servants->appends($request->only(['search', 'class', 'rarity']));
    
        return view('servants.index', compact('servants', 'classes'));
    }

    public function create()
    {
        $classes = $this->classes;
        return view('servants.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_sv' => 'required|unique:servants,name_sv|max:255',
            'class_sv' => 'required|in:' . implode(',', $this->classes),
            'rarity_sv' => 'required|integer|min:1|max:5',
            'base_hp_sv' => 'required|integer',
            'base_atk_sv' => 'required|integer',
            'img_sv' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills_sv' => 'nullable',
            'ascension_sv' => 'nullable'
        ]);

        
        if ($request->hasFile('img_sv')) {
            $photo = $request->file('img_sv');
            
            
            $filename = Str::slug($validatedData['name_sv']) . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            
            $uploadPath = public_path('uploads/servants');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            
            $photo->move($uploadPath, $filename);

            
            $validatedData['img_sv'] = 'uploads/servants/' . $filename;
        }

        
        $validatedData['skills_sv'] = $request->has('skills_sv') ? 
            json_encode($request->skills_sv) : null;
        $validatedData['ascension_sv'] = $request->has('ascension_sv') ? 
            json_encode($request->ascension_sv) : null;

        $servant = Servant::create($validatedData);

        return redirect()->route('servants.index')
            ->with('success', 'Servant berhasil ditambahkan');
    }

    public function show(Servant $servant)
    {
        
        $servant->skills = $servant->skills_sv ? json_decode($servant->skills_sv, true) : null;
        $servant->ascension = $servant->ascension_sv ? json_decode($servant->ascension_sv, true) : null;

        return view('servants.show', compact('servant'));
    }

    public function edit(Servant $servant)
    {
        $classes = $this->classes;

        
        $servant->skills = $servant->skills_sv ? json_decode($servant->skills_sv, true) : [];
        $servant->ascension = $servant->ascension_sv ? json_decode($servant->ascension_sv, true) : [];

        return view('servants.edit', compact('servant', 'classes'));
    }

    public function update(Request $request, Servant $servant)
    {
        $validatedData = $request->validate([
            'name_sv' => 'required|unique:servants,name_sv,'.$servant->id.'|max:255',
            'class_sv' => 'required|in:' . implode(',', $this->classes),
            'rarity_sv' => 'required|integer|min:1|max:5',
            'base_hp_sv' => 'required|integer',
            'base_atk_sv' => 'required|integer',
            'img_sv' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills_sv' => 'nullable',
            'ascension_sv' => 'nullable'
        ]);

        
        if ($request->hasFile('img_sv')) {
            
            if ($servant->img_sv && File::exists(public_path($servant->img_sv))) {
                File::delete(public_path($servant->img_sv));
            }

            $photo = $request->file('img_sv');
            
            
            $filename = Str::slug($validatedData['name_sv']) . '_' . time() . '.' . $photo->getClientOriginalExtension();
            
            
            $uploadPath = public_path('uploads/servants');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            
            $photo->move($uploadPath, $filename);

            
            $validatedData['img_sv'] = 'uploads/servants/' . $filename;
        }

        
        $validatedData['skills_sv'] = $request->has('skills_sv') ? 
            json_encode($request->skills_sv) : null;
        $validatedData['ascension_sv'] = $request->has('ascension_sv') ? 
            json_encode($request->ascension_sv) : null;

        $servant->update($validatedData);

        return redirect()->route('servants.index')
            ->with('success', 'Servant berhasil diperbarui');
    }

    public function destroy(Servant $servant)
    {
        
        if ($servant->img_sv && File::exists(public_path($servant->img_sv))) {
            File::delete(public_path($servant->img_sv));
        }

        $servant->delete();

        return redirect()->route('servants.index')
            ->with('success', 'Servant berhasil dihapus');
    }

    public function uploadPhoto(Request $request, Servant $servant)
{
    $request->validate([
        'img_sv' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    
    if ($servant->img_sv && File::exists(public_path($servant->img_sv))) {
        File::delete(public_path($servant->img_sv));
    }

    $photo = $request->file('img_sv');
    $filename = Str::slug($servant->name_sv) . '_' . time() . '.' . $photo->getClientOriginalExtension();
    
    
    $uploadPath = public_path('uploads/servants');
    if (!File::exists($uploadPath)) {
        File::makeDirectory($uploadPath, 0755, true);
    }

    
    $photo->move($uploadPath, $filename);

    
    $servant->update([
        'img_sv' => 'uploads/servants/' . $filename
    ]);

    return back()->with('success', 'Foto servant berhasil diupload');
}

    
    public function removePhoto(Servant $servant)
    {
        if ($servant->img_sv && File::exists(public_path($servant->img_sv))) {
            File::delete(public_path($servant->img_sv));
        }

        $servant->update(['img_sv' => null]);

        return back()->with('success', 'Foto servant berhasil dihapus');
    }

    
}