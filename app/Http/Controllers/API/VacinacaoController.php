<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vacinacao;
use Illuminate\Http\Request;

class VacinacaoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
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
      'animal_id' => 'required|integer|exists:App\Models\Animal,id',
      'nome' => 'required|max:255',
      'data' => 'required|date',
    ]);
    if ($validated) {
      $animal = new Vacinacao();
      $animal->animal_id = $request->get('animal_id');
      $animal->nome = $request->get('nome');
      $animal->data = $request->get('data');
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
      $animais = Vacinacao::where('animal_id', $id);
      return $this->success($animais);
    } catch (\Throwable $th) {
      return $this->error("Vacina não encontrada!!!", 401, $th->getMessage());
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
    try {
      $validated = $request->validate([
        'animal_id' => 'required|integer|exists:App\Models\Animal,id',
        'nome' => 'required|max:255',
        'data' => 'required|date',
      ]);
      if ($validated) {
        $animal = Vacinacao::findOrFail($id);
        $animal->animal_id = $request->get('animal_id');
        $animal->nome = $request->get('nome');
        $animal->data = $request->get('data');
        $animal->save();
        return $this->success($animal);
      }
    } catch (\Throwable $th) {
      return $this->error("Erro ao alterar a Vacina!!!", 401, $th->getMessage());
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
      $vacina = Vacinacao::findOrFail($id);
      $vacina->delete();
      return $this->success($vacina);
    } catch (\Throwable $th) {
      return $this->error("Erro ao apagar a Vacinacao!!!", 401, $th->getMessage());
    }
  }
}
