<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificados Enviados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            @if (session()->exists('message'))
                <div class="flex flex-col justify-between w-full px-4 mb-3 py-4 text-{{ session()->get('color') }}-700 bg-{{ session()->get('color') }}-100 rounded"> {{session()->get('message')}}</div>
            @endif  
            
                <div class="w-full">
                    <div class="unit w-2-3">
                        <div class="hero-callout">
                            <table id="tablecert" class="display">
                                        @if (isset($data))
                                        <thead class="bg-gray-50">
                                            <tr class="w-auto">
                                              
                                                <th>
                                                    Nome
                                                </th>
                                                <th>
                                                    Tipo
                                                </th>
                                                <th>
                                                    Aluno
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
                                                <th >
                                                    Ações
                                                </th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @foreach($data as $cert)
                                            <tr align="center" class="w-1/2 md:w-full">
                                            
                                                <td>
                                                
                                                    {{ $cert->titulo }}
                                                    
                                                </td>
                                                <td>
                                                    
                                                        {{ $cert->tipo }}
                                                
                                                </td>
                                                <td >
                                            
                                                        {{ $cert->student()->first()->name }}
                                                    
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
                                                <td align="center">
                                                    

                                                        <a target="blank" href="{{ url("storage/$cert->path") }}" class="px-4 py-1 text-sm text-gray-600 bg-gray-200 rounded-full">Ver Aquivo</a>
                                                        <a href="{{ route('certificate.approve', ['id' => $cert->id]) }}" class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Homologar</a>
                                                        <a href="{{ route('certificate.notapprove', ['id' => $cert->id]) }}" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Não Homologar</a>
                                                    
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
