 <!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset='utf-8'>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>Sertel Tecnologia</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  
    <!-- MetroUI Css -->
    <link href="/assets/css/metro.css" rel="stylesheet">

    <!-- Plugins -->
    <link href="/assets/plugins/bootstrap-switch-master/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/assets/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!--<link href="/assets/js/jquery-ui.min.css" rel="stylesheet">-->
    <link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/plugins/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/plugins/nestable/nestable.css">

    <!-- Custom CSS -->
    <link href="/assets/css/sb-admin.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css" rel="stylesheet">

    <link href="/assets/css/metro-icons.css" rel="stylesheet">
    <link href="/assets/css/editor.css" type="text/css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
 <style>
  table.sorting-table {cursor: move;}
  table tr.sorting-row td {background-color: #8b8;}
  table td.sorter {background-color: #6ca99d; width: 10px; cursor: move;}
  </style>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top logocentro" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- http://i67.tinypic.com/160wqi8.png -->
                <a href="{{route('admin.dashboard.index')}}"><img src="http://i67.tinypic.com/160wqi8.png" border="0" alt="" class='logo logoesquerda'></a>
            
            </div>
            @include('admin.topmenu')
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens  -->
            <div class="collapse navbar-collapse  navbar-ex1-collapse ">
                <ul class="nav navbar-nav side-nav sidebar2">
                   

                <li>
                   <a href="javascript:;" data-toggle="collapse" data-target="#menu-status" id='linkCadastro'>
                   <i class="fa fa-sitemap"></i> Status <i class="fa fa-fw fa-caret-down"></i></a> 
                     <ul id=''>
                           <li>
                              <a href="{{route('admin.ramais.profiles.index')}}"><i class="glyphicon glyphicon-cog"></i> Opção 1</a>
                            </li>
                            <li>
                                <a href="{{route('admin.ramais.profiles.index')}}"><i class="glyphicon glyphicon-cog"></i> Opção 2</a>
                            </li>
                            <li>
                                <a href="{{route('admin.ramais.profiles.index')}}"><i class="glyphicon glyphicon-cog"></i> Opção 3</a>
                            </li>
                            <li>
                                <a href="{{route('admin.ramais.profiles.index')}}"><i class="glyphicon glyphicon-cog"></i> Opção 4</a>
                            </li>
                     </ul>
                </li>
                 <li>
                      <a href="javascript:;" data-toggle="collapse" data-target="#menu-cadastro" id='linkCadastro'><i class="fa fa-sitemap"></i> Gerenciar <i class="fa fa-fw fa-caret-down"></i></a> 
                        <ul id="" class="collapse"> 
                        
                            <li>
                                <a href="{{route('admin.ramais.index')}}"><i class="glyphicon glyphicon-cog"></i> Ramais</a>
                            </li> 
                            <li>
                                <a href="{{ route('admin.troncos.index') }}"><i class="glyphicon glyphicon-cog"></i> Troncos</a>
                            </li>
                             <li>
                                <a href="{{route('admin.prefixos.index')}}"><i class="glyphicon glyphicon-cog"></i> Prefixos</a>
                            </li>
                            <li>
                                <a href="{{route('admin.audios.index')}}"><i class="glyphicon glyphicon-cog"></i> Áudios</a>
                            </li>
                        </ul> 
               </li>            
                <li>
                   <a href="javascript:;" data-toggle="collapse" data-target="#menu-relatorio" id='linkCadastro'><i class="fa fa-sitemap"></i> Relatório <i class="fa fa-fw fa-caret-down"></i></a> 
                     <ul>
                           <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 1</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 2</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 3</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 4</a>
                            </li>
                     </ul>
                </li>

                <li>
                   <a href="javascript:;" data-toggle="collapse" data-target="#menu-configurações" id='linkCadastro'><i class="fa fa-sitemap"></i> Configurações <i class="fa fa-fw fa-caret-down"></i></a> 
                     <ul>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Usuários</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 2</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 3</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i> Opção 4</a>
                            </li>
                     </ul>
                </li>

                <li>
                   <a href="javascript:;" data-toggle="collapse" data-target="#menu-ligações" id='linkCadastro'><i class="fa fa-sitemap"></i>Ligações <i class="fa fa-fw fa-caret-down"></i></a> 
                     <ul>
                           
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i>Gravações</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-cog"></i>Relatório</a>
                            </li>
                         
                     </ul>
                </li>

                </ul>
    
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                 @yield('content')


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/assets/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- PLugins -->
    <script src="/assets/plugins/bootstrap-switch-master/js/bootstrap-switch.min.js"></script>
    <script src="/assets/plugins/toastr/toastr.min.js"></script>
    <script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/nestable/jquery.nestable.js"></script>
    <script src="/assets/plugins/nestable/jquery.nestable.js"></script>
    <script src="/assets/js/global.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/RowSorter.js"></script>

    <!-- App scripts -->
    @stack('scripts')


    @if(Session::has('message_text'))
        <script>
            $(function(){
                toastr["{{ Session::get('message_type') }}"]("{{ Session::get('message_text') }}");
            });
        </script>
    @endif
   <script>
          $(function(){
            
            
          $('nav li ul').hide().removeClass('fallback');
             $('nav li').hover(
              function () {
                $('ul', this).stop().slideDown(100);
              },
              function () {
                $('ul', this).stop().slideUp(100);
              }
              );          
              
          });
   </script>
</body>
   

</html>

