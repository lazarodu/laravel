<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $animais = Animal::all();
    return view('adm/animal', compact('animais'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('adm/animal/create');
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
    ]);
    if ($validated) {
      $animal = new Animal();
      $animal->nome = $request->get('nome');
      $animal->nascimento = $request->get('nascimento');
      $animal->save();
      return redirect('animal');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Animal  $animal
   * @return \Illuminate\Http\Response
   */
  public function show(Animal $animal)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Animal  $animal
   * @return \Illuminate\Http\Response
   */
  public function edit(Animal $animal)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Animal  $animal
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Animal $animal)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Animal  $animal
   * @return \Illuminate\Http\Response
   */
  public function destroy(Animal $animal)
  {
    //
  }
}
