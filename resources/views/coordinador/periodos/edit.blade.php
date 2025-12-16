<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar periodo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('coordinador.periodos.update', $periodo) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input name="nombre" value="{{ old('nombre', $periodo->nombre) }}"
                            class="mt-1 block w-full rounded-md border-gray-300" required maxlength="50">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                            <input type="date" name="fecha_inicio"
                                value="{{ old('fecha_inicio', optional($periodo->fecha_inicio)->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha fin</label>
                            <input type="date" name="fecha_fin"
                                value="{{ old('fecha_fin', optional($periodo->fecha_fin)->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300" required>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="activo" value="1" class="rounded border-gray-300"
                            {{ old('activo', $periodo->activo) ? 'checked' : '' }}>
                        <label class="text-sm text-gray-700">Marcar como activo</label>
                    </div>

                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Guardar cambios
                        </button>
                        <a href="{{ route('coordinador.periodos.index') }}"
                            class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
