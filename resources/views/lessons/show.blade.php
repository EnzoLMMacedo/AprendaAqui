@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar com Módulos e Aulas -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-lg p-4 mb-4">
                    <a href="{{ route('courses.show', $course->slug) }}" class="text-blue-400 hover:text-blue-300 flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Voltar ao Curso
                    </a>
                </div>
                
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <div class="p-4 bg-gray-700">
                        <h3 class="text-white font-semibold">{{ $course->title }}</h3>
                        <div class="text-sm text-gray-400 mt-1">Progresso: {{ $enrollment->progress_percentage }}%</div>
                        <div class="w-full bg-gray-600 rounded-full h-2 mt-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $enrollment->progress_percentage }}%"></div>
                        </div>
                    </div>
                    
                    <div class="max-h-[600px] overflow-y-auto">
                        @foreach($course->modules as $module)
                            <div class="border-b border-gray-700">
                                <div class="p-3 bg-gray-750 text-gray-300 font-medium text-sm">
                                    {{ $module->title }}
                                </div>
                                <div class="divide-y divide-gray-700">
                                    @foreach($module->lessons as $l)
                                        <a href="{{ route('lessons.show', [$course, $l]) }}" 
                                           class="block p-3 hover:bg-gray-700 transition-colors {{ $l->id === $lesson->id ? 'bg-gray-700 border-l-4 border-blue-500' : '' }}">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    @if($l->type === 'video')
                                                        <i class="fas fa-play-circle text-blue-400 text-sm"></i>
                                                    @elseif($l->type === 'text')
                                                        <i class="fas fa-file-alt text-gray-400 text-sm"></i>
                                                    @elseif($l->type === 'quiz')
                                                        <i class="fas fa-question-circle text-yellow-400 text-sm"></i>
                                                    @else
                                                        <i class="fas fa-tasks text-green-400 text-sm"></i>
                                                    @endif
                                                    <span class="text-gray-300 text-sm {{ $l->id === $lesson->id ? 'font-semibold' : '' }}">{{ $l->title }}</span>
                                                </div>
                                                @if($l->video_duration)
                                                    <span class="text-gray-500 text-xs">{{ $l->video_duration }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Conteúdo Principal -->
            <div class="lg:col-span-3">
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <!-- Player de Vídeo -->
                    @if($lesson->type === 'video' && $lesson->video_url)
                        <div class="bg-black aspect-video">
                            <iframe 
                                src="{{ $lesson->video_url }}" 
                                class="w-full h-full"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <div class="bg-black aspect-video flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-video text-6xl mb-4"></i>
                                <p>Vídeo não disponível</p>
                            </div>
                        </div>
                    @endif

                    <!-- Informações da Aula -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-2xl font-bold text-white">{{ $lesson->title }}</h1>
                            @if($progress->is_completed)
                                <span class="px-3 py-1 bg-green-600 text-white rounded-full text-sm">
                                    <i class="fas fa-check-circle mr-1"></i> Concluída
                                </span>
                            @endif
                        </div>

                        @if($lesson->description)
                            <p class="text-gray-300 mb-6">{{ $lesson->description }}</p>
                        @endif

                        @if($lesson->content)
                            <div class="prose prose-invert max-w-none mb-6">
                                {!! $lesson->content !!}
                            </div>
                        @endif

                        <!-- Botão de Conclusão -->
                        @if(!$progress->is_completed)
                            <form id="completeForm" method="POST" action="{{ route('lessons.complete', [$course, $lesson]) }}">
                                @csrf
                                <input type="hidden" name="time_watched" id="timeWatched" value="0">
                                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-check mr-2"></i>
                                    Marcar como Concluída
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Navegação -->
                    <div class="border-t border-gray-700 p-6 flex justify-between">
                        @if($previousLesson)
                            <a href="{{ route('lessons.show', [$course, $previousLesson]) }}" class="bg-gray-700 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Aula Anterior
                            </a>
                        @else
                            <div></div>
                        @endif

                        @if($nextLesson)
                            <a href="{{ route('lessons.show', [$course, $nextLesson]) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Próxima Aula
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @else
                            <div class="bg-green-600 text-white px-6 py-2 rounded-lg">
                                <i class="fas fa-trophy mr-2"></i>
                                Curso Concluído!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Rastrear tempo assistido (simplificado)
    let startTime = Date.now();
    
    setInterval(() => {
        const timeWatched = Math.floor((Date.now() - startTime) / 1000);
        document.getElementById('timeWatched').value = timeWatched;
    }, 5000);
</script>
@endpush
@endsection

