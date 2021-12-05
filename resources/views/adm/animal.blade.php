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
        <button type="button" onclick="window.location.href='{{route('animal.edit',$animal->id)}}'">
          Editar
        </button>
      </td>
      <td>
        <form method="POST" action="{{route('animal.destroy',$animal->id)}}" onsubmit="return confirm('tem certeza?');">
          @csrf
          @method('DELETE')
          <button type="submit">
            Remover
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
