<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-sign-in-alt text-2xl text-blue-600"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Bem-vindo de volta!</h2>
            <p class="text-gray-600">Faça login para continuar sua jornada</p>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-200">
            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>
                        Email
                    </label>
                    <input 
                        wire:model="email" 
                        type="email" 
                        id="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('email') border-red-500 @enderror"
                        placeholder="seu@email.com"
                        required
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-600 mr-2"></i>
                        Senha
                    </label>
                    <input 
                        wire:model="password" 
                        type="password" 
                        id="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 @error('password') border-red-500 @enderror"
                        placeholder="Sua senha"
                        required
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            wire:model="remember" 
                            type="checkbox" 
                            id="remember"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Lembrar de mim
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-300">
                            Esqueceu a senha?
                        </a>
                    </div>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold text-lg transition-all duration-300 hover:bg-blue-700 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-500/30 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    <div wire:loading wire:target="login" class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                    <i wire:loading.remove wire:target="login" class="fas fa-sign-in-alt"></i>
                    <span wire:loading.remove wire:target="login">Entrar</span>
                    <span wire:loading wire:target="login">Entrando...</span>
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Não tem uma conta? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-300">
                        Criar conta
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
