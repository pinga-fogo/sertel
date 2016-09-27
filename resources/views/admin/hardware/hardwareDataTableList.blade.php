<!-- Page Heading -->

    <div class="col-lg-12">
        <div class="table-responsive">
            <div class="panel-body">         
             <table id="tabela" class="table tgHardware">          
                
                 <thead class="">
                    <th style='text-align: center' class="harder dtcenter ordenacao"> Ordenação </th>
                    <th style='text-align: center' class="harder dtcenter">Serial </th>
                    <th style='text-align: center' class="harder dtcenter">Tipo </th> 
                    <th style='text-align: center' class="harder dtcenter">IP</th>
                    <th style='text-align: center' class="harder dtcenter">Perfil</th> 
                    <th style='text-align: center' class="harder dtcenter">Ações </th>
                 </thead>
                 
                 <tbody>
               @if (isset($hardwares))
                  @foreach ($hardwares as $h)  
                    <tr class=""> 
                      <td class='sorter'>  {{$h->board}} </td>
                      <td class="">{{ $h->serial }}</td>
                      <td class="">{{ $h->tipo }} - {{ $h->portas}} </td>
                      <td class=""><form action="{{ route('admin.hardware.write') }}" method="get">                                    
                                   <p>{{ $h->ip }}</p</td>
                      <td class=""> {{ isset($h->tipo) ? $h->tipo : '' }} <div class=" {{ $h->tipo   == 'E1' ? '' : 'hidden' }}"></div> </td>
                      <td class=""></form><a href="{{route('admin.hardware.edit')}}/{{$h->id}}" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o "></i></a>               
                    </form>
                    <a data-id="{{$h->id}}" data-action="confirm-delete" data-title="Exclusão" data-text="
                    {{  isset($h->dependencia) ? $h->dependencia == 1 ? 'Existem juntores correspondentes a este hardware, eles também serão excluídos. ' :  '' : '' }}
                    Deseja realmente deletar esse hardware?" href="{{ route('admin.hardware.destroy') }}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a> <input type='text' id='stringbuffer1' name='stringbuffer1' class='hidden' value="serial={{$h->serial }},tipo={{$h->tipo }},portas={{$h->portas }}"> </form></td>
                    </tr>
                @endforeach
               @endif    <tr class="">
               
               @if (isset($e1)) 
                @foreach ($e1 as $e1)
                   <td class='sorter'> {{$e1['hardware']->board}} </td>
                   <td class="">{{ $e1['hardware']->serial }}</td>
                    <td class="">{{ $e1['hardware']->tipo }} - {{ $e1['hardware']->portas }} </td>
                    <td class=""><form action="{{ route('admin.hardware.write') }}" method="get">                                 
                                 <p>{{ $e1['hardware']->ip  }}</p</td>
                    <td class=""> 
                        <div class="">    
                          <table class="dtcenter2" id="tabelaInterna">
                          <tr><td><p>  Link 0:  </td><td> {{ $e1['perfis'][0]}} </p></td></tr>
                          <tr class="{{isset($e1['perfis'][1]) ? '' : 'hidden'}}"><td><p class = "{{isset($e1['perfis'][1]) ? '' : 'hidden'}}"> Link 1: </td><td> {{isset($e1['perfis'][1]) ? $e1['perfis'][1] : '' }}</td></p></tr>
                          <tr class="{{isset($e1['perfis'][2]) ? '' : 'hidden'}}"><td><p class = "{{isset($e1['perfis'][2]) ? '' : 'hidden'}}"> Link 2: </td><td>{{isset($e1['perfis'][2]) ? $e1['perfis'][2] : '' }}</td></p></tr>
                          <tr class="{{isset($e1['perfis'][3]) ? '' : 'hidden'}}"><td><p class = "{{isset($e1['perfis'][3]) ? '' : 'hidden'}}"> Link 3: </td><td>{{isset($e1['perfis'][3]) ? $e1['perfis'][3] : '' }}</td></p></tr>
                          </table>
                          
                       </div> 
                    </td>
                    <td class=""></form>
                    <a href="{{route('admin.hardware.edit')}}/{{$e1['hardware']->id}}" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o "></i></a> 
                    <a data-id="{{$e1['hardware']->id}}" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse hardware?" href="{{ route('admin.hardware.destroy') }}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a></td>
                   </tr>
                 @endforeach 
                @endif
                   </tbody>
                   </table>

    <div id='modalsContainer'>
    </div>
@push('scripts')
  <script src="/assets/js/jquery.tablesorter.min.js"></script>
    <script>
    //var table = '';
    function resetIndexes()
    {
            $('.sorter').each(function (index) {
                   $(this).html(index);
            }); 
            console.log('resetando índices...')
    }
    
   function atualizaBanco()
   {
      var data = [];
         
         $('.sorter').each(function (index) //gera um vetor com os novos valores
         {     
            data[index] = 
            {
              'serial' : $(this).next().html(),
            }
         });

         $.ajax({
                  url: "{{route('admin.hardware.updatePosicoes')}}", //this is the submit URL
                  type: 'get', //or POST
                  data: {newpos : data},
                  success: function() 
                  {                         
                       console.log('posicoes atualizadas');
                  }
         });  
         resetIndexes();     
    }
    

    $(function() {
       RowSorter('table[id=tabela]', {
          handler: 'td.sorter',
          stickFirstRow : true,
          stickLastRow  : false,
          onDragStart: function(tbody, row, index)
          {
              console.log('índice inicial é ' + index);            
          },
          onDrop: function(tbody, row, new_index, old_index)
          {
              console.log('deslocado de ' + old_index + ' para ' + new_index);
              atualizaBanco();
          }
 });
       
       /** Só vai tentar ordenar a tabela se tiver mais de 2 'tr'. Pq um tr padrão é do thead e outro é do tbody **/
       if($('#tabela').find('tr').length > 2) 
       $("#tabela").tablesorter({
        sortList: [[0,0]], //ordena a tabela pelo "board"
        debug: false, //true para ligar o modo debug 
        cssHeader: '',
        headers: {  //desabilita a reordenação pelos Headers
            1: { 
                sorter: false 
            }, 
            2: { 
                sorter: false 
            },
            3: { 
                sorter: false 
            },
            4: { 
                sorter: false 
            }, 
            5: { 
                sorter: false 
            }
        },
        widthFixed: false
       });
               
        $('.ordenacao').unbind('click');
});
    
    </script>
@endpush
