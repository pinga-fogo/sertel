<select class='select_opts'> 
					 			
</select>

@push('scripts')
<script>

$.ajax({
"url": "{{ route('datatables.ramais') }}",
"type":"GET",
"success": function(ramais){
   console.log(ramais);
   if(ramais.data.length > 1){
        count = 0;

        ramais.data.map( function(el){ 
        
        //se for URA pendura no campo dos dígitos e no nome, 
        if(el.aplicacao == '113'){
             
             count++;
             option = '<option class="c_ura" value='+el.id+'>'+el.nome+'</option>';
             $(".select_opts").append($(option));
        
        }

        });

        if(count < 1)
            erroVazio();
   
   }  else {
      erroVazio();
   }

}
});
</script>

@endpush
