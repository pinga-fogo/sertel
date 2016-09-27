@extends('admin.base')

 
@section('content')

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Tarifas
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i> Tarifas
                </li>
            </ol>                   
      </div>
    </div>
<form action="{{route('admin.tarifas.save')}}" method='post'>
{{ csrf_field() }}

<input type="submit" class="btn btn-info btn-block" value="Salvar"/>
<br>

<table class="table sorting_1 tabelaCentralizada">
		<thead>
			<td> Operadora</td>
			<td> Tarifa para fixo</td>
			<td> Tarifa para móvel</td>
		</thead>
		<tbody>
		@foreach($tarifas as $t)
		<tr>
			<td>
				{{$t[0]->operadora}}
			</td>
			<td>
				<input type='text' class='monetario' name="{{$t[0]->operadora}}_fixo" value='R$ {{$t[0]->tarifa_fixo}}'>
			</td>
			<td>
				<input type='text'  class='monetario' name="{{$t[0]->operadora}}_movel" value="R$ {{$t[0]->tarifa_movel}}">
			</td>
		</tr>
		</tbody>
	@endforeach
</table>  



@endsection
</form>


@push('scripts')
<script src='/assets/js/maskmoney.js'></script>
<script>

$(function(){
   
 $(".monetario").each(function(){ 
 $(this).maskMoney({
 prefix:'R$ ', 
 showSymbol:true,
 thousands:'.',
 decimal:',',
 allowNegative: false,
 symbolStay: false
});

 });
});
</script>
@endpush