@extends('layouts.coordinador')

@section('title', 'Calendarización')

@section('content')
    <div class="page-wrap">
        <div class="welcome" style="width:100%; text-align:left;">
            <h1 style="color: #1B396A; margin-bottom: 8px;">Calendarización</h1>
            <p style="color: #666; font-size: 16px; margin-bottom: 30px;">
                Genera y edita las sesiones de tutoría por periodo.
            </p>

            {{-- Mensajes de estado --}}
            @if (session('status'))
                <div class="user-info"
                    style="border-left: 6px solid #22c55e; background: #f0fdf4; padding: 16px; margin-bottom: 24px; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <svg style="width: 20px; height: 20px; color: #22c55e;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p style="color: #166534; font-weight: 500; margin: 0;">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            {{-- Errores generales --}}
            @if ($errors->any())
                <div class="user-info"
                    style="border-left: 6px solid #ef4444; background: #fef2f2; padding: 16px; margin-bottom: 24px; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <svg style="width: 20px; height: 20px; color: #ef4444;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p style="color: #991b1b; font-weight: 500; margin: 0;">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            {{-- Tarjeta de selección de periodo y generación --}}
            <div class="user-info"
                style="max-width: 1100px; background: white; border-radius: 12px; padding: 24px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div
                        style="background: #FF771B; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 22px; height: 22px; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 style="color: #1B396A; font-size: 20px; font-weight: 700; margin: 0;">Configurar periodo</h2>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: end;">
                    {{-- Selector de periodo --}}


                    {{-- Generar sesiones --}}
                    @if ($periodoId)
                        <div>
                            <label for="num_sesiones"
                                style="display: block; color: #374151; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
                                Número de sesiones a generar
                            </label>
                            <form method="POST" action="{{ route('coordinador.calendarizacion.generar16') }}"
                                style="display: flex; gap: 12px; align-items: center;">
                                @csrf
                                <input type="hidden" name="periodo_id" value="{{ $periodoId }}">
                                <div style="position: relative; flex: 1;">
                                    <select name="num_sesiones"
                                        style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 2px solid #d1d5db; background: white; font-size: 15px; color: #1f2937; cursor: pointer; appearance: none;">
                                        @for ($i = 1; $i <= 16; $i++)
                                            <option value="{{ $i }}" {{ $i == 16 ? 'selected' : '' }}>
                                                {{ $i }} sesión{{ $i > 1 ? 'es' : '' }}
                                            </option>
                                        @endfor
                                    </select>
                                    <div
                                        style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                        <svg style="width: 20px; height: 20px; color: #6b7280;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <button type="submit"
                                    style="background: linear-gradient(135deg, #FF771B 0%, #ff944d 100%); color: white; padding: 12px 24px; border-radius: 10px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; white-space: nowrap; display: flex; align-items: center; gap: 8px;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(255, 119, 27, 0.2)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Generar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            @if ($periodoId)
                {{-- Tarjeta de sesiones --}}
                <div class="user-info"
                    style="max-width: 1100px; background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div
                                style="background: #1B396A; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 22px; height: 22px; color: white;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 style="color: #1B396A; font-size: 20px; font-weight: 700; margin: 0;">Sesiones
                                    programadas</h2>
                                <p style="color: #6b7280; font-size: 14px; margin: 4px 0 0 0;">
                                    {{ $sesiones->count() }} sesión{{ $sesiones->count() !== 1 ? 'es' : '' }}
                                    registrada{{ $sesiones->count() !== 1 ? 's' : '' }}
                                </p>
                            </div>
                        </div>

                        @if ($sesiones->isNotEmpty())
                            <div
                                style="color: #1B396A; font-weight: 600; font-size: 14px; background: #f0f9ff; padding: 8px 16px; border-radius: 20px; border: 1px solid #dbeafe;">
                                Periodo: {{ $periodos->firstWhere('id', $periodoId)->nombre ?? 'Actual' }}
                            </div>
                        @endif
                    </div>

                    @if ($sesiones->isEmpty())
                        <div style="text-align: center; padding: 40px 20px;">
                            <div
                                style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <svg style="width: 40px; height: 40px; color: #9ca3af;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <p style="color: #6b7280; font-size: 16px; margin-bottom: 16px;">
                                No hay sesiones programadas para este periodo.
                            </p>
                            <p style="color: #9ca3af; font-size: 14px;">
                                Utiliza el generador de sesiones para comenzar.
                            </p>
                        </div>
                    @else
                        {{-- ✅ Guardado masivo --}}
                        <form method="POST" action="{{ route('coordinador.calendarizacion.updatePeriodo', $periodoId) }}"
                            id="sesionesForm">
                            @csrf
                            @method('PUT')

                            <div style="overflow: auto; border-radius: 10px; border: 1px solid #e5e7eb;">
                                <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
                                    <thead>
                                        <tr style="background: #f9fafb;">
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                                #</th>
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                                Título</th>
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                                Fecha</th>
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                                Inicio</th>
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                                Fin</th>
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb;">
                                                Descripción</th>
                                            <th
                                                style="text-align: left; padding: 16px; color: #374151; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e5e7eb; width: 120px;">
                                                Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($sesiones as $s)
                                            @php $i = $loop->index; @endphp
                                            <tr style="border-top: 1px solid #f3f4f6; background: {{ $loop->even ? '#fafafa' : 'white' }}; transition: background 0.2s;"
                                                onmouseover="this.style.backgroundColor='#f8fafc';"
                                                onmouseout="this.style.backgroundColor='{{ $loop->even ? '#fafafa' : 'white' }}';">
                                                <td
                                                    style="padding: 16px; color: #6b7280; font-weight: 600; font-size: 15px;">
                                                    {{ $loop->iteration }}
                                                    <input type="hidden" name="sesiones[{{ $i }}][id]"
                                                        value="{{ $s->id }}">
                                                </td>

                                                <td style="padding: 16px;">
                                                    <input type="text" name="sesiones[{{ $i }}][titulo]"
                                                        value="{{ $s->titulo }}"
                                                        style="width: 100%; min-width: 200px; padding: 10px 12px; border-radius: 8px; border: 2px solid #d1d5db; font-size: 14px; color: #1f2937; transition: border 0.2s;"
                                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                                        placeholder="Título de la sesión">
                                                </td>

                                                <td style="padding: 16px;">
                                                    <input type="date" name="sesiones[{{ $i }}][fecha]"
                                                        value="{{ $s->fecha }}"
                                                        style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 2px solid #d1d5db; font-size: 14px; color: #1f2937; transition: border 0.2s;"
                                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                                </td>

                                                <td style="padding: 16px;">
                                                    <input type="time"
                                                        name="sesiones[{{ $i }}][hora_inicio]"
                                                        value="{{ $s->hora_inicio }}"
                                                        style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 2px solid #d1d5db; font-size: 14px; color: #1f2937; transition: border 0.2s;"
                                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                                </td>

                                                <td style="padding: 16px;">
                                                    <input type="time" name="sesiones[{{ $i }}][hora_fin]"
                                                        value="{{ $s->hora_fin }}"
                                                        style="width: 100%; padding: 10px 12px; border-radius: 8px; border: 2px solid #d1d5db; font-size: 14px; color: #1f2937; transition: border 0.2s;"
                                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                                </td>

                                                <td style="padding: 16px;">
                                                    <input type="text"
                                                        name="sesiones[{{ $i }}][descripcion]"
                                                        value="{{ $s->descripcion }}"
                                                        style="width: 100%; min-width: 250px; padding: 10px 12px; border-radius: 8px; border: 2px solid #d1d5db; font-size: 14px; color: #1f2937; transition: border 0.2s;"
                                                        onfocus="this.style.borderColor='#1B396A'; this.style.boxShadow='0 0 0 3px rgba(27, 57, 106, 0.1)';"
                                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';"
                                                        placeholder="Breve descripción">
                                                </td>

                                                <td style="padding: 16px;">
                                                    <button type="button"
                                                        onclick="if(confirm('¿Estás seguro de eliminar esta sesión?')) document.getElementById('del-{{ $s->id }}').submit();"
                                                        style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 8px 16px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; transition: all 0.2s; font-size: 13px; display: flex; align-items: center; gap: 6px;"
                                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.2)';"
                                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                                        <svg style="width: 14px; height: 14px;" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div
                                style="margin-top: 24px; display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                                <div style="color: #6b7280; font-size: 14px;">
                                    <svg style="width: 16px; height: 16px; color: #6b7280; display: inline-block; vertical-align: middle; margin-right: 6px;"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Los cambios se guardan para todas las sesiones
                                </div>
                                <button type="submit"
                                    style="background: linear-gradient(135deg, #1B396A 0%, #2a4b8a 100%); color: white; padding: 12px 28px; border-radius: 10px; border: none; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(27, 57, 106, 0.2)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                    <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Guardar calendarización
                                </button>
                            </div>
                        </form>

                        {{-- ✅ forms ocultos para eliminar (fuera del form principal) --}}
                        @foreach ($sesiones as $s)
                            <form id="del-{{ $s->id }}" method="POST"
                                action="{{ route('coordinador.calendarizacion.destroy', $s->id) }}"
                                style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script>
        // Manejar cambio de periodo
        document.getElementById('periodo_id').addEventListener('change', function() {
            document.getElementById('periodoHiddenInput').value = this.value;
            document.getElementById('periodoForm').submit();
        });
    </script>

    <style>
        @media (max-width: 1024px) {
            .user-info {
                padding: 16px !important;
            }

            .grid-template-cols-2 {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }

            h1 {
                font-size: 24px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            table {
                font-size: 13px !important;
            }

            input,
            select,
            button {
                font-size: 14px !important;
            }
        }

        @media (max-width: 768px) {
            .flex-justify-between {
                flex-direction: column !important;
                gap: 16px !important;
                align-items: flex-start !important;
            }

            .table-responsive {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }

            th,
            td {
                padding: 12px 8px !important;
                min-width: 120px !important;
            }
        }

        /* Estilos para selects personalizados */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem !important;
        }

        /* Remover flecha por defecto en IE */
        select::-ms-expand {
            display: none;
        }

        /* Estilo para inputs de fecha y hora */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            opacity: 0.6;
            cursor: pointer;
        }

        input[type="date"]:hover::-webkit-calendar-picker-indicator,
        input[type="time"]:hover::-webkit-calendar-picker-indicator {
            opacity: 1;
        }
    </style>
@endsection
