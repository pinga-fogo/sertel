@extends('admin.base')
@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Listar Hardwares
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.hardware.list')}}"> Hardwares </a>
            </li>
            <li class="active">
                <i class="fa fa-plus-circle"></i> Editar Hardware
            </li>
        </ol>
      
    </div>
    <div class=''>
           <table id="tabela" class="table tgHardware"> 
                  <tr>
                    <th class="harder dtcenter">Serial </th>
                    <th class="harder dtcenter">Tipo </th> 
                    <th class="harder dtcenter">IP</th>
                    <th class="harder dtcenter">{{$final['tipo'] == 'E1' ? 'Perfis' : 'Perfil'}}</th> 
                    <th class="harder dtcenter">Ações </th>
                  </tr>
            <td> {{$final['serial']}} </td>
            <td> {{$final['tipo']}} </td>
            <!-- <form action="{{ $final['tipo']=='E1' ? route('admin.hardware.update') : route('admin.hardware.addip')}}" method="get"> -->
            <td> 
                <form action="{{route('admin.hardware.update')}}" method="post">
                    <input type='text' id="ip"  name="ip" value="{{$final['ip']}}"/>
                    <input type='text' class='hidden' name='serial_buffer' value="{{ isset($final['serial']) ? $final['serial'] : '' }}"> 
                    {{ csrf_field() }}

            </td>

            <td>  
            @if( $final['tipo'] != 'E1')     
                <select id='perfil' name='perfil' class="" > 
                        <option class="" value="{{$final['tipo']}}"> {{$final['tipo']}} </option>
                </select>
            @endif

            @if( $final['tipo']=='E1' )
                  <div class="">         
                         @if( isset($final['portas'] ) && $final['portas'] >= 30)
                            <label class="">Link 0 </label>
                            <select id='perfisLinks' name="perfisLinks[]" class="">
                                     <option value="Deactivated" {{$final['perfil'][0] == "Deactivated" ? "selected" : "" }}> Desativado </option>                                  
                                     <option value="R2"          {{$final['perfil'][0] == "R2"          ? "selected" : "" }}> R2 </option> 
                                     <option value="R2Passive"   {{$final['perfil'][0] == "R2Passive"   ? "selected" : "" }}> R2Passive </option> 
                                     <option value="ISDN"        {{$final['perfil'][0] == "ISDN"        ? "selected" : "" }}> ISDN </option> 
                                     <option value="ISDNNetwork" {{$final['perfil'][0] == "ISDNNetwork" ? "selected" : "" }}> ISDNNetwork </option> 
                                     <option value="ISDNPassive" {{$final['perfil'][0] == "ISDNPassive" ? "selected" : "" }}> ISDNPassive </option>                                       
                            </select><br>
                         @endif
                         
                         @if( isset($final['portas']) && $final['portas'] >= 60) 
                             <label class="">Link 1 </label>
                             <select id='perfisLinks' name="perfisLinks[]" class="">
                                     <option value="Deactivated" {{$final['perfil'][1] == "Deactivated" ? "selected" : "" }}> Desativado </option>                                  
                                     <option value="R2"          {{$final['perfil'][1] == "R2"          ? "selected" : "" }}> R2 </option> 
                                     <option value="R2Passive"   {{$final['perfil'][1] == "R2Passive"   ? "selected" : "" }}> R2Passive </option> 
                                     <option value="ISDN"        {{$final['perfil'][1] == "ISDN"        ? "selected" : "" }}> ISDN </option> 
                                     <option value="ISDNNetwork" {{$final['perfil'][1] == "ISDNNetwork" ? "selected" : "" }}> ISDNNetwork </option> 
                                     <option value="ISDNPassive" {{$final['perfil'][1] == "ISDNPassive" ? "selected" : "" }}> ISDNPassive </option>    
                             </select><br>
                         @endif

                         @if( isset($final['portas']) && $final['portas'] >= 90)
                             <label class="{{ isset($final['portas']) && $final['portas'] >= 90 ? '' : 'hidden' }}">Link 2 </label>
                             <select id='perfisLinks2' name="perfisLinks[]" class="">
                                     <option value="Deactivated" {{$final['perfil'][2] == "Deactivated" ? "selected" : "" }}> Desativado </option>                                  
                                     <option value="R2"          {{$final['perfil'][2] == "R2"          ? "selected" : "" }}> R2 </option> 
                                     <option value="R2Passive"   {{$final['perfil'][2] == "R2Passive"   ? "selected" : "" }}> R2Passive </option> 
                                     <option value="ISDN"        {{$final['perfil'][2] == "ISDN"        ? "selected" : "" }}> ISDN </option> 
                                     <option value="ISDNNetwork" {{$final['perfil'][2] == "ISDNNetwork" ? "selected" : "" }}> ISDNNetwork </option> 
                                     <option value="ISDNPassive" {{$final['perfil'][2] == "ISDNPassive" ? "selected" : "" }}> ISDNPassive </option>                                             
                             </select><br>
                         @endif

                         @if( isset($final['portas']) && $final['portas'] >= 120)
                            <label class="{{ isset($final['portas']) && $final['portas'] >= 120 ? '' : 'hidden' }}">Link 3 </label>
                            <select id='perfisLinks3' name="perfisLinks[]" class="">
                                     <option value="Deactivated" {{$final['perfil'][3] == "Deactivated" ? "selected" : "" }}> Desativado </option>                                  
                                     <option value="R2"          {{$final['perfil'][3] == "R2"          ? "selected" : "" }}> R2 </option> 
                                     <option value="R2Passive"   {{$final['perfil'][3] == "R2Passive"   ? "selected" : "" }}> R2Passive </option> 
                                     <option value="ISDN"        {{$final['perfil'][3] == "ISDN"        ? "selected" : "" }}> ISDN </option> 
                                     <option value="ISDNNetwork" {{$final['perfil'][3] == "ISDNNetwork" ? "selected" : "" }}> ISDNNetwork </option> 
                                     <option value="ISDNPassive" {{$final['perfil'][3] == "ISDNPassive" ? "selected" : "" }}> ISDNPassive </option>                                            
                            </select>
                         @endif

                                  
                 </div>
            @endif    
            </td> 
            <td> <!-- <input class="hidden" id="stringbuffer" name="stringbuffer" type="text" value="serial={{$final['serial']}},portas={{isset($final['portas']) ? $final['portas'] : ''}},tipo={{$final['tipo']}}"/> --> <input type='submit' value="Salvar" /></form></td>
           </table>   
     </div>
</div>
  
@endsection
