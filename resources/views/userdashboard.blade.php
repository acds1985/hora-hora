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
                    <div class="unit w-2-3"><div class="hero-callout">
                        <table id="tablecert" class="display" style="width:100%">
                                    @if (isset($data))
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Nome
                                            </th>
                                            <th>
                                                Tipo
                                            </th>
                                            <th>
                                                Horas
                                            </th>
                                            <th>
                                                Adicionado em:
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    @endif
                                    <tbody>
                                        @foreach($data as $cert)
                                        <tr align="center">
                                            <td>
                                                {{ $cert->id }}
                                            </td>
                                            <td>
                                               
                                                  {{ $cert->titulo }}
                                                
                                            </td>
                                            <td>
                                                
                                                    {{ $cert->tipo }}
                                               
                                            </td>
                                            <td>
                                               
                                                    {{ $cert->horas }}
                                               
                                            </td>
                                            <td>
 
                                                    {{ date('d/m/Y', strtotime( $cert->created_at)) }}
                                               
                                            </td>
                                            <td>
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
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>    
                </div>
        </div>
    </div>
</x-app-layout>
