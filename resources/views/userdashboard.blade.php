<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bem vindo - {{ Auth::user()->name }} - Horas Extra Curriculares: <b class="px-2 py-2 text-green-700 bg-green-100 rounded"">{{ $totalhoras }}</b>   - Horas
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->exists('message'))
                <div class="flex flex-col justify-between w-full px-4 mb-3 py-4 text-{{ session()->get('color') }}-700 bg-{{ session()->get('color') }}-100 rounded"> {{session()->get('message')}}</div>
            @endif  
            
                <div class="container">
                    <div class="unit w-2-3">
                        <div class="hero-callout">
                            <table class="divide-y divide-gray-300" id="tablecert">
                                <thead class="bg-black">
                                    <tr>
                                        <th class="px-6 py-2 text-xs text-white">
                                            ID
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            Nome
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            Tipo
                                        </th>
                                        
                                        <th class="px-6 py-2 text-xs text-white">
                                            Horas
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            Adicionado em:
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            Status
                                        </th>
                                        <th class="px-6 py-2 text-xs text-white">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-300">
                                    @foreach($data as $cert)
                                    <tr class="text-center whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $cert->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $cert->titulo }}
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $cert->tipo }}
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            {{ $cert->horas }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ date('d/m/Y', strtotime( $cert->created_at)) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if ($cert->status == 0)
                                                <label class="px-4 py-1 text-sm text-yellow-600 bg-yellow-200 rounded-full">Em Analise</label>
                                            @elseif ($cert->status == 1)
                                                <label class="px-4 py-1 text-sm text-green-600 bg-green-200 rounded-full">Homologado</label>
                                            @else
                                                <label class="px-4 py-1 text-sm text-red-600 bg-red-200 rounded-full">Não-Homologado</label>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <a title="Ver Arquivo" target="blank" href="{{ url("storage/$cert->path") }}" class="inline-block text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                  </svg>
                                            </a>
                                            @if ($cert->status == 0)
                                                <a title="Editar Certificado" href="{{ route('certificate.edit', ['id' => $cert->id]) }}" class="inline-block text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                      </svg>
                                                </a>
                                                <a title="Deletar Certificado" href="{{ route('certificate.delete', $cert->id) }}" class="inline-block text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                      </div>
                    </div>    
                </div>
        </div>
    </div>
</x-app-layout>
