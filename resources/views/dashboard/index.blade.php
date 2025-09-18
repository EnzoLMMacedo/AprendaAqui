@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-surface to-slate-200 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl border border-border p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-text-dark mb-2">
                        Bem-vindo, {{ Auth::user()->name }}! 🎉
                    </h1>
                    <p class="text-text-light text-lg">
                        Você está logado e pode acessar esta área protegida
                    </p>
                </div>
                <div class="text-right">
                    <div class="bg-primary-blue/10 rounded-full p-4 mb-4">
                        <i class="fas fa-shield-alt text-2xl text-primary-blue"></i>
                    </div>
                    <p class="text-sm text-text-light">Área Protegida</p>
                </div>
            </div>
        </div>

        <!-- Content Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- User Info Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-border p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-primary-blue/10 rounded-full p-3 mr-4">
                        <i class="fas fa-user text-primary-blue text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-dark">Informações do Usuário</h3>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-text-light">Nome:</p>
                        <p class="font-semibold text-text-dark">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-light">Email:</p>
                        <p class="font-semibold text-text-dark">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-light">Membro desde:</p>
                        <p class="font-semibold text-text-dark">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-border p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 rounded-full p-3 mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-dark">Autenticação</h3>
                </div>
                <div class="space-y-3">
                    <p class="text-text-light">✅ Login realizado com sucesso</p>
                    <p class="text-text-light">✅ Middleware de autenticação ativo</p>
                    <p class="text-text-light">✅ Sessão válida</p>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-border p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-primary-blue/10 rounded-full p-3 mr-4">
                        <i class="fas fa-cogs text-primary-blue text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-dark">Ações</h3>
                </div>
                <div class="space-y-3">
                    <a href="{{ route('home') }}" class="block w-full bg-primary-blue text-white py-2 px-4 rounded-lg text-center font-semibold hover:bg-accent-blue transition-colors duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Voltar ao Início
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-red-600 transition-colors duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-text-dark mb-8 text-center">Recursos Disponíveis</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-lg border border-border p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-primary-blue/10 rounded-full p-4 mx-auto mb-4 w-16 h-16 flex items-center justify-center">
                        <i class="fas fa-code text-primary-blue text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-text-dark mb-2">Cursos</h4>
                    <p class="text-text-light text-sm">Acesse nossos cursos de programação</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg border border-border p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-primary-blue/10 rounded-full p-4 mx-auto mb-4 w-16 h-16 flex items-center justify-center">
                        <i class="fas fa-trophy text-primary-blue text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-text-dark mb-2">Certificados</h4>
                    <p class="text-text-light text-sm">Obtenha certificados de conclusão</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg border border-border p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-primary-blue/10 rounded-full p-4 mx-auto mb-4 w-16 h-16 flex items-center justify-center">
                        <i class="fas fa-users text-primary-blue text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-text-dark mb-2">Comunidade</h4>
                    <p class="text-text-light text-sm">Conecte-se com outros alunos</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg border border-border p-6 text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-primary-blue/10 rounded-full p-4 mx-auto mb-4 w-16 h-16 flex items-center justify-center">
                        <i class="fas fa-chart-line text-primary-blue text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-text-dark mb-2">Progresso</h4>
                    <p class="text-text-light text-sm">Acompanhe seu desenvolvimento</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
