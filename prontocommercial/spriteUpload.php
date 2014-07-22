<?php
	// Edit upload location here
	$destination_path = getcwd().DIRECTORY_SEPARATOR . "uploadedSprites" .DIRECTORY_SEPARATOR;
	$x = getcwd();

	$result = 0;
	if (@chdir($destination_path) == true){
		chdir($x);
		echo "uploading to: " . $destination_path . "<br/>";

		if ($_FILES["sFile"]["error"] > 0){
			echo "Error: " . $_FILES["sFile"]["error"] . "<br />";
		}
		else
		{
			echo "Upload: " 	. $_FILES["sFile"]["name"] . "<br />";
			echo "Type: "		. $_FILES["sFile"]["type"] . "<br />";
			echo "Size: "		. ($_FILES["sFile"]["size"] / 1024) . " Kb<br />";
			echo "Stored in: "  . $_FILES["sFile"]["tmp_name"];
			$target_path = $destination_path . basename( $_FILES['sFile']['name']);

			if(@move_uploaded_file($_FILES['sFile']['tmp_name'], $target_path)) {
				$result = 1;
			}
		}
		sleep(1);
	}
	else
		echo "directory " . $destination_path . " was not found";
?>

<script type="text/javascript">window.top.window.uploadResult(<?php echo $result; ?>);</script>