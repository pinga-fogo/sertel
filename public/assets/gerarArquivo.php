<?
	$ini = parse_ini_file('/var/lib/asterisk/agi-bin/config.ini',true);

	$username = $ini['manager']['username'];
	$secret = $ini['manager']['secret'];
	$host = $ini['manager']['hostmanager'];
	$port = $ini['manager']['port'];

	$IU="m001/r001/f001/i001";

	/**/
	$arquivo_hints="/etc/asterisk/extensions_hints_sertel.conf";
	$sql="select * from tb_ramais order by ramal "; $vetor_sip="";
	$res=mysql_query($sql); $linhas=mysql_affected_rows();
	while ($obj=mysql_fetch_object($res)){
		/**/
      if($tecnologia=$obj->tecnologia=='SIP' or $tecnologia=$obj->tecnologia=='IAX2&SIP'){
      $arquivo_sip="/etc/asterisk/sip_ipbx_sertel.conf";

		$vetor_sip[]="[$obj->username](template)".chr(13).chr(10);
		$vetor_sip[]="username=$obj->username".chr(13).chr(10);
		$vetor_sip[]="secret=$obj->secret".chr(13).chr(10);
		$vetor_sip[]="nat=$obj->nat".chr(13).chr(10);
		$vetor_sip[]="pickupgroup=$obj->pickupgroup".chr(13).chr(10);
        $vetor_sip[]="callgroup=$obj->callgroup".chr(13).chr(10);
		$vetor_sip[]="callerid= \"$obj->calleridName\" <$obj->callerid> ".chr(13).chr(10);
		$vetor_sip[]="disallow=$obj->disallow".chr(13).chr(10);
		$allow=explode(",",$obj->allow);
		foreach ($allow as $key => $value) {
	  	$vetor_sip[]="allow=$value".chr(13).chr(10);
		}
		$vetor_sip[]="".chr(13).chr(10);
		
		$vetor_hints[]="exten => $obj->username,hint,SIP/$obj->username".chr(13).chr(10);    //exten => 101,hint,SIP/101
		/**/
	$fp = fopen($arquivo_sip, "w");
	foreach ($vetor_sip as $key => $value) {
	fwrite($fp, $value);
	}
	$fp = fopen($arquivo_hints, "w");
	foreach ($vetor_hints as $key => $value_hints) {
	fwrite($fp, $value_hints);
	}
	fclose($fp);
		}
	 }
	
   $sql="select * from tb_ramais order by ramal "; $vetor_iax="";
	$res=mysql_query($sql); $linhas=mysql_affected_rows();
	while ($obj=mysql_fetch_object($res)){
		/**/
    if($tecnologia=$obj->tecnologia=='IAX2' or $tecnologia=$obj->tecnologia=='IAX2&SIP'){
      $arquivo_iax="/etc/asterisk/iax_ipbx_sertel.conf";

		$vetor_iax[]="[$obj->username](template)".chr(13).chr(10);
		$vetor_iax[]="username=$obj->username".chr(13).chr(10);
		$vetor_iax[]="secret=$obj->secret".chr(13).chr(10);
	    $vetor_iax[]="nat=$obj->nat".chr(13).chr(10);
		$vetor_iax[]="pickupgroup=$obj->pickupgroup".chr(13).chr(10);
        $vetor_iax[]="callgroup=$obj->callgroup".chr(13).chr(10);
		$vetor_iax[]="callerid= \"$obj->callerid\" <$obj->callerid> ".chr(13).chr(10);
		$vetor_iax[]="disallow=$obj->disallow".chr(13).chr(10);
		$allow=explode(",",$obj->allow);
		foreach ($allow as $key => $value) {
	  	$vetor_iax[]="allow=$value".chr(13).chr(10);
		}
		$vetor_iax[]="".chr(13).chr(10);
		
		$vetor_hints[]="exten => $obj->username,hint,IAX2/$obj->username".chr(13).chr(10);    //exten => 101,hint,SIP/101
		
		/**/
    $fp = fopen($arquivo_iax, "w");
	foreach ($vetor_iax as $key => $value1) {
	fwrite($fp, $value1);
	}
	$fp = fopen($arquivo_hints, "w");
	foreach ($vetor_hints as $key => $value_hints) {
	fwrite($fp, $value_hints);
	}
	fclose($fp);
	}
	
 } 
 
    $sql="select * from tb_ramais order by ramal "; $vetor_kfxs=""; $i="1";
    $res=mysql_query($sql); $linhas=mysql_affected_rows();

	while ($obj=mysql_fetch_object($res)){
		
    if($tecnologia=$obj->tecnologia=='KFXS'){
    $porta=$obj->porta;
    $arquivo_kfxs="/etc/asterisk/khomp_fxs.conf";
	
	$vetor_kfxs[]=$porta.'='."calleridnum: $obj->callerid ".'|'."calleridname:$obj->calleridName".'|'." callgroup: $obj->callgroup ".'|'." pickupgroup: $obj->pickupgroup ";
    $vetor_kfxs[]="".chr(13).chr(10);
	
	$vetor_hints[]="exten => $obj->username,hint,Khomp/$porta".chr(13).chr(10);    //exten => 101,hint,SIP/101
		
    $fp = fopen($arquivo_kfxs, "w");
	foreach ($vetor_kfxs as $key => $value2) {
	fwrite($fp, $value2);
	}
	$fp = fopen($arquivo_hints, "w");
	foreach ($vetor_hints as $key => $value_hints) {
	fwrite($fp, $value_hints);
	}
	fclose($fp);
	}
 }
	$msn="Arquivo gerado com sucesso";
	$socket = fsockopen("localhost","$port", $errno, $errstr, 3000);
	fputs($socket, "Action: Login\r\n");
	fputs($socket, "UserName: $username\r\n");
	fputs($socket, "Secret: $secret\r\n\r\n");
    sleep(1);
	fputs($socket, "Action: command\r\n");
	fputs($socket, "Command: reload\r\n\r\n");
	fputs($socket, "Action: Logoff\r\n\r\n");

	$wrtes = fgets($socket, 2048);
	fclose($socket);

	
?>