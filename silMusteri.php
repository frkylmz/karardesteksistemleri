<?php 

if ($_GET) 
{

$baglanti=mysqli_connect("localhost","root","","karardesteksistemleri");

    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit;
    }


if ($baglanti) 
{
	$sorgu=mysqli_query($baglanti,"DELETE FROM musteriler WHERE mus_id =".(int)$_GET['id']);
	if($sorgu){
		header("location:musteriler.php"); 
	}
}
}

?>