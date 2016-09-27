<?php

// DEFAULT
//$app->get('/', 'App\Controller\CMSController:show');

$app->group('/api/accounts', function () {
    $this->get('/professionals', 'App\Api\ProfessionalAPI:getDoctors');
    $this->post('/signin', 'App\Api\AccountAPI:loginPassword');
    $this->post('/signup', 'App\Api\AccountAPI:signup');
    $this->get('/confirm', 'App\Api\AccountAPI:confirm');
    $this->group('/password', function () {
        $this->post('/forgot', 'App\Api\AccountAPI:forgotPassword');
        $this->post('/change', 'App\Api\AccountAPI:changeForgotPassword');
    });
    $this->group('/me', function () {
        $this->get('/', 'App\Api\AccountAPI:me');
        $this->post('/', 'App\Api\AccountAPI:changeMe');
        $this->post('/password', 'App\Api\AccountAPI:changeMePassword');
        $this->post('/cancel', 'App\Api\AccountAPI:cancelMe');
    });
})->add($apiErrorMiddleWare);

$app->get('/accounts/signout', 'App\Controller\AccountController:signout')->setName('accounts/signout')->add($accountErrorMiddleWare);
$app->get('/accounts/social/endpoint/', 'App\Controller\SocialController:endpoint')->setName('accounts/social/endpoint')->add($accountErrorMiddleWare);
$app->get('/accounts/social/connect/{social}', 'App\Controller\SocialController:connect')->setName('accounts/social/connect')->add($accountErrorMiddleWare);
$app->get('/accounts/social/disconnect/all', 'App\Controller\SocialController:disconnectAll')->setName('accounts/social/disconnect/all')->add($accountErrorMiddleWare);
$app->get('/accounts/social/disconnect/{social}', 'App\Controller\SocialController:disconnect')->setName('accounts/social/disconnect')->add($accountErrorMiddleWare);

$app->group('/accounts', function () {
    $this->get('/signup', 'App\Controller\AccountController:signupPage')->setName('accounts/signup');
    $this->post('/signup', 'App\Controller\AccountController:signup');
    $this->get('/signin', 'App\Controller\AccountController:signinPage')->setName('accounts/signin');
    $this->post('/signin', 'App\Controller\AccountController:signin');

    $this->get('/confirm', 'App\Controller\AccountController:confirm')->setName('accounts/confirm');
    $this->get('/reenable', 'App\Controller\AccountController:reenableAccountPage')->setName('accounts/reenable');
    $this->post('/reenable', 'App\Controller\AccountController:reenableAccount');

    $this->group('/password', function () {
        $this->get('/forgot', 'App\Controller\AccountController:forgotPasswordPage')->setName('accounts/password/forgot');
        $this->post('/forgot', 'App\Controller\AccountController:forgotPassword');
        $this->get('/change', 'App\Controller\AccountController:changePasswordPage')->setName('accounts/password/change');
        $this->post('/change', 'App\Controller\AccountController:changePassword');
    });


})->add($accountErrorMiddleWare)->add($userIsNotLoggedInMiddleWare);

    $app->get('/accounts/me', 'App\Controller\AccountController:mePage')->setName('accounts/me')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->get('/accounts/me/edit', 'App\Controller\AccountController:meEditPage')->setName('accounts/me/edit')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->post('/accounts/me', 'App\Controller\AccountController:meEdit')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->get('/accounts/me/password', 'App\Controller\AccountController:meChangePasswordPage')->setName('accounts/me/password')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->post('/accounts/me/password', 'App\Controller\AccountController:meChangePassword')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->get('/accounts/me/cancel', 'App\Controller\AccountController:meCancelPage')->setName('accounts/me/cancel')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->post('/accounts/me/cancel', 'App\Controller\AccountController:meCancel')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->get('/accounts/me/photo', 'App\Controller\AccountController:mePhotoPage')->setName('accounts/me/photo')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
    $app->post('/accounts/me/photo', 'App\Controller\AccountController:mePhoto')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);

$app->get('/admin', 'App\Controller\Admin\PatientsController:searchPage')->setName('dashboard')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/page/edit', 'App\Controller\Admin\CMSController:dispatch')->setName('edit')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);

  $app->post('/admin/photo', 'App\Controller\Admin\AccountController:savePhoto')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);

         $app->get('/admin/cms', 'App\Controller\Admin\CMSController:index')->setName('admin/cms')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
         $app->post('/admin/cms/file', 'App\Controller\Admin\CMSController:uploadFile')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
         $app->get('/admin/cms/{id}', 'App\Controller\Admin\CMSController:show')->setName('admin/cms/show')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
         $app->post('/admin/cms/{id}', 'App\Controller\Admin\CMSController:save')->setName('admin/cms/save')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);

$app->get('/admin/accounts/new', 'App\Controller\Admin\AccountController:newUser')->setName('new')->add($adminMiddleWare);
$app->post('/admin/accounts/new', 'App\Controller\Admin\AccountController:registerUser')->setName('newUser')->add($adminMiddleWare);
$app->get('/admin/accounts/', 'App\Controller\Admin\AccountController:indexPage')->setName('index')->add($adminMiddleWare);
$app->get('/admin/accounts/data', 'App\Controller\Admin\AccountController:dataTable')->add($adminMiddleWare);
$app->post('/admin/accounts/data', 'App\Controller\Admin\AccountController:dataTable')->add($adminMiddleWare);
$app->post('/admin/accounts/status', 'App\Controller\Admin\AccountController:changeStatus')->add($adminMiddleWare);
$app->post('/admin/accounts/role', 'App\Controller\Admin\AccountController:changeRole')->add($adminMiddleWare);
$app->get('/api/accounts/getForAutoComplete', 'App\Api\AccountAPI:getForAutoComplete')->add($apiErrorMiddleWare);

$app->get('/{page}', 'App\Controller\CMSController:show');
//$app->get('/sendmail', 'App\Controller\CMSController:sendEmail');

// -------------------
// ORTOS
// -------------------
$app->get('/', 'App\Controller\Admin\PatientsController:searchPage')->setName('search')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);


$app->get('/api/appointment', 'App\Api\AppointmentAPI:getScheduledTasks')->add($apiErrorMiddleWare);

$app->get('/api/appointment/dates', 'App\Api\AppointmentAPI:getScheduledAppointments')->add($apiErrorMiddleWare);
$app->post('/api/appointment/schedule', 'App\Api\AppointmentAPI:schedule')->add($apiErrorMiddleWare);
$app->post('/api/appointment/edit', 'App\Api\AppointmentAPI:edit')->add($apiErrorMiddleWare);
$app->post('/api/appointment/delete', 'App\Api\AppointmentAPI:delete')->add($apiErrorMiddleWare);
$app->get('/api/appointment/scheduledAppointmentsByPatient','App\Api\AppointmentAPI:getScheduledAppointmentsByPatient')->add($apiErrorMiddleWare);
$app->get('/api/appointment/detail', 'App\Api\AppointmentAPI:getEventDetail')->add($apiErrorMiddleWare);
$app->post('/api/appointment/addGCalendarEvent', 'App\Api\AppointmentAPI:addGCalendarEvent')->add($apiErrorMiddleWare);
$app->get('/api/appointment/getGCalendarEvent', 'App\Api\AppointmentAPI:getGCalendarEvent')->add($apiErrorMiddleWare);
$app->get('/api/patient/getForAutoComplete', 'App\Api\PatientAPI:getForAutoComplete')->add($apiErrorMiddleWare);
$app->get('/api/patient/getTabs', 'App\Api\PatientAPI:getTabs')->add($apiErrorMiddleWare);
$app->post('/api/patient/newTab', 'App\Api\PatientAPI:newTab')->add($apiErrorMiddleWare);
$app->post('/api/patient/editTab', 'App\Api\PatientAPI:editTab')->add($apiErrorMiddleWare);
$app->post('/api/patient/deleteTab', 'App\Api\PatientAPI:deleteTab')->add($apiErrorMiddleWare);
$app->post('/api/patient/deletePhoto', 'App\Api\PatientAPI:deletePhoto')->add($apiErrorMiddleWare);
$app->post('/api/patient/updatePhoto', 'App\Api\PatientAPI:updatePhoto')->add($apiErrorMiddleWare);
$app->post('/api/patient/editTask', 'App\Api\PatientAPI:editTask')->add($apiErrorMiddleWare);


$app->get('/admin/consultas', 'App\Controller\Admin\AppointmentController:indexPage')->setName('index')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);

$app->get('/admin/pacientes', 'App\Controller\Admin\PatientsController:searchPage')->setName('search')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/pacientes/cadastro', 'App\Controller\Admin\PatientsController:formPatients')->setName('register')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/pacientes/{id}/cadastro', 'App\Controller\Admin\PatientsController:formPatients')->setName('admin/patients/edit')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/cadastro', 'App\Controller\Admin\PatientsController:formPatients')->setName('register')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/{id}/cadastro', 'App\Controller\Admin\PatientsController:formPatients')->setName('admin/patients/edit')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);

// $app->post('/admin/pacientes/{id}/editar', 'App\Controller\Admin\PatientsController:editPatientPage')->setName('admin/patients/edit')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
//$this->post('/{id}', 'App\Controller\Admin\CMSController:save')->setName('admin/cms/save');
$app->get('/admin/pacientes/{id}/diagnostico', 'App\Controller\Admin\PatientsController:diagnosisPage')->setName('admin/patients/diagnosis')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/{id}/diagnostico', 'App\Controller\Admin\PatientsController:changeDiagnosis')->setName('admin/patients/diagnosis/editar')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/pacientes/{id}/consultas', 'App\Controller\Admin\PatientsController:appointment')->setName('admin/patients/appointment')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/pacientes/data', 'App\Controller\Admin\PatientsController:dataTable');
$app->post('/admin/pacientes/data', 'App\Controller\Admin\PatientsController:dataTable');

$app->get('/admin/pacientes/{id}/fotos', 'App\Controller\Admin\PatientsController:photosPage')->setName('admin/patients/photos')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/pacientes/{id}/raiox', 'App\Controller\Admin\PatientsController:rxPage')->setName('admin/patients/rx')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/pacientes/{id}/tomografias', 'App\Controller\Admin\PatientsController:tomoPage')->setName('admin/patients/tomo')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);


$app->post('/admin/pacientes/{id}/fotos', 'App\Controller\Admin\PatientsController:addPhoto')->setName('admin/patients/photos/add')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/{id}/raiox', 'App\Controller\Admin\PatientsController:addPhoto')->setName('admin/patients/rx/add')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/{id}/tomografias', 'App\Controller\Admin\PatientsController:addPhoto')->setName('admin/patients/tomo/add')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
// $app->post('/admin/pacientes/{id}/tomografias', 'App\Controller\Admin\PatientsController:tomoPage')->setName('admin/patients/tomo/add')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);



$app->post('/admin/relatorios/indicacoes', 'App\Controller\Admin\ReportsController:indicacoes')->setName('plano/tratamento')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/relatorios/atendimento-periodo', 'App\Controller\Admin\ReportsController:atendimentoPeriodo')->setName('plano/tratamento')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/relatorios', 'App\Controller\Admin\ReportsController:indexPage')->setName('index')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/relatorios/aniversario', 'App\Controller\Admin\ReportsController:birthday')->setName('birthday')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/relatorios/consultas', 'App\Controller\Admin\ReportsController:tasks')->setName('tasks')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/relatorios/consultas', 'App\Controller\Admin\ReportsController:tasks')->setName('tasks')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/relatorios/mapaDia', 'App\Controller\Admin\ReportsController:mapaDia')->setName('mapaDia')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/relatorios/aniversario', 'App\Controller\Admin\ReportsController:birthday')->setName('birthday')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/relatorios/plano-tratamento/{id}', 'App\Controller\Admin\ReportsController:planoTratamento')->setName('plano/tratamento')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->get('/admin/relatorios/download', 'App\Controller\Admin\ReportsController:downloadReports')->setName('reports/download')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);


$app->get('/admin/pacientes/{id}/tarefas', 'App\Controller\Admin\PatientsController:tasksPage')->setName('tasks')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/taskssave', 'App\Controller\Admin\PatientsController:tasksSave')->setName('taskssave')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/taskrefresh', 'App\Controller\Admin\PatientsController:tasksRefresh')->setName('taskssave')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/taskssave/sequencia', 'App\Controller\Admin\PatientsController:taskssaveSequencia')->setName('taskssave/sequencia')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);
$app->post('/admin/pacientes/tasks/delete', 'App\Controller\Admin\PatientsController:tasksDelete')->setName('tasks/delete')->add($accountErrorMiddleWare)->add($userLoggedInMiddleWare);


// -------------------
