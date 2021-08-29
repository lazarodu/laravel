@extends('adm.layout')

@section('content')
<form method="POST" action="{{url('animal')}}">
    @csrf
    @method('POST')
    <div class="row">
        <label class="col-2" for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="col-5" />
        <label class="col-2" for="nasc">Nascimento</label>
        <input type="date" name="nascimento" id="nasc" class="col-3" />
    </div>
    <button type="submit" class="button">Salvar</button>
</form>
@endsection
