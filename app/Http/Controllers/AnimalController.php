<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    // $files = Storage::disk('google')->allFiles();
    // print_r($files);
    // Storage::disk('google')->setVisibility($files[0], 'public');
    // $visibility = Storage::disk('google')->getVisibility($files[0]);
    // $url = Storage::disk('google')->url($files[0]);
    // print_r($url);
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
      'imagem' => 'required|image'
    ]);
    if ($validated) {
      $animal = new Animal();
      $animal->nome = $request->get('nome');
      $animal->nascimento = $request->get('nascimento');
      $path = $request->file('imagem')->store('', 's3');
      // $files = Storage::disk('s3')->allFiles();
      // Storage::disk('s3')->setVisibility($files[count($files) - 1], 'public');
      // $url = Storage::disk('s3')->url($files[count($files) - 1]);
      Storage::disk('s3')->setVisibility($path, 'public');
      $url = Storage::disk('s3')->url($path);
      $animal->imagem = $url;
      // $animal->imagem = $request->get('imagem');
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
    return view('adm/animal/edit', compact('animal'));
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
    $validated = $request->validate([
      'nome' => 'required|max:255',
      'nascimento' => 'required|date',
      'imagem' => 'required|image'
    ]);
    if ($validated) {
      $animal->nome = $request->get('nome');
      $animal->nascimento = $request->get('nascimento');
      $path = $request->file('imagem')->store('', 's3');
      Storage::disk('s3')->setVisibility($path, 'public');
      $url = Storage::disk('s3')->url($path);
      $animal->imagem = $url;
      $animal->save();
      return redirect('animal');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Animal  $animal
   * @return \Illuminate\Http\Response
   */
  public function destroy(Animal $animal)
  {
    $animal->delete();
    return redirect('animal');
  }
}
