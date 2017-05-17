<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ACL Test</title>
<link href="/modulos/seguranca/ACL/assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"></div>
<div id="adminButton"><a href="/seguranca/acl/admin">Admin Screen</a></div>
<div id="page">
	<h2>Permissions for <?php $myACL->getUsername($userID); ?>:</h2>

	<?php
		$aPerms = $userACL->getAllPerms('full');
		echo 'ID user: '.$userID.' <br>' ;

		foreach ($aPerms as $k => $v)
		{
			echo "<strong>" . $v['Name'] . ": </strong>";
			echo "<img src=\"/modulos/seguranca/ACL/assets/img/";
			if ($userACL->hasPermission($v['Key']) === true)
			{
				echo "allow.png";
				$pVal = "Allow";
			} else {
				echo "deny.png";
				$pVal = "Deny";
			}
			echo "\" width=\"16\" height=\"16\" alt=\"$pVal\" /><br />";
		}
	?>
    <h3>Change User:</h3>

    <?php
    //var_dump($link);die;
		$strSQL = "SELECT * FROM `Discipulo` ORDER BY `nome` ASC";
		$data = mysqli_query($link, $strSQL);

		while ($row = mysqli_fetch_assoc( $data))
		{
			echo "<a href=\"?userID=" . $row['id'] . "\">" . $row['email'] . "</a><br />";
		}
?>

</div>
</body>
</html>
