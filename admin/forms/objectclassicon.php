<?PHP
	if (is_file("../pics/icons/".$objectclassicon))
	{
		echo "<IMG SRC='../pics/icons/".$objectclassicon."' ";
	}
	else
	{
		if (is_file("../../pics/icons/".$objectclassicon))
		{
			echo "<IMG SRC='../../pics/icons/".$objectclassicon."' ";
		}
		else
		{
			echo "<IMG SRC='../../../pics/icons/".$objectclassicon."' ";
		}
	}
	
	// ################################
	// Tooltip ausgeben, falls möglich:
	if (isset($objectclassshownname))
	{
		echo "title='Typ: ".$objectclassshownname."' ";
	}
	else 
	{
		echo "title='Icon der Objektklasse' ";
	}
	
	echo "border=0 width=14 hight=14>".chr(13).chr(10);
?>