<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'description',
        'content',
        'video_url',
        'video_duration',
        'pdf_file',
        'type',
        'is_free',
        'is_published',
        'order',
        'views_count',
        'materials',
        'attachments',
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_published' => 'boolean',
        'materials' => 'array',
        'attachments' => 'array',
    ];

    // Relacionamentos
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }

    // Helpers
    public function getCourseAttribute(): Course
    {
        return $this->module->course;
    }
}
