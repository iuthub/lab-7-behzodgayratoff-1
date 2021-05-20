<?php
$db = new PDO('mysql:host=localhost;dbname=customers', 'desmond', 'qIYlszWWsWE2eGqN');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$add_account_stmt = $db->prepare('INSERT INTO accounts(username, fullname, email) VALUES(?,?,?)');
$get_accounts_stmt = $db->prepare('SELECT * FROM accounts');

$username = '';
$fullname = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_REQUEST['txtLogin'];
    $fullname = $_REQUEST['txtName'];
    $email = $_REQUEST['txtEmail'];
    $add_account_stmt->execute(array($username, $fullname, $email));
}

$get_accounts_stmt->execute();
$rows = $get_accounts_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="customer.css" type="text/css" rel="stylesheet" />
    <title>Customers</title>
</head>
<body>
<div class="container">
    <h2>Add Customer</h2>
    <div class="add">
        <form action="customers.php" method="post">
            <label for="txtLogin">login:</label>
            <input type="text" name="txtLogin" value="<?= $username ?>" id="txtLogin">
            <label for="txtName">name:</label>
            <input type="text" name="txtName"  value="<?= $fullname ?>" id="txtName">
            <label for="txtEmail">email:</label>
            <input type="text" name="txtEmail"  value="<?= $email ?>" id="txtEmail">
            <input type="submit" value="Add" name="btnAdd" id="btnAdd">
        </form>
    </div>
    <h2>Customers</h2>
    <div class="customers">
        <?php foreach($rows as $row) { ?>
            <div class="customer">
                <dl>
                    <dt>Name:</dt>
                    <dd><?= $row['fullname'] ?></dd>
                    <dt>Email:</dt>
                    <dd><?= $row['email'] ?></dd>
                </dl>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>