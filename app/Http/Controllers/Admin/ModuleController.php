<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        $validated['course_id'] = $course->id;
        $validated['is_published'] = $request->has('is_published') ? true : false;
        $validated['order'] = $validated['order'] ?? ($course->modules()->max('order') ?? 0) + 1;

        $module = Module::create($validated);

        return redirect()
            ->route('admin.courses.show', $course)
            ->with('success', 'Módulo criado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published') ? true : false;

        $module->update($validated);

        return redirect()
            ->route('admin.courses.show', $course)
            ->with('success', 'Módulo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Module $module)
    {
        $module->delete();

        return redirect()
            ->route('admin.courses.show', $course)
            ->with('success', 'Módulo excluído com sucesso!');
    }
}
