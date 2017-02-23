<?php


print_r($data);

echo $data2;
?>

<form action="../ajouterPublication/<?php echo $data2; ?>" method="post">
<textarea name="publications">
</textarea>
    <input type="text" name="url">
<input type="submit">
</form>
<a href="../logout">Logout</a>
