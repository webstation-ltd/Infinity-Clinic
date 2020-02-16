<?
class myorder{
	
	public static function maxOrder($sql){
		$db =  db::getInstance();
		$max = $db->dbArray($sql, true);	
		return $max['max'];
	}
	
	public static function minOreder($sql){
		$db =  db::getInstance();
		$max = $db->dbArray($sql, true);	
		return $max['min'];
	}
	
	
	public static function arrows($id, $min, $max, $controller){
		if($id == $min){
			echo '<a href="?c='.$controller.'&mode=down&myorder='.$id.'">
				<img src="'.ADMIN.'/html/img/UpArrow.jpg" width="20" height="20" alt="up"/>
			</a>';
		}elseif($id == $max){
			echo '<a href="?c='.$controller.'&mode=up&myorder='.$id.'">
				<img src="'.ADMIN.'/html/img/DownArrow.jpg" width="20" height="20" alt="down" />
			</a>';
		}else{
			echo '<a href="?c='.$controller.'&mode=up&myorder='.$id.'">
				<img src="'.ADMIN.'/html/img/DownArrow.jpg" width="20" height="20" alt="down" />
			</a> ';
			echo '<a href="?c='.$controller.'&mode=down&myorder='.$id.'">
				<img src="'.ADMIN.'/html/img/UpArrow.jpg" width="20" height="20" alt="up"/>
			</a>';
		}
	}
	
	
	
	
	public static function up($orde_id, $table_name, $sql=''){
		$db =  db::getInstance();
		$before_number = $db->dbArray('SELECT * FROM '.$table_name.' 
		WHERE myorder<'.$orde_id.' '.$sql.' ORDER BY myorder DESC LIMIT 0,1', 1);
		$before_number = $before_number['myorder'];
		
		$db->dbQuery('UPDATE '.$table_name.' SET `myorder`=0 WHERE `myorder` ='.$before_number.' '.$sql);
		$db->dbQuery('UPDATE '.$table_name.' SET `myorder`='.$before_number.' WHERE `myorder`='.$orde_id.' '.$sql);
		$db->dbQuery('UPDATE '.$table_name.' SET `myorder`='.$orde_id.' WHERE `myorder`=0 '.$sql);
		
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	
	public static function down($orde_id, $table_name, $sql=''){
		$db =  db::getInstance();
		
		$next_number = $db->dbArray('SELECT * FROM '.$table_name.' 
		WHERE myorder>'.$orde_id.' '.$sql.' ORDER BY myorder  ASC LIMIT 0,1', 1);
		$next_number = $next_number['myorder'];
		
		$db->dbQuery('UPDATE '.$table_name.' SET `myorder`=0 WHERE `myorder` ='.$next_number.' '.$sql);
		$db->dbQuery('UPDATE '.$table_name.' SET `myorder`='.$next_number.' WHERE `myorder`='.$orde_id.' '.$sql);
		$db->dbQuery('UPDATE '.$table_name.' SET `myorder`='.$orde_id.' WHERE `myorder`=0 '.$sql);
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
}