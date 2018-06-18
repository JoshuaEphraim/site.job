<?php 
	//$need = intval($_GET['need']);
	
	$url = 'http://5.61.35.243/work09679/domain_checker/script/domain_give.php?catalog=1&category=pharm&need=5';

	include('config.php');

	$domains = file_get_contents($url);
	$domain_list = explode(PHP_EOL, $domains);
	if(count($domain_list)>0){

		$ii = 0; $sql = 'INSERT IGNORE INTO `'.DBP.'domain` (`domain`) VALUES '; $cl = 1;

		foreach($domain_list as $k => $v){
			$domain = explode(';',$v);
		
			$ii++; $cl = 0;
			$sql.='("'.$db_c->real_escape_string(trim($domain[0])).'"),';
	
			if($ii==500){
				$cl = 1;
				$sql = substr($sql, 0, -1);
				$sql.=';';
				$db_c->multi_query($sql);

				$sql = 'INSERT IGNORE INTO `'.DBP.'domain` (`domain`) VALUES '; $ii = 0;
			}
		}

		if($cl == 0){
			$sql = substr($sql, 0, -1);
			$sql.=';';

			$db_c->multi_query($sql);
		}

		echo 'done';
	}else{
		echo 'No domains';
	}	
?>