<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index(Request $request)
{
    $query = Material::query();

    
    if ($request->has('search')) {
        $query->where('name_mt', 'like', '%' . $request->search . '%')
              ->orWhere('type_mt', 'like', '%' . $request->search . '%');
    }

    if ($request->has('type') && $request->type) {
        $query->where('type_mt', $request->type);
    }

    
    $materials = $query->paginate(10); 

    $types = Material::distinct('type_mt')->pluck('type_mt');

    return view('materials.index', compact('materials', 'types'));
}

    public function create()
    {
        $types = Material::getTypes();
        return view('materials.create', compact('types'));
    }

    private function uploadImage($file, $existingImagePath = null)
    {
        
        if ($existingImagePath) {
            Storage::disk('public')->delete('materials/' . $existingImagePath);
        }

        
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('materials', $filename, 'public');

        return basename($path);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_mt' => 'required|max:255',
            'type_mt' => 'required|max:255',
            'drop_location_mt' => 'nullable|max:255',
            'img_mt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if ($request->hasFile('img_mt')) {
            $validatedData['img_mt'] = $this->uploadImage($request->file('img_mt'));
        }

        $material = Material::create($validatedData);

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil dibuat');
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        $types = Material::getTypes();
        return view('materials.edit', compact('material', 'types'));
    }

    public function update(Request $request, Material $material)
    {
        $validatedData = $request->validate([
            'name_mt' => 'required|max:255',
            'type_mt' => 'required|max:255',
            'drop_location_mt' => 'nullable|max:255',
            'img_mt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if ($request->hasFile('img_mt')) {
            $validatedData['img_mt'] = $this->uploadImage(
                $request->file('img_mt'), 
                $material->img_mt
            );
        }

        $material->update($validatedData);

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil diperbarui');
    }

    public function destroy(Material $material)
    {
        
        if ($material->img_mt) {
            Storage::disk('public')->delete('materials/' . $material->img_mt);
        }

        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil dihapus');
    }

    
    public function showImage(Material $material)
    {
        $imagePath = $material->img_mt ? 'materials/' . $material->img_mt : 'default-material.png';

        if (!Storage::disk('public')->exists($imagePath)) {
            
            $imagePath = 'default-material.png';
        }

        return response()->file(Storage::disk('public')->path($imagePath));
    }
}