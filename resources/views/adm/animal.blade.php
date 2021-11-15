@extends('adm.layout')

@section('content')
<a href="{{url('animal/create')}}" class="button">Adicionar</a>
<table>
  <thead>
    <tr>
      <th>Nome</th>
      <th>Nascimento</th>
      <th>Imagem</th>
      <th>Editar</th>
      <th>Remover</th>
    </tr>
  </thead>
  <tbody>
    @foreach($animais as $animal)
    <tr>
      <td>{{$animal->nome}}</td>
      <td>{{$animal->nascimento}}</td>
      <td><img src="{{$animal->imagem}}" /></td>
      <td>
        <button type="button">Editar</button>
      </td>
      <td>
        <button type="button">Remover</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
