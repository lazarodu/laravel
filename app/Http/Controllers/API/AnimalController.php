<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AnimalController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $animais = Animal::with('vacinacao')->get();
    return $this->success($animais);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nome' => 'required|max:255',
      'nascimento' => 'required|date',
      'imagem' => 'required'
    ]);
    if ($validated) {
      $animal = new Animal();
      $animal->nome = $request->get('nome');
      $animal->nascimento = $request->get('nascimento');
      $animal->imagem = $request->get('imagem');
      $animal->save();
      return $this->success($animal);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $animal = Animal::where('id', $id)->with('vacinacao')->get();
      return $this->success($animal[0]);
    } catch (\Throwable $th) {
      return $this->error("Animal não encontrado!!!", 401, $th->getMessage());
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'nome' => 'max:255',
      'nascimento' => 'date',
      'castracao' => 'date',
    ]);
    if ($validated) {
      $animal = Animal::findOrFail($id);
      if ($request->get('nome'))
        $animal->nome = $request->get('nome');
      if ($request->get('nascimento'))
        $animal->nascimento = $request->get('nascimento');
      if ($request->get('castracao'))
        $animal->castracao = $request->get('castracao');
      $animal->save();
      return $this->success($animal);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $animal = Animal::findOrFail($id);
      $animal->delete();
      return $this->success($animal);
    } catch (\Throwable $th) {
      return $this->error("Erro ao apagar o Animal!!!", 401, $th->getMessage());
    }
  }

  public function deleteCastracao($id)
  {
    try {
      echo $id;
      $animal = Animal::findOrFail($id);
      $animal->castracao = null;
      $animal->save();
      return $this->success($animal);
    } catch (\Throwable $th) {
      return $this->error("Animal não encontrado!!!", 401, $th->getMessage());
    }
  }
}
