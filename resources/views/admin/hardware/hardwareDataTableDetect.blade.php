<!-- Page Heading -->

    <div class="col-lg-12">
        <div class="table-responsive">
            <div class="panel-body">         
             <table id="tabela" class="table tgHardware troll-border sorting_1">          
                 <thead>
                    <th class="harder dtcenter">Serial </th>
                    <th class="harder dtcenter">Tipo </th> 
                    <th class="harder dtcenter">IP</th>
                    <th class="harder dtcenter">Perfil</th> 
                    <th class="harder dtcenter">Ações </th>
                  </thead>
                  <tbody>
                @foreach ($final as $final)               
                  <tr>                                 
                    <td class="">{{ $final['serial'] }}</td>
                    <td class="">{{ $final['tipo']}} - {{ $final['portas'] }}</td>
                    <td class="">
                        <form action="{{ route('admin.hardware.write') }}" method="get">
                                 
                                 <input type='text' name="serial"   class='hidden' value="{{$final['serial']}}">
                                 <input type='text' name="tipo"     class='hidden' value="{{$final['tipo']}}">
                                 <input type='text' name="hardware" class='hidden' value="{{$final['hardware']}}">
                                 <input type='text' name="portas"   class='hidden' value="{{$final['portas']}}">
                            
                                 <!-- <input type='text' id='stringbuffer' name='stringbuffer' class='hidden' value=""/> -->
                                 <input type="text" id="ip" placeholder="Digite um IP !" name="ip" class='ip' required/>
                    </td>

                    <td class="">
                    @if($final['tipo'] != 'E1')
                        <select id='perfil' name='perfil' class="" > 
                            <option class="" value="{{$final['tipo']}}"> {{$final['tipo']}} </option>
                        </select>
                    @endif
                    @if($final['tipo'] == 'E1')                 
                                <div class="">
                                    @if( $final['portas'] >= 30 )
                                        <label class="">Link 0 </label>
                                            <select id="'perfisLinks0'" name="perfisLinks[]" class="">
                                                 <option value="Deactivated" selected> Desativado </option>                                  
                                                 <option value="R2"          > R2 </option> 
                                                 <option value="R2Passive"   > R2Passive </option> 
                                                 <option value="ISDN"        > ISDN </option> 
                                                 <option value="ISDNNetwork" > ISDNNetwork </option> 
                                                 <option value="ISDNPassive" > ISDNPassive </option>     
                                            </select>
                                            <br>
                                    @endif
                                    @if( $final['portas'] >= 60 )
                                         <label class="">Link 1 </p>
                                         <select id='perfisLinks1' name="perfisLinks[]" class="">
                                                 <option value="Deactivated" selected> Desativado </option>                                  
                                                 <option value="R2"          > R2 </option> 
                                                 <option value="R2Passive"   > R2Passive </option> 
                                                 <option value="ISDN"        > ISDN </option> 
                                                 <option value="ISDNNetwork" > ISDNNetwork </option> 
                                                 <option value="ISDNPassive" > ISDNPassive </option>    
                                         </select>
                                         <br>
                                    @endif
                                    @if( $final['portas'] >= 90 )
                                         <label class="{{ $final['portas'] >= 90 ? '' : 'hidden' }}">Link 2 </p>
                                         <select id='perfisLinks2' name="perfisLinks[]" class="{{$final['portas'] >= 90 ? '' : 'hidden'}}">
                                                 <option value="Deactivated" selected> Desativado </option>                                  
                                                 <option value="R2"          > R2 </option> 
                                                 <option value="R2Passive"   > R2Passive </option> 
                                                 <option value="ISDN"        > ISDN </option> 
                                                 <option value="ISDNNetwork" > ISDNNetwork </option> 
                                                 <option value="ISDNPassive" > ISDNPassive </option>    
                                         </select>
                                         <br>
                                    @endif     
                                    @if( $final['portas'] >= 120 )
                                         <label class="{{ $final['portas'] >= 120 ? '' : 'hidden' }}">Link 3 </p>
                                         <select id='perfisLinks3' name="perfisLinks[]" class="{{$final['portas'] == 120 ? '' : 'hidden'}}">
                                                 <option value="Deactivated" selected> Desativado </option>                                  
                                                 <option value="R2"          > R2 </option> 
                                                 <option value="R2Passive"   > R2Passive </option> 
                                                 <option value="ISDN"        > ISDN </option> 
                                                 <option value="ISDNNetwork" > ISDNNetwork </option> 
                                                 <option value="ISDNPassive" > ISDNPassive </option>    
                                         </select>
                                    @endif
                                </div>          
                        </td>
                    @endif             
                    <td class=""><input type="submit" value="Adicionar" onClick=""></form></td>
                  </tr>
    
                
                @endforeach
                                  <tbody>

                   </table>

                  <br>
                  <br>
           
        </div>
        </div>
    </div>
</div>

