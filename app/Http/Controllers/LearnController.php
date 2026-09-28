<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Material;
use App\Models\Level;

class LearnController extends Controller
{
    public function index()
    {
        $levels = Level::with('materials')->orderBy('level_number', 'asc')->get();

        return Inertia::render('Learn/Index', [
            'levels' => $levels,
        ]);
    }

    public function show($id)
    {
        $material = Material::with('level')->findOrFail($id);
        $relatedMaterials = Material::where('level_id', $material->level_id)
            ->where('id', '!=', $material->id)
            ->take(5)
            ->get();

        return Inertia::render('Learn/Show', [
            'material' => $material,
            'related_materials' => $relatedMaterials,
        ]);
    }
}
