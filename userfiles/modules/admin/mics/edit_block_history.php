<? 
 

 
$the_dir = normalize_path ( TEMPLATE_DIR . 'blocks/' );
 $id = $params['id'];
 $page_id = $params['page_id'];
 $rel = $params['rel'];
 $field = $params['field'];
 
 if($rel == 'global'){
	 $page_id = false;
 }
 
  if($rel == 'page'){
	 $ref_page = $_SERVER ['HTTP_REFERER'];
				$ref_page = $_SERVER ['HTTP_REFERER'] . '/json:true';
				$ref_page = file_get_contents ( $ref_page );
				if ($ref_page != '') {
					$save_global = false;
					$ref_page = json_decode ( $ref_page );
					$page_id = $ref_page->page->id;
					 
				}
 }
 
 if($rel == 'post'){
	 $ref_page = $_SERVER ['HTTP_REFERER'];
				$ref_page = $_SERVER ['HTTP_REFERER'] . '/json:true';
				$ref_page = file_get_contents ( $ref_page );
				if ($ref_page != '') {
					$save_global = false;
					$ref_page = json_decode ( $ref_page );
					$page_id = $ref_page->post->id;
					 
				}
 }
 
 if ($page_id == true) {
			$the_dir = TEMPLATE_DIR . 'blocks/' . $page_id;
			$the_dir = normalize_path ( $the_dir );
			$try_file = $the_dir . $id . '.php';
			if (is_file ( $try_file )) {
			} else {
					$the_dir = normalize_path ( TEMPLATE_DIR . 'blocks/' ); 
			}
		} else {
			$the_dir = normalize_path ( TEMPLATE_DIR . 'blocks/' );
		}
		
		
		if($params['tag'] != 'edit'){
 
$history_dir = APPPATH . '/history/blocks/' . $id . '/';
			$history_dir = normalize_path ( $history_dir );
			$history_dir = reduce_double_slashes($history_dir);
			$history_files = array();
					foreach (glob($history_dir."*.php") as $filename) {
						$history_files [] = $filename;
					}
			
		} else {
			
			if(intval($page_id) == 0){
		//	$page_id = 'global';	
			}
			
			$history_dir = APPPATH . '/history/blocks/' . $id . '/';
			$history_dir = normalize_path ( $history_dir );
			$history_dir = reduce_double_slashes($history_dir);
			$hdata= array();
			if($rel != 'global'){
			$hdata['table'] = 'table_content';
			}
			$hdata['id'] = $page_id;
			
			
			$hdata['field'] = $field;
			
			$history_files = CI::model('core')->getHistoryFiles($hdata);
			// p($params);
 
		}
			//p($history_dir);
			?>
            
<script type="application/javascript"> 
 

 


var replace_content_from_history = function($history_file_base64_encoded){
	
	<? if($params['tag'] != 'edit') : ?>
   load_editblock('<? print $id ?>', $history_file_base64_encoded) ;
   
   <? else: ?>
   
   load_field_from_history_file('<? print $id ?>', $history_file_base64_encoded) ;
   <? endif; ?>
   
   
}


</script>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
	<ul style="display:block; height:40px; width:250px; overflow:scroll">
	<? 		foreach ($history_files as $filename) : ?>
    
    
    <li>
    
    <? //$content_of_file = file_get_contents($filename);	?>
    
  <a href="javascript: replace_content_from_history('<? print base64_encode($filename) ?>')"> <? print basename($filename ); ?> </a>

   
    </li>
    
    
    
<? 		endforeach; ?>
</ul>


