<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Tutor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <p class="text-gray-700">Bienvenido, {{ auth()->user()->name }} ({{ auth()->user()->rol }})</p>
            </div>
        </div>
    </div>
</x-app-layout>
