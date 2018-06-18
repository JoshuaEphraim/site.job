<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 24.11.2017
 * Time: 14:24
 */
class ReverseIpParser implements iParse
{
	public function parse($get){
		$pq = phpQuery::newDocument($get);
		$links = $pq->find('.b-text-hoster a');
		foreach ($links as $link) {
			$pqLink = pq($link);
			$text[] = $pqLink->html();
		}
		if (!empty($text)) {
			return $text;
		} else {
			return NULL;
		}
	}
}