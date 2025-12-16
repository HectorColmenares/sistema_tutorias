<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Periodos
            </h2>

            <a href="{{ route('coordinador.periodos.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                Nuevo periodo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="GET" class="flex gap-3 items-center">
                    <input type="text" name="q" value="{{ $q }}" placeholder="Buscar por nombre…"
                        class="w-full max-w-md rounded-md border-gray-300" />
                    <button class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200">
                        Buscar
                    </button>
                </form>

                @if ($periodoActivo)
                    <p class="mt-4 text-sm text-gray-700">
                        <span class="font-semibold">Periodo activo:</span>
                        {{ $periodoActivo->nombre }} ({{ $periodoActivo->fecha_inicio->format('Y-m-d') }} a
                        {{ $periodoActivo->fecha_fin->format('Y-m-d') }})
                    </p>
                @else
                    <p class="mt-4 text-sm text-gray-700">
                        No hay periodo activo.
                    </p>
                @endif
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left px-6 py-3">Nombre</th>
                            <th class="text-left px-6 py-3">Inicio</th>
                            <th class="text-left px-6 py-3">Fin</th>
                            <th class="text-left px-6 py-3">Activo</th>
                            <th class="text-right px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($periodos as $periodo)
                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-900">{{ $periodo->nombre }}</td>
                                <td class="px-6 py-3">{{ optional($periodo->fecha_inicio)->format('Y-m-d') }}</td>
                                <td class="px-6 py-3">{{ optional($periodo->fecha_fin)->format('Y-m-d') }}</td>
                                <td class="px-6 py-3">
                                    @if ($periodo->activo)
                                        <span
                                            class="inline-flex px-2 py-1 rounded bg-green-100 text-green-800">Sí</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 rounded bg-gray-100 text-gray-700">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('coordinador.periodos.edit', $periodo) }}"
                                            class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">
                                            Editar
                                        </a>

                                        @if (!$periodo->activo)
                                            <form method="POST"
                                                action="{{ route('coordinador.periodos.activar', $periodo) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-500">
                                                    Activar
                                                </button>
                                            </form>

                                            <form method="POST"
                                                action="{{ route('coordinador.periodos.destroy', $periodo) }}"
                                                onsubmit="return confirm('¿Eliminar este periodo?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-500">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($periodos->count() === 0)
                            <tr>
                                <td class="px-6 py-8 text-center text-gray-600" colspan="5">
                                    Sin periodos.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div>
                {{ $periodos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
