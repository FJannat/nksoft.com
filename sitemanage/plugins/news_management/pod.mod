<?php

 
$pod_mod = array(
								'sectionName' 	=> 'News Articles',
								'cols' 					=> 1,
								'tableName' 		=> 'news',
								'dirName'				=> 'news_management',
								'query' 				=> 'select id, title as name from news'
								);

$pod_temp = array(
								 '<!TITLE!>'			=> 'title',
								 '<!ID!>'					=> 'id',
								 '<!BODY!>'				=> 'body',
								 '<!USER_ID!>'		=> 'user_id',
								 '<!PUB_DATE!>'		=> 'published_date'
								 );

?>