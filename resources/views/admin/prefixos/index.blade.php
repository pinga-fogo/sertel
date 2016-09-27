@extends('admin.base')
@section('content')

<div class="row">
    <div class="col-lg-12">
       <h1 class="page-header">
                Prefixos
            </h1>
        <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i> Prefixos
                </li>
                
                <a href='{{route("admin.tarifas.index")}}'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i>&nbsp Tarifas </span></a>

                <a href='{{route("admin.black_list.index")}}'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i>&nbsp Black List </span></a>

                <a href='{{route("admin.white_list.index")}}'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-usd fa-2x" aria-hidden="true"></i>&nbsp White List </span></a>
            </ol>
    </div>
</div>


<div class="container">
  <br>
  <ul class="nav nav-tabs">
    <li class="{{isset($tab) ?$tab == 'fixo' ? 'active' : '' : ''}}"><a data-toggle="tab" href="#fixo">Fixo</a></li>
    <li class="{{isset($tab) ?$tab == 'movel' ? 'active' : '': ''}}"><a data-toggle="tab" href="#movel">Móvel</a></li>
    <li class="{{isset($tab) ?$tab == 'ddi' ? 'active' : '': ''}}"><a data-toggle="tab" href="#ddi">DDI</a></li>
    <li class="{{isset($tab) ?$tab == 'servicos' ? 'active' : '': ''}}"><a data-toggle="tab" href="#numServicos">Números de Serviço</a></li>
    <li class="{{isset($tab) ?$tab == 'especiais' ? 'active' : '': ''}}"><a data-toggle="tab" href="#numEspeciais">Números Especiais</a></li>
  </ul>

  <div class="tab-content">
  <div id="fixo" class="tab-pane fade in {{isset($tab) ?$tab == 'fixo' ? 'active' : '': ''}}">
    <br>
 
 <div class="row">
  <form id='submit_fixo_local'>  
		      <div class='col-md-6'> 
			      <fieldset class='scheduler-border'> 
			          <legend  class='scheduler-border'>Fixo-Local </legend>
					            <h3 class="text-center">Troncos</h3>
					            
					            <div class="well" style="max-height: 300px;overflow: auto;">
									                 	   <table id='tabela_fixo_local' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['fixo_local']))
													                 	 @foreach ($troncosAdicionados['fixo_local'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/fixo_local/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='fixo_local'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 	  @else
													                      <span>Nenhum tronco associado!</span>
													                 @endif  
													          </table>    
							    </div>
								            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['fixo_local'] == null ? $a = array() : $troncosAdicionados['fixo_local'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/fixo_local/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='fixo_local' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
										  </div>
			      </fieldset>
			  </div>
    </form>
    <form id='submit_fixo_ddd'> 
		  <div class='col-md-6'> 
						      <fieldset  class='scheduler-border'> 
						          <legend  class='scheduler-border'>Fixo-DDD </legend >
								        <div class="row">
								            <h3 class="text-center">Troncos</h3>
								            <div class="well" style="max-height: 300px;overflow: auto;">
									                 	   <table id='tabela_fixo_ddd' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['fixo_ddd']))
													                 	 @foreach ($troncosAdicionados['fixo_ddd'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/fixo_ddd/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='fixo_ddd'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 	 @else
													                     <span>Nenhum tronco associado!</span>
													                  @endif  
													          </table>    
								            </div>
								            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['fixo_ddd'] == null ? $a = array() : $troncosAdicionados['fixo_ddd'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/fixo_ddd/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='fixo_ddd' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
										  </div>
								        </div>
						      </fieldset>

		       </div>
  </form>
 </div>

   </div>
    <div id="movel" class="tab-pane fade in {{isset($tab) ?$tab == 'movel' ? 'active' : '': ''}}">
	     <br>


 <div class="row">
     <form id='submit_movel_local'>  	     
		      <div class='col-md-6'> 
			      <fieldset class='scheduler-border'> 
			          <legend  class='scheduler-border'>Móvel-Local </legend>
					            <h3 class="text-center">Troncos</h3>
					            <div class="well" style="max-height: 300px;overflow: auto;">
									                 	   <table id='tabela_movel_local' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['movel_local']))
													                 	 @foreach ($troncosAdicionados['movel_local'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/movel_local/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='movel_local'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 @else
													                      <span>Nenhum tronco associado!</span>
													                 @endif

													               
      																
													          </table>    
								            </div>
								            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['movel_local'] == null ? $a = array() : $troncosAdicionados['movel_local'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/movel_local/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='movel_local' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
										  </div>
			      </fieldset>
			  </div>
	</form>
	<form id='submit_movel_ddd'>
			  <div class='col-md-6'> 
						      <fieldset  class='scheduler-border'> 
						          <legend  class='scheduler-border'>Móvel-DDD </legend >
								        <div class="row">
								            <h3 class="text-center">Troncos</h3>
								            <div class="well" style="max-height: 300px;overflow: auto;">
									                 	   <table id='tabela_movel_ddd' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['movel_ddd']))
													                 	 @foreach ($troncosAdicionados['movel_ddd'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/movel_ddd/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='movel_ddd'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 	  @else
													                      <span>Nenhum tronco associado!</span>
													                 @endif  
													          </table>    
								            </div>
								            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['movel_ddd'] == null ? $a = array() : $troncosAdicionados['movel_ddd'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/movel_ddd/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='movel_ddd' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
										  </div>
								        </div>
					      </fieldset>
		       </div>	
	 </form>
    </div>
    </div>
    <div id="ddi" class="tab-pane fade in {{isset($tab) ?$tab == 'ddi' ? 'active' : '': ''}}">
		   
			   <form id='submit_ddi' action="{{route('admin.prefixos.save')}}/ddi">  		
			     <div class='col-md-2'> </div>
					     <div class='col-md-8'>
									      <fieldset  class='scheduler-border'> 
									          <legend  class='scheduler-border'>DDI </legend >
											        <div class="row">
											            <h3 class="text-center">Troncos</h3>
											            <div class="well">
												        		<table id='tabela_ddi' name='a' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['ddi']))
													                 	 @foreach ($troncosAdicionados['ddi'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/ddi/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='ddi'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 	  @else
													                      <span>Nenhum tronco associado!</span>
													                 @endif  
													            </table>     
													            <br>
													            <br>
											            </div>
											            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['ddi'] == null ? $a = array() : $troncosAdicionados['ddi'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/ddi/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='ddi' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
													      </div>
											        </div>
									      </fieldset>
				 </div>
			<div class='col-md-2'> </div>
			</form>
    </div>
    <div id="numServicos" class="tab-pane fade in {{isset($tab) ?$tab == 'servicos' ? 'active' : '': ''}}">
                <br>
	  <form id='submit_servicos' action="{{route('admin.prefixos.save')}}/servicos">  	
					
			     <div class='col-md-2'> </div>
					     <div class='col-md-8'>
									      <fieldset  class='scheduler-border'> 
									          <legend  class='scheduler-border'>Números de servicos </legend >
											        <div class="row">
											            <h3 class="text-center">Troncos</h3>
											            <div class="well">
												        		<table id='tabela_servicos' name='a' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['servicos']))
													                 	 @foreach ($troncosAdicionados['servicos'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/servicos/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='servicos'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 	  @else
													                      <span>Nenhum tronco associado!</span>
													                 @endif  
													            </table>     
													            <br>
													            <br>
											            </div>
											            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['servicos'] == null ? $a = array() : $troncosAdicionados['servicos'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/servicos/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='servicos' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
													            </div>
											        </div>
									      </fieldset>
				 </div>
			<div class='col-md-2'> </div>
			</form>
    </div>
    <div id="numEspeciais" class="tab-pane fade in {{isset($tab) ?$tab == 'especiais' ? 'active' : '': ''}}">
      <div class='col-md-2'> </div>
      <br>
       <form id='submit_especiais' action="{{route('admin.prefixos.save')}}/especiais">  	
					
			     <div class='col-md-2'> </div>
					     <div class='col-md-8'>
									      <fieldset  class='scheduler-border'> 
									          <legend  class='scheduler-border'>Números Especiais </legend >
											        <div class="row">
											            <h3 class="text-center">Troncos</h3>
											            <div class="well">
												        		<table id='tabela_especiais' style='background:#FFF' class='ordenavel table tgHardware troll-border sorting_1'>
												        	      	  @if(isset($troncosAdicionados['especiais']))
													                 	 @foreach ($troncosAdicionados['especiais'] as $key=>$t)	
													                       <tr>	
													                       <td class='sorter' data-id='{{$t['id']}}'>
													                       {{$key == 0 ? 'Principal' : 'Aux. '.$key}}
													                       </td>
													                       <td>  
													                       <input type='checkbox' name='troncos' value='{{$t['id']}}' checked class='hidden'/>
													                       {{$t['nome']}}
																		   </td>
																		   <td style="max-width:10px">
																		   <a href="{{route('admin.prefixos.removerTronco')}}/especiais/{{$t['id']}}"><i class='fa fa-times fake-linkRed delTronco' data-name="{{$t['nome']}}" data-id='{{$t['id']}}' data-type='especiais'> </i></a>
																		   </td>
							                                              </tr>
													                 	 @endforeach
													                 	  @else
													                      <span>Nenhum tronco associado!</span>
													                 @endif  

													            </table>     
													            <br>
													            <br>
											            </div>
											            <div id='todos_troncos'>
													                 @if( isset($troncos) )
													                 	 @foreach ($troncos as $t)
													                        @if( array_search($t->id, array_column($troncosAdicionados['especiais'] == null ? $a = array() : $troncosAdicionados['especiais'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
													                        <div>
													                        <a href='{{route('admin.prefixos.adicionarTronco')}}/especiais/{{$t->id}}'><i class="fa fa-plus-square fa-lg addTronco"  data-name='{{$t->nome}}' data-id='{{$t->id}}' data-type='especiais' aria-hidden="true"></i></a>
													                        {{$t->nome}}
													                        </div>
													                        <br>
													                        @endif

													                 	 @endforeach
													                 @endif           
													            </div>
											        </div>
									      </fieldset>
				 </div>
			<div class='col-md-2'> </div>
			</form>
    </div>
  </div>


</div>


@endsection
@push('scripts')
<script src='/assets/js/jquery.sortable.min.js'>
</script>

<script>
$(function(){

$('.ordenavel').each(function(){
	console.log('1');
	 RowSorter('#'+$(this).attr('id'), {
          handler: 'td.sorter',
          stickFirstRow : true,
          stickLastRow  : false,
          onDragStart: function(tbody, row, index)
          {  
             console.log('iniciando drag...');             
          },
          onDrop: function(tbody, row, new_index, old_index)
          {
              console.log('finalizou drag...');             
              
              var tipo = row.parentNode.parentNode.getAttribute('id').split('_')[1]; //pega o tipo de acordo com a linha que foi clicada
              
              if (tipo == 'movel' || 'local'){
              	tipo += '_'+row.parentNode.parentNode.getAttribute('id').split('_')[2]; //pega depois do segundo _
              }
              var array = []; //array para guardar os valores da variável troncos...
              
              $("#submit_"+tipo+" input[name=troncos]").each(function(){
              	     array.push( $(this).val() );
              });
        

              var data = {
              	'troncos': array,
               }
             

              $.ajax({
                  url: "{{route('admin.prefixos.save')}}/"+tipo+"", //this is the submit URL
                  type: 'get', //or POST
                  data : data,
                  success: function(response) 
                  {                         
                     if(response){
                     	console.log('salvando alteração...');
                     } else {
                     	console.log('erro ao salvar alteração...');
                     }   
                  }
              });  

              resetIndexes(tipo);
          }
});

});




function resetIndexes(tipo)
    {
            $('#tabela_'+tipo+' .sorter').each(function (index) {
                  if(index == 0){
                  	 $(this).html('Principal');
                  } else {
                  	 $(this).html('Aux. '+index);
                  }
            }); 
            console.log('resetando índices da tabela_'+tipo+'...')
    }

});



</script>
@endpush 