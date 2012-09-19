<?php
$file = getenv("DOCUMENT_ROOT")."/format/images/properties/95x62/".$_GET['file'];
unlink($file);
$file = getenv("DOCUMENT_ROOT")."/format/images/properties/450x260/".$_GET['file'];
unlink($file);
$file = getenv("DOCUMENT_ROOT")."/format/images/properties/800x600/".$_GET['file'];
unlink($file);
echo "<span id='red'>File <strong>".$_GET['file']."</strong> successfully removed!</span>";
?>