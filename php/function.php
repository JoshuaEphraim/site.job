<?php
	function countPagination($this_page, $table, $db_c, $show_pages, $condition = null,$count){
        $result=$db_c->query('SELECT COUNT('.$count.') AS count FROM '.$table.' '.$condition);
        $row_2=$result->fetch_assoc();
		$rows_max = $row_2['count']; 

		if ($this_page){
			$offset = (($show_pages * $this_page) - $show_pages);
		}else{
			$this_page = 1;
			$offset = 0;
		}
		return array('rows_max' => $rows_max, 'offset' => $offset);
	}

	function generatePagination($this_page, $rows_max, $connect, $search, $show_pages, $condition = null, $page_name = 'page'){
		if ($rows_max > $show_pages){
			echo'<ul class="pagination">';

			$r=1;
			while ($r <= ceil($rows_max/$show_pages)){
				if ($r != $this_page){
					($search!='')?$search='&search='.$search:$search='';
					echo '<li><a href="?connect='.$connect.'&'.$page_name.'='.$r.''.$condition.$search.'" title="To page '.$r.'">'.$r.'</a></li>';
				}else{
					echo '<li class="disabled"><a>'.$r.'</a></li>';}
				$r++;       
			}
			echo"</ul>";
		}
	}
	function fetchAll($rows, $pag, $show_pages)
	{
		$i=0;
		while($c=$rows->fetch_array())
		{
			++$i;
			if($i>$pag['offset']&&$i<=$pag['offset']+$show_pages) {
				$comment[] = $c;
			}
		}
		return $comment;
	}
	function cleanText($text,$db_c)
	{
		$text = trim($text);
		$text = strip_tags($text);
		$text = htmlspecialchars($text);
		$text = $db_c->real_escape_string($text);
		return $text;
	}
?>