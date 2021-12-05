@extends('adm.layout')

@section('content')
@if(count($errors) > 0)
<ul>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
@endif
<form method="POST" action="{{url('animal',$animal->id)}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row">
    <label class="col-2" for="nome">Nome</label>
    <input type="text" name="nome" id="nome" class="col-5" value="{{ $animal->nome }}" />
    <label class="col-2" for="nasc">Nascimento</label>
    <input type="date" name="nascimento" id="nasc" class="col-3" value="{{ $animal->nascimento }}" />
    <label class="col-2" for="img">Imagem</label>
    <input type="file" name="imagem" id="img" class="col-10" />
    <img src="{{$animal->imagem}}" />
  </div>
  <button type="submit" class="button">Salvar</button>
</form>
@endsection
