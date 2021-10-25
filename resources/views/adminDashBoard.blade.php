<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificados Enviados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->exists('message'))
                <div class="flex flex-col justify-between w-full px-4 mb-3 py-4 text-{{ session()->get('color') }}-700 bg-{{ session()->get('color') }}-100 rounded"> {{session()->get('message')}}</div>
            @endif  
            <form method="post" action="{{ route('certificate.search') }}">
                @csrf
                <div class="">
                  <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-12 md:mb-0">
                      <input name="search" value="{{ old('search') }}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" type="text" placeholder="Pesquisar pelo nome..." required>
                    </div>
                    <div class="md:w-full px-3">
                        <button type="submit" class="bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full">
                          Pesquisar
                        </button>
                    </div>                                     
                  </div>
                </div>
              </form>
                <div class="container flex justify-center">
                    <div class="flex flex-col">
                        <div class="w-full">
                            <div class="border-b border-gray-200 shadow">
                                <table class=" divide-y divide-gray-300 ">
                                    @if (isset($data))
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
                                                Aluno
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
                                    @endif
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
                                                    {{ $cert->student()->first()->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="px-6 py-2 text-xs text-gray-500">
                                                    {{ $cert->horas }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="px-6 py-2 text-xs text-gray-500">
                                                    {{ date('d/m/Y', strtotime( $cert->created_at)) }}
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
                                                <a href="{{ route('certificate.approve', ['id' => $cert->id]) }}" class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Homologar</a>
                                                <a href="{{ route('certificate.notapprove', ['id' => $cert->id]) }}" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Não Homologar</a>
                                            </td>
                                        </tr>
                                        @empty
                                       
                                        <span class=" flex flex-col justify-between w-full px-4 mb-3 py-4 text-yellow-700 bg-yellow-100 rounded">
                                            Não há certificados.
                                        </span>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                            @if (isset($filters))
                                {{ $data->appends($filters)->links() }}
                            @else
                                {{ $data->links() }}
                            @endif
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
           
</x-app-layout>
