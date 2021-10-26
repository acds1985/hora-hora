<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bem vindo - {{ Auth::user()->name }} - Horas Extra Curriculares: <b class="px-2 py-2 text-green-700 bg-green-100 rounded"">{{ $totalhoras }}</b>   - Horas
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
             
                <div class="container flex justify-center">
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div class="border-b border-gray-200 shadow">
                                @if (session()->exists('message'))
                                    <div class="flex flex-col justify-between w-full px-4 mb-3 py-4 text-{{ session()->get('color') }}-700 bg-{{ session()->get('color') }}-100 rounded"> {{session()->get('message')}}</div>
                                @endif
                                <table class=" divide-y divide-gray-300 ">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                ID
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Nome
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Tipo
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Horas
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Adicionado em:
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Status
                                            </th>
                                            <th class="px-6 py-2 text-xs text-gray-500">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-300">
                                        @forelse ($data as $cert)
                                        <tr class="whitespace-nowrap">
                                            <td class="px-6 py-2 text-xs text-gray-500">
                                                {{ $cert->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="px-6 py-2 text-xs text-gray-500">
                                                  {{ $cert->titulo }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="px-6 py-2 text-xs text-gray-500">
                                                    {{ $cert->tipo }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="px-6 py-2 text-xs text-gray-500">
                                                    {{ $cert->horas }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="px-6 py-2 text-xs text-gray-500">
                                                    {{ date('d/m/Y H:i:s', strtotime( $cert->created_at)) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-2 text-xs text-gray-500">
                                                @if ($cert->status == 0)
                                                    <label class="px-4 py-1 text-sm text-yellow-600 bg-yellow-200 rounded-full">Em Analise</label>
                                                @elseif ($cert->status == 1)
                                                    <label class="px-4 py-1 text-sm text-green-600 bg-green-200 rounded-full">Homologado</label>
                                                @else
                                                    <label class="px-4 py-1 text-sm text-red-600 bg-red-200 rounded-full">Não-Homologado</label>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <a target="blank" href="{{ url("storage/$cert->path") }}" class="px-4 py-1 text-sm text-gray-600 bg-gray-200 rounded-full">Ver Aquivo</a>
                                                @if ($cert->status == 0)
                                                    <a href="{{ route('certificate.edit', ['id' => $cert->id]) }}" class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Editar</a>
                                                    <a href="{{ route('certificate.delete', $cert->id) }}" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Deletar</a>
                                                @endif    
                                            </td>
                                        </tr>
                                    </tbody>
                                        @empty
                                    </table>
                                            <div class=" flex flex-col justify-between w-full px-4 mb-3 py-4 text-yellow-700 bg-yellow-100 rounded">
                                                <span>
                                                    Não há certificados.
                                                </span>
                                            </div>
                                        @endforelse
                                        
                            </div>
                        </div>
                    </div>
                  </div>
           
        </div>
    </div>
</x-app-layout>
