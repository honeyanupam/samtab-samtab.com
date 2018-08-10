<?php
 
?>
<?php 
if(isset($_POST['submit'])){
	$file = $_POST['file'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://api.newocr.com/v1/upload?key=1ab51bebfbea58c865c26a1b125cdbc8');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => '@'.$file));
	echo  $result = curl_exec($ch);
	echo $result;
	curl_close ($ch);
}
  
?>
<form method='POST' enctype="multipart/form-data">
<input type='file' name='file' />
<button type='submit' name='submit'>Submit</button>
</form>