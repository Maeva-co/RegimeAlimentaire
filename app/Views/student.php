<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
</head>
<body>
    <h1>Student List</h1>
    <?php foreach ($student as $students) { ?>
        <h2><?php echo $students['prenom']; echo $students['nom']; ?></h2>
    <?php } ?>
</body>
</html>