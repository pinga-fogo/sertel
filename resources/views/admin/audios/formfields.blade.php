<center>
  <div class="form-groups">
          
          {!! Form::open(array('url'=>'/dashboard/audios/upload','method'=>'POST', 'files'=>true, 'id'=>'formAudio')) !!}
          
          {!! Form::label('nome_audio', 'Nome') !!} 

          {!! Form::text('nome_audio', '',array('class'=>'form-control', 'max-length'=>'20')) !!}
          
          <br>
          <br>
          
          {!! Form::label('audio', 'Arquivo') !!} 
          {!! Form::file('audio', array('class'=>'file')) !!}
            
  </div>
</center>
        