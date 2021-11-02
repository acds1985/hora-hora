<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enviar Certificado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <div class="flex flex-col justify-between w-full px-4 mb-3 py-4 text-red-700 bg-red-100 rounded"></i>{{$error}}</div>                 
                  @endforeach
            @endif           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Validation Errors -->
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('certificados.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                          <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-12 md:mb-0">
                              <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="company">
                                Titulo
                              </label>
                              <input name="titulo" value="{{ old('titulo') }}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" type="text" placeholder="Titulo do Certificado" required>
                              
                            </div>
                            <div class="md:w-1/2  px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="application-link">
                                  horas
                                </label>
                                <input name="horas" value="{{ old('horas') }}" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-2 mb-2"  type="number" required>
                              </div>
                            
                          </div>
                          <div class="-mx-3 md:flex mb-2">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                              <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="location">
                                    Tipo  
                              </label>
                              <div>
                                <select name="tipo" class="w-full bg-gray-200 border border-gray-200 text-black text-xl py-3 px-4 pr-8 mb-3 rounded" id="location" required>
                                  <option value="" disabled selected>Selecione o tipo</option>
                                  <option value="Presencial">Presencial</option>
                                  <option value="OnLine">On-Line</option>
                                  
                                </select>
                              </div>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="title">
                                  Arquivo
                                </label>
                                <input name="path" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="title" type="file" required>
                              </div>
                            
                          </div>
                          <div class="-mx-3 md:flex mt-2">
                            <div class="md:w-full px-3">
                              <button type="submit" class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full">
                                Enviar
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>