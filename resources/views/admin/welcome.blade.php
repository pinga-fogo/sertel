@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
            <small>{{$user_name}}, seja bem vindo !</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>  Dashboard
            </li>
           <!-- <div style='float:right'> <label for='autoRefresh'> Atualizar Automaticamente <input type='checkbox' id='autoRefresh' value='1'/> </label></div> -->
        </ol>
    </div>
</div>

<div id='sysinfo'>

</div>
<div class='row'>
        <div class='col-md-4' >        
           <center><h4 style='color:gray'>Discos</h4></center>
            <div id="disco" class="200x160px"></div>
        </div>
        <div class='col-md-4'>
            <div id="memoria"  style='vertical-align: middle' class="200x160px"></div>
        </div>
        <div class='col-md-4'>
           <center><h4 style='color:gray'>Processador</h4>
                    <div id="cpu" class="col-md-6" style="margin-left:90px"></div>
            </center>
        </div>
</div>
<!-- /.row -->
@endsection
@push('scripts')
<script type="text/javascript" src='/assets/js/justgage-1.2.2/justgage.js'></script>
<script type="text/javascript" src='/assets/js/justgage-1.2.2/raphael-2.1.4.min.js'></script>

<script type="text/javascript">
function refresh(memory_gage, cpu_temp_gage, disk_gage, core_usage){
         window.setInterval(function(){ 
              console.log('atualizando...');
                $.ajax({
                      url:'/phpsysinfo/xml.php?plugin=complete&json',
                      type:'get',
                      success: function(sysinfo){  
                       sysinfo = JSON.parse(sysinfo);

                       cpu_temp_gage.refresh( sysinfo.Hardware.CPU.CpuCore[0] != undefined ? 
                                                sysinfo.Hardware.CPU.CpuCore[0]['@attributes'].CpuTemp :
                                                (sysinfo.Hardware.CPU.CpuCore['@attributes'].CpuTemp != undefined 
                                                     ? sysinfo.Hardware.CPU.CpuCore['@attributes'].CpuTemp : '0') );
                       
                       memory_gage.refresh(sysinfo.Memory['@attributes'].Percent);
                       
                       core_usage.refresh((sysinfo.Vitals['@attributes'].LoadAvg.split(' ')[0])*100)
                       
                       //for (i in disk_gage){
                           // disk_gage[i].refresh(sysinfo.FileSystem.Mount[i]['@attributes'].Percent );
                       //}
                      }
                });
         }, 3000);
}
                

 
    $.ajax({
          url:'/phpsysinfo/xml.php?plugin=complete&json',
          type:'get',
          success: function(sysinfo){            
            sysinfo = JSON.parse(sysinfo);
            console.log(sysinfo);
            
               // ** MEMÓRIA **
                var memory_gage = new JustGage({
                        id: "memoria",
                        value: sysinfo.Memory['@attributes'].Percent,
                        min: 0,
                        max: 100,
                        title: "Memória ("+((sysinfo.Memory['@attributes'].Total)/1024/1024/1024).toFixed(2)+" GB)",
                        symbol:'%',
                });
               
                 
               // ** DISCOS **
               var disk_gage = [];
                
                for (i in sysinfo.FileSystem.Mount){
                    disk = sysinfo.FileSystem.Mount[i]['@attributes'];
                    
                    $("#disco").append( "<div class='col-md-6' style='overflow:visible width:100px; height:80px' id="+disk.MountPointID+"> </div>" );

                    disk_gage[i] = new JustGage({
                    id: disk.MountPointID,
                    value: disk.Percent,
                    min: 0,
                    max: 100,
                    title: ""+disk.MountPoint+" ("+((disk.Total)/1024/1024/1024).toFixed(2)+" GB)",
                    symbol:'%',
                    });
                
                }
                
                // ** PROCESSADORES **
                    //Se tiver mais de um núcleo, pega o primeiro, se não, pega o único processador existente
                    
                    cpu = sysinfo.Hardware.CPU.CpuCore[0] != undefined ? 
                                sysinfo.Hardware.CPU.CpuCore[0]['@attributes'] :
                                sysinfo.Hardware.CPU.CpuCore['@attributes'];


                    vitals = sysinfo.Vitals['@attributes'];

                    $("#cpu").append("<div class='col-md-8' style='overflow:visible width:100px; height:80px' id='core_temp'> </div>");

                    $("#cpu").append("<div class='col-md-8' style='overflow:visible width:100px; height:80px' id='core_usage'> </div>");
                   
                    var core_usage = new JustGage({
                    id: 'core_usage',
                    value: vitals.LoadAvg.split(' ')[0]*100 ,
                    min: 0,
                    max: 100,
                    title: "Média de uso",
                    symbol: '%',
                    'customSelectors': [{
                             color: "#009900",
                             lo : '0',
                             hi : '40'
                        }, 
                        {
                             color: "#ffcc00",
                             lo : '40',
                             hi : '61'
                        },
                        {
                             color: "#ff0000",
                             lo : '61',
                             hi : '100'
                        }
                        ]
                    });       
                    
                    var cpu_temp_gage = new JustGage({
                    id: 'core_temp',
                    value: (cpu.CpuTemp != undefined ? cpu.CpuTemp : 0),
                    min: 0,
                    max: 100,
                    title: 'Temperatura',
                    symbol: '°',
                    'customSelectors': [{
                         color: "#009900",
                         lo : '0',
                         hi : '40'
                    }, 
                    {
                         color: "#ffcc00",
                         lo : '40',
                         hi : '61'
                    },
                    {
                         color: " #ff0000",
                         lo : '61',
                         hi : '100'
                    }
                    ]
                });         
             
             refresh(memory_gage, cpu_temp_gage, disk_gage, core_usage);
    } 

    });

</script>
 
@endpush
