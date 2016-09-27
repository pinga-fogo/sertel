<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'dashboard','middleware'=> ['web'] ], function(){

    Route::get('/', ['uses'=>'DashboardController@index','as'=>'admin.dashboard.index']);
    
    Route::get('/error/503', ['uses'=>'SiteController@send503','as'=>'site.send503']);
    Route::get('/error/notfound', ['uses'=>'SiteController@sendNotFound','as'=>'site.notfound']);

   
    Route::get('/accounts', ['uses'=>'AccountsController@index','as'=>'admin.accounts.index']);
    Route::get('/accounts/create', ['uses'=>'AccountsController@create','as'=>'admin.accounts.create']);
    Route::post('/accounts/store', ['uses'=>'AccountsController@store','as'=>'admin.accounts.store']);
    Route::get('/accounts/edit/{id?}', ['uses'=>'AccountsController@edit','as'=>'admin.accounts.edit']);
    Route::put('/accounts/update', ['uses'=>'AccountsController@update','as'=>'admin.accounts.update']);
    Route::get('/accounts/destroy', ['uses'=>'AccountsController@destroy','as'=>'admin.accounts.destroy']);
  
    /* datatables */
    Route::controller('datatables', 'DatatablesController', [
        'anyData'  => 'datatables.data',
        'getIndex' => 'datatables',
    ]);

    Route::get('/users/data', ['uses'=>'DatatablesController@dataUsers','as'=>'datatables.users']);
    Route::get('/groups/data', ['uses'=>'DatatablesController@dataGroups','as'=>'datatables.groups']);
    Route::get('/ramais/data', ['uses'=>'DatatablesController@dataRamais','as'=>'datatables.ramais']);
    Route::get('/ramais/profiles/data', ['uses'=>'DatatablesController@dataProfilesRamais','as'=>'datatables.profiles_ramais']);
    Route::get('/ramais/settings/data', ['uses'=>'DatatablesController@dataRamaisSettings','as'=>'datatables.ramais.settings']);
    Route::get('/troncos/data', ['uses'=>'DatatablesController@dataTroncos','as'=>'datatables.troncos']);
    Route::get('/juntor/data', ['uses'=>'DatatablesController@dataJuntor','as'=>'datatables.juntor']);
    Route::get('/juntor/dataMin', ['uses'=>'DatatablesController@dataJuntorMin','as'=>'datatables.juntorMin']);
    Route::get('/juntor/getJuntor', ['uses'=>'DatatablesController@getJuntor','as'=>'datatables.getJuntor']);
    Route::get('/hardware/data', ['uses'=>'DatatablesController@dataHardwares','as'=>'datatables.hardwares']);
    Route::get('/blacklist/data', ['uses'=>'DatatablesController@dataBlackList','as'=>'datatables.BlackList']);
    Route::get('/whitelist/data', ['uses'=>'DatatablesController@dataWhiteList','as'=>'datatables.WhiteList']);
    Route::get('/codigos/data', ['uses'=>'DatatablesController@dataCodigos','as'=>'datatables.Codigos']);
    Route::get('/custos/data', ['uses'=>'DatatablesController@dataCustos','as'=>'datatables.Custos']);
    Route::get('/grupos/data', ['uses'=>'DatatablesController@dataGrupos','as'=>'datatables.Grupos']);
    Route::get('/voice_mail/data', ['uses'=>'DatatablesController@dataVoiceMail','as'=>'datatables.voice_mail']);
    Route::get('/ligacoes/data', ['uses'=>'DatatablesController@dataCdr','as'=>'datatables.cdr']);
    Route::get('/centrais/data', ['uses'=>'DatatablesController@dataCentrais','as'=>'datatables.centrais']);
    Route::get('/audios/data', ['uses'=>'DatatablesController@dataAudios','as'=>'datatables.audios']);
    Route::get('/uras/data', ['uses'=>'DatatablesController@dataUras','as'=>'datatables.uras']);
    Route::get('/saudacoes/data', ['uses'=>'DatatablesController@dataSaudacoes','as'=>'datatables.saudacoes']);

    Route::get('/phpsysinfo', ['uses'=>'sysInfo@getInfo','as'=>'json.sysinfo']);
    
    Route::get('/grupos', ['uses'=>'GruposController@index','as'=>'admin.grupos.index']);
    Route::get('/grupos/create', ['uses'=>'GruposController@create','as'=>'admin.grupos.create']);
    Route::post('/grupos/store', ['uses'=>'GruposController@store','as'=>'admin.grupos.store']);
    Route::get('/grupos/edit/{id?}', ['uses'=>'GruposController@edit','as'=>'admin.grupos.edit']);
    // Route::get('/groups/update', ['uses'=>'GroupsController@update','as'=>'admin.groups.update']);
    Route::post('/grupos/update/{id?}', ['uses'=>'GruposController@update','as'=>'admin.grupos.update']);
    Route::get('/grupos/destroy', ['uses'=>'GruposController@destroy','as'=>'admin.grupos.destroy']);

    Route::get('/ramais',        ['uses'=>'RamalController@index','as'=>'admin.ramais.index']);
    Route::get('/ramais/create', ['uses'=>'RamalController@create','as'=>'admin.ramais.create']);
    Route::get('/ramais/store',  ['uses'=>'RamalController@store','as'=>'admin.ramais.store']);
    Route::get('/ramais/edit/{id?}', ['uses'=>'RamalController@edit','as'=>'admin.ramais.edit']);
    Route::get('/ramais/update/{id?}', ['uses'=>'RamalController@update','as'=>'admin.ramais.update']);
    Route::get('/ramais/destroy/',['uses'=>'RamalController@destroy','as'=>'admin.ramais.destroy']);
    Route::get('/ramais/atualiza/',['uses'=>'RamalController@atualizaArquivo','as'=>'admin.ramais.att']);
    
    Route::get('/uras',        ['uses'=>'UraController@index','as'=>'admin.uras.index']);
    Route::post('/uras/store',  ['uses'=>'UraController@store','as'=>'admin.uras.store']);
    Route::get('/uras/edit/{id?}', ['uses'=>'UraController@edit','as'=>'admin.uras.edit']);
    Route::post('/uras/update/{id?}', ['uses'=>'UraController@update','as'=>'admin.uras.update']);
    Route::get('/uras/destroy/',['uses'=>'UraController@destroy','as'=>'admin.uras.destroy']);

    Route::post('/saudacoes/update/{id?}', ['uses'=>'saudacoesController@update','as'=>'admin.saudacoes.update']);

    Route::get('/teste',['uses'=>'HardwareController@teste']);
    
    Route::get('/ramais/profiles/destroy', ['uses'=>'ProfileRamalController@destroy','as'=>'admin.profiles_ramais.destroy']);
    Route::get('/ramais/profiles', ['uses'=>'ProfileRamalController@index','as'=>'admin.ramais.profiles.index']);
    Route::get('/ramais/profiles/store', ['uses'=>'ProfileRamalController@store','as'=>'admin.profiles_ramais.store']);
    //Route::get('/ramais/profiles/create', ['uses'=>'ProfileRamalController@create','as'=>'admin.profiles_ramais.create']);
    //Route::get('/ramais/profiles/edit/{id?}', ['uses'=>'ProfileRamalController@edit','as'=>'admin.profiles_ramais.edit']);
    Route::get('/ramais/profiles/update/{id?}', ['uses'=>'ProfileRamalController@update','as'=>'admin.profiles_ramais.update']);
    Route::get('/ramais/profiles/setDefault', ['uses'=>'ProfileRamalController@setDefault','as'=>'admin.profiles_ramais.set_default']);



    Route::get('/ramais/settings', ['uses'=>'RamalSettingController@index','as'=>'admin.ramais.settings.index']);
    Route::get('/ramais/settings/create', ['uses'=>'RamalSettingController@create','as'=>'admin.ramais.settings.create']);
    Route::post('/ramais/settings/store', ['uses'=>'RamalSettingController@store','as'=>'admin.ramais.settings.store']);
    Route::get('/ramais/settings/edit/{id?}', ['uses'=>'RamalSettingController@edit','as'=>'admin.ramais.settings.edit']);
    Route::put('/ramais/settings/update', ['uses'=>'RamalSettingController@update','as'=>'admin.ramais.settings.update']);
    Route::get('/ramais/settings/destroy', ['uses'=>'RamalSettingController@destroy','as'=>'admin.ramais.settings.destroy']);
    Route::get('/ramais/settings/subtypes', ['uses'=>'RamalSettingController@getSubtypes','as'=>'admin.ramais.settings.subtypes']);
    //    Route::get('/ramais/setup', ['uses'=>'RamalSettingController@index','as'=>'admin.ramais_setup.index']);
    //    Route::get('/ramais/setup/create', ['uses'=>'RamalSettingController@create','as'=>'admin.setup_ramais.create']);
    //    Route::get('/ramais/setup/list', ['uses'=>'RamalSettingController@getList','as'=>'admin.setup_ramais.get_list']);

    /*Route::get('/profiles', ['uses'=>'ProfilesController@index','as'=>'admin.profiles.index']);
    Route::get('/profiles/create', ['uses'=>'ProfilesController@create','as'=>'admin.profiles.create']);
    Route::post('/profiles/store', ['uses'=>'ProfilesController@store','as'=>'admin.profiles.store']);
    Route::get('/profiles/update', ['uses'=>'ProfilesController@update','as'=>'admin.profiles.update']);
    Route::post('/profiles/update', ['uses'=>'ProfilesController@update','as'=>'admin.profiles.update']);
    */
    Route::get('/testing', ['uses'=> 'testing@calcTarifaFixo', 'as'=>'admin.calcTarifa']); 

    Route::get('/troncos', ['uses'=> 'TroncosController@index', 'as'=>'admin.troncos.index']); 
    Route::get('/troncos/create', ['uses'=> 'TroncosController@create', 'as'=>'admin.troncos.create']); 
    Route::get('/troncos/edit/{id?}', ['uses'=> 'TroncosController@edit', 'as'=>'admin.troncos.edit']); 
    Route::get('/troncos/store', ['uses'=> 'TroncosController@store', 'as'=>'admin.troncos.store']); 
    Route::get('/troncos/update/{id?}', ['uses'=> 'TroncosController@update', 'as'=>'admin.troncos.update']); 
    Route::get('/troncos/destroy', ['uses'=> 'TroncosController@destroy', 'as'=>'admin.troncos.destroy']); 
    Route::get('/troncos/getCadencias/{id?}', ['uses'=> 'TroncosController@getCadencias', 'as'=>'admin.troncos.getCadencias']);
    Route::get('/troncos/delCadencias/{id?}', ['uses'=> 'TroncosController@delCadencias', 'as'=>'admin.troncos.delCadencias']); 

         

    Route::post('/cadencias/create', ['uses'=> 'TroncosController@newCad', 'as'=>'admin.troncos.newCad']);


    Route::get('/troncos/filetest', ['uses'=> 'FilesController@write', 'as'=>'admin.troncos.write']); 

    Route::post('/hardware/detect', ['uses'=> 'HardwareController@detectkhomp', 'as'=>'admin.hardware.detectkhomp']);
    Route::post('/hardware/update', ['uses'=> 'HardwareController@update', 'as'=>'admin.hardware.update']);
    Route::any('/hardware/detectdgv', ['uses'=> 'HardwareController@detectdgv', 'as'=>'admin.hardware.detectdgv']);
    Route::any( '/hardware/detectdahdi', ['uses'=> 'HardwareController@configdahdi', 'as'=>'admin.hardware.detectdahdi']);
    Route::post('/hardware/savedgv', ['uses'=> 'HardwareController@savedgv', 'as'=>'admin.hardware.savedgv']);
    Route::post('/hardware/savedahdi', ['uses'=> 'HardwareController@savedahdi', 'as'=>'admin.hardware.savedahdi']);
    Route::get('/hardware/index', ['uses'=> 'HardwareController@firstListHardwares', 'as'=>'admin.hardware.index']);
    Route::get('/hardware/destroy', ['uses'=> 'HardwareController@destroy', 'as'=>'admin.hardware.destroy']);
    Route::get('/hardware/addip/{id?}', ['uses'=> 'HardwareController@addip', 'as'=>'admin.hardware.addip']);
    Route::get('/hardware/create', ['uses'=> 'HardwareController@write', 'as'=>'admin.hardware.write']);
    Route::get('/hardware/edit/{id?}', ['uses'=> 'HardwareController@edit', 'as'=>'admin.hardware.edit']);
    Route::get('/hardware/list', ['uses'=> 'HardwareController@listar', 'as'=>'admin.hardware.list']);
    Route::get('/hardware/setLink', ['uses'=> 'HardwareController@setLink', 'as'=>'admin.hardware.setLink']);
    Route::get('/hardware/editx/{id?}', ['uses'=> 'HardwareController@editSPX', 'as'=>'admin.hardware.editSPX']);
    Route::get('/hardware/updatePosicoes', ['uses'=> 'HardwareController@updatePosicoes', 'as'=>'admin.hardware.updatePosicoes']);

    //Route::get('/hardware/create', ['uses'=> 'HardwareController@create', 'as'=>'admin.hardware.create']);
    //Route::get('/hardware/edit/{id?}', ['uses'=> 'HardwareController@edit', 'as'=>'admin.hardware.edit']); 
    
    
    Route::get('/juntor/create', ['uses'=> 'JuntorController@create', 'as'=>'admin.juntor.create']);
    Route::get('/juntor/list', ['uses'=> 'JuntorController@listar', 'as'=>'admin.juntor.listar']);
    Route::post('/juntor/store', ['uses'=> 'JuntorController@store', 'as'=>'admin.juntor.store']);
    Route::get('/juntor/edit/{id?}/{fab?}', ['uses'=> 'JuntorController@edit', 'as'=>'admin.juntor.edit']);
    Route::get('/juntor/destroykhomp/{nome?}/{fab?}', ['uses'=> 'JuntorController@destroy', 'as'=>'admin.juntor.destroy']);
    Route::get('/juntor/juntorEditProv', ['uses'=> 'JuntorController@editProv', 'as'=>'admin.juntor.editProv']);
    Route::put('/juntor/update', ['uses'=> 'JuntorController@update', 'as'=>'admin.juntor.update']);


     Route::get('/prefixos/index/{tab?}', ['uses'=> 'PrefixosController@index', 'as'=>'admin.prefixos.index']);
     Route::get('/prefixos/save/{tipo?}', ['uses'=> 'PrefixosController@save', 'as'=>'admin.prefixos.save']);
     Route::get('/prefixos/adicionarTronco/{tipo?}/{id?}', ['uses'=> 'PrefixosController@adicionarTronco', 'as'=>'admin.prefixos.adicionarTronco']);
     Route::get('/prefixos/removerTronco/{tipo?}/{id?}', ['uses'=> 'PrefixosController@removerTronco', 'as'=>'admin.prefixos.removerTronco']);
     
     Route::post('/blacklist/setNum', ['uses'=> 'BlackListController@setNum', 'as'=>'admin.black_list.setNum']);
     Route::get('/blacklist', ['uses'=> 'BlackListController@index', 'as'=>'admin.black_list.index']);
     Route::post('/blacklist/update/{id?}', ['uses'=> 'BlackListController@update', 'as'=>'admin.black_list.update']);
     Route::get('/blacklist/destroy/{id?}', ['uses'=> 'BlackListController@destroy', 'as'=>'admin.black_list.destroy']);
     

     Route::post('/whitelist/setNum', ['uses'=> 'WhiteListController@setNum', 'as'=>'admin.white_list.setNum']);
     Route::get('/whitelist', ['uses'=> 'WhiteListController@index', 'as'=>'admin.white_list.index']);
     Route::post('/whitelist/update/{id?}', ['uses'=> 'WhiteListController@update', 'as'=>'admin.white_list.update']);
     Route::get('/whitelist/destroy/{id?}', ['uses'=> 'WhiteListController@destroy', 'as'=>'admin.white_list.destroy']);

     Route::get('/tarifas', ['uses'=> 'tarifasController@index', 'as'=>'admin.tarifas.index']);
     Route::post('/tarifas/save', ['uses'=> 'tarifasController@save', 'as'=>'admin.tarifas.save']);
     

     Route::get('/codigos', ['uses'=> 'codigoController@index', 'as'=>'admin.codigos.index']);
     Route::post('/codigos/store', ['uses'=> 'codigoController@store', 'as'=>'admin.codigos.store']);
     Route::get('/codigos/destroy/{id?}', ['uses'=> 'codigoController@destroy', 'as'=>'admin.codigos.destroy']);
     Route::post('/codigos/edit/{id?}', ['uses'=> 'codigoController@update', 'as'=>'admin.codigos.edit']);


     Route::get('/custos', ['uses'=> 'custosController@index', 'as'=>'admin.custos.index']);
     Route::post('/custos/store', ['uses'=> 'custosController@store', 'as'=>'admin.custos.store']);
     Route::get('/custos/destroy/{id?}', ['uses'=> 'custosController@destroy', 'as'=>'admin.custos.destroy']);
     Route::post('/custos/edit/{id?}', ['uses'=> 'custosController@update', 'as'=>'admin.custos.edit']);

    
     Route::get('/voice_mail', ['uses'=> 'voiceMailController@index', 'as'=>'admin.voice_mail.index']);
     Route::get('/voice_mail/store', ['uses'=> 'voiceMailController@store', 'as'=>'admin.voice_mail.store']);
     Route::get('/voice_mail/destroy/{id?}', ['uses'=> 'voiceMailController@destroy', 'as'=>'admin.voice_mail.destroy']);
     Route::get('/voice_mail/update/{id?}', ['uses'=> 'voiceMailController@update', 'as'=>'admin.voice_mail.update']);


     Route::get('/relatorio', ['uses'=> 'relatorioController@index', 'as'=>'admin.relatorio.index']);

     Route::get('/centrais', ['uses'=>'centraisController@index','as'=>'admin.centrais.index']);
     Route::post('/centrais/store', ['uses'=>'centraisController@store','as'=>'admin.centrais.store']);
     Route::get('/centrais/destroy/{id?}', ['uses'=>'centraisController@destroy','as'=>'admin.centrais.destroy']);
     Route::post('/centrais/update/{id?}', ['uses'=>'centraisController@update','as'=>'admin.centrais.update']);


     Route::get('/audios', ['uses'=>'audiosController@index','as'=>'admin.audios.index']);
     Route::post('/audios/upload', ['uses'=>'audiosController@upload','as'=>'admin.audios.upload']);
     Route::get('/audios/destroy', ['uses'=>'audiosController@destroy','as'=>'admin.audios.destroy']);

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function(){
        return redirect()->route('admin.dashboard.index');
    });
});


