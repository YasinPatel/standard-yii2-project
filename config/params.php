<?php
include('api_messages.php');

return array_merge(
[
   'adminEmail' => 'admin@example.com',
   'apptitle' => 'Standard',//APP TITLE
   'appName' => 'Standard',
   'appcookiename' => 'Standard',
   'msg_success' =>'<div class="alert alert-dismissable alert-success fade in form-group">
                     <button data-dismiss="alert" class="close close-sm" type="button">
                         <i class="fa fa-times"></i>
                     </button>',
   'msg_error' =>  '<div class="alert alert-dismissable alert-block alert-danger fade in form-group">
                     <button data-dismiss="alert" class="close close-sm" type="button">
                         <i class="fa fa-times"></i>
                     </button>',
   'userimage' => 'img/uploads/users/',
   'response_text'=>array(200=>"Success",400=>'Bad Request',401=>'Unauthorized',403=>'Forbidden',404=>'Not Found',500=>'Internal Server Error',601=>'Data Dupliacation',602=>'Could Not Save',603=>'No data found'),
   'msg_end' => '</div>',
]
,$array);
