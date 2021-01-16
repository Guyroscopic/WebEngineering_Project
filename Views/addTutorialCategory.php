<!DOCTYPE html>
<html>
<head>
	<title>Add Tutorial Category</title>
</head>
<body>

	<h1>Add Tutorial Category</h1>

	<?php if(@$_GET["empty"]){ ?>
        <div style="color: red">OOPS! Looks like you left a field empty</div>
    <?php } ?>

	<form action="../Controllers/AddTutorialCategoryController.php" method="POST">

		<label>Name of Category</label>
	    <input type="text" name="categoryName" placeholder="Enter Category Name" required>
	    <br><br>

	    <button name="add">Add Category</button>

	</form>

</body>
</html>