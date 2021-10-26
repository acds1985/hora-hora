<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificadosRequest;
use App\Models\Certificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CertificadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('certificados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificadosRequest $request)
    {
        $data = $request->all();

        if($request->file('path')->isValid()){

            $nameFile = Str::slug($request->titulo, '-'). '.' .$request->path->getClientOriginalExtension();

            $path = $request->path->storeAS('certificados', $nameFile);
 
            $data['path'] = $path;
            $data['user_id'] = Auth::user()->id;
            $data['status'] = 0 ;

            Certificados::create($data);

            return redirect()
                        ->route('dashboard')
                        ->with([
                            'color' => 'green',
                            'message' =>'Certificado Enviado com Sucesso!'
                        ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificados  $certificados
     * @return \Illuminate\Http\Response
     */
    public function show(Certificados $certificados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificados  $certificados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$certificado = Certificados::where( 'id', $id)->first()){
            return redirect()
                ->route('dashboard')
                ->with([
                    'color' => 'red',
                    'message' => 'Certificado não encontrado'
            ]);
        }elseif(!$certificado->status == 0){
            return redirect()
                ->route('dashboard')
                ->with([
                    'color' => 'red',
                    'message' => 'Certificado já analisado, não é possivel editar'
            ]);
        }else{
            return view('certificados.edit', compact('certificado'));

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificados  $certificados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        if(!$certificado = Certificados::find($id)){
            return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'red',
                        'message' => 'Certificado não encontrado'
                    ]);
        }elseif(!$certificado->status == 0){
            return redirect()
                ->route('dashboard')
                ->with([
                    'color' => 'red',
                    'message' => 'Certificado já analisado, não é possivel editar'
            ]);
        }else{

            $data = $request->all();

            if($request->path){
                if(Storage::exists($certificado->path)){
                    Storage::delete($certificado->path);
                }

                $nameFile = Str::slug($request->titulo, '-'). '.' .$request->path->getClientOriginalExtension();
                $path = $request->path->storeAS('certificados', $nameFile);
                $data['path'] = $path;              
            }
            
            $certificado->update($data);
            //$certificado->update($request->all());
        
            return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'green',
                        'message' =>'Certificado Atualizado!'
                    ]);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificados  $certificados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$certificado = Certificados::where( 'id', $id)->first()){
            return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'red',
                        'message' => 'Certificado não encontrado'
                    ]);
        }

        if(Storage::exists($certificado->path)){
            Storage::delete($certificado->path);
        }

        $certificado->delete();

        return redirect()
                ->route('dashboard')
                ->with([
                    'color' => 'green',
                    'message' =>'Certificado Deletado com Sucesso!'
        ]);

    }

    public function approve($id)
    {   
        if(!$certificado = Certificados::find($id)){
            return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'red',
                        'message' => 'Certificado não encontrado'
                    ]);
        }

        $certificado->status = 1;
        $certificado->update();

        return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'green',
                        'message' =>'Certificado homologado com sucesso!'
                    ]);

    }

    
    public function notApprove($id)
    {   
        if(!$certificado = Certificados::find($id)){
            return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'red',
                        'message' => 'Certificado não encontrado'
                    ]);
        }

        $certificado->status = 2;
        $certificado->update();

        return redirect()
                    ->route('dashboard')
                    ->with([
                        'color' => 'green',
                        'message' =>'Certificado Recusado com sucesso!'
                    ]);

    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $data = Certificados::where('titulo', 'LIKE', "%{$request->search}%")->paginate(10);

        return view('adminDashBoard', compact('data', 'filters'));
                                        
    }
}
