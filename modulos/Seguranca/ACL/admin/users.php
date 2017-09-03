<?php
//include("../assets/php/database.php");
//include("../assets/php/class.acl.php");

$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : '';

//$myACL = new ACL();
if (isset($_POST['action']))
{
	switch($_POST['action'])
	{
		case 'saveRoles':
			$redir = "?action=user&userID=" . $_POST['userID'];
			foreach ($_POST as $k => $v)
			{
				if (substr($k,0,5) == "role_")
				{
					$roleID = str_replace("role_","",$k);
					if ($v == '0' || $v == 'x') {
						$strSQL = sprintf("DELETE FROM `user_roles` WHERE `userID` = %u AND `roleID` = %u",$_POST['userID'],$roleID);
					} else {
						$strSQL = sprintf("REPLACE INTO `user_roles` SET `userID` = %u, `roleID` = %u, `addDate` = '%s'",$_POST['userID'],$roleID,date ("Y-m-d H:i:s"));
					}
				//	echo $strSQL."<br>";
					mysqli_query($link, $strSQL);
				}
			}
		//exit;
		break;
		case 'savePerms':
			$redir = "?action=user&userID=" . $_POST['userID'];
			foreach ($_POST as $k => $v)
			{
				if (substr($k,0,5) == "perm_")
				{
					$permID = str_replace("perm_","",$k);
					if ($v == 'x')
					{
						$strSQL = sprintf("DELETE FROM `user_perms` WHERE `userID` = %u AND `permID` = %u",$_POST['userID'],$permID);
					} else {
						$strSQL = sprintf("REPLACE INTO `user_perms` SET `userID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$_POST['userID'],$permID,$v,date ("Y-m-d H:i:s"));
					}
					mysql_query($strSQL);
				}
			}
		break;
	}
	header("location: /seguranca/acl/user" . $redir);
}
//if ($myACL->hasPermission('access_admin') != true)
//{
//	header("location: ../index.php");
//}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ACL Test</title>
<link href="/modulos/seguranca/ACL/assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"></div>
<div id="adminButton"><a href="/seguranca/acl">Main Screen</a> | <a href="index.php">Admin Home</a></div>

<div id="page">

	<?php
		if ($_GET['action'] == '' ) : ?>
    	<h2>Select a User to Manage:</h2>
        <?php
				$strSQL = "SELECT * FROM Discipulo ORDER BY nome ASC";
				$data = mysqli_query($link, $strSQL);
				?>
			<?php while ($row = mysqli_fetch_assoc($data)): ?>
						<a href="?action=user&userID=<?php echo $row['id'] ; ?>"><?php echo $row['email'] ?></a><br />
			<?php endwhile; ?>
		<?php endif ; ?>

    <?php
    if ($_GET['action'] == 'user' ) {
		$userACL = new \Seguranca\Modelo\Acl($_GET['userID']);
	?>
    	<h2>Managing <?php echo $myACL->getUsername($_GET['userID']); ?>:</h2>
        ... Some form to edit user info ...
        <h3>Roles for user:   (<a href="/seguranca/acl/user?action=roles&userID=<?php echo $_GET['userID']; ?>">Manage Roles</a>)</h3>
        <ul>

        <?php $roles = $userACL->getUserRoles();
		foreach ($roles as $k => $v)
		{
			echo "<li>" . $userACL->getRoleNameFromID($v) . "</li>";
		}
		?>
        </ul>
        <h3>Permissions for user:   (<a href="/seguranca/acl/user?action=perms&userID=<?php echo $_GET['userID']; ?>">Manage Permissions</a>)</h3>
        <ul>
        <?php $perms = $userACL->perms;
		foreach ($perms as $k => $v)
		{
			if ($v['value'] === false) { continue; }
			echo "<li>" . $v['Name'];
			if ($v['inheritted']) { echo "  (inheritted)"; }
			echo "</li>";
		}
		?>
        </ul>
     <?php } ?>

     <?php if ($_GET['action'] == 'roles') { ?>
     <h2>Manage User Roles: (<?php echo $myACL->getUsername($_GET['userID']); ?>)</h2>
     <form action="/seguranca/acl/user" method="post">
        <table border="0" cellpadding="5" cellspacing="0">
        <tr><th></th><th>Member</th><th>Not Member</th></tr>
        <?php
		$roleACL = new \Seguranca\Modelo\Acl($_GET['userID']);
		$roles = $roleACL->getAllRoles('full');

		foreach ($roles as $k => $v): ?>

				<tr><td><label><?php echo $v['Name'] ; ?> </label></td>

				<td><input type="radio" name="role_<?php echo $v['ID'] ; ?>" id="role_<?php echo $v['ID'] ?>_1" value="1"
						<?php if ($roleACL->userHasRole($v['ID'])) : ?>
								checked="checked";
							<?php endif ; ?>
						 /></td>

						<td><input type="radio" name="role_<?php echo $v['ID'] ; ?>" id="role_<?php echo $v['ID'] ; ?>_0" value="0"
							<?php if (!$roleACL->userHasRole($v['ID'])) :?>
							 checked="checked"
							<?php endif; ?>
             /></td>
            </tr>

						<?php endforeach ; ?>

        </table>
        <input type="hidden" name="action" value="saveRoles" />
        <input type="hidden" name="userID" value="<?php echo $_GET['userID']; ?>" />
        <input type="submit" name="Submit" value="Submit" />
    </form>
    <form action="users.php" method="post">
    	<input type="button" name="Cancel" onclick="window.location='?action=user&userID=<?php echo $_GET['userID']; ?>'" value="Cancel" />
    </form>
     <?php } ?>
     <?php
    if ($_GET['action'] == 'perms' ) {
	?>
    	<h2>Manage User Permissions: (<?php echo  $myACL->getUsername($_GET['userID'])[0]['email']; ?>) </h2>
        <form action="/seguranca/acl/user" method="post">
            <table border="0" cellpadding="5" cellspacing="0">
            <tr><th></th><th></th></tr>
            <?php
                $userACL = new \Seguranca\Modelo\Acl($_GET['userID']);
                $rPerms = $userACL->perms;
                $aPerms = $userACL->getAllPerms('full');
            ?>

				<?php foreach ($aPerms as $k => $v): ?>
					<tr><td>
							<?php  echo  $v['Name'] ; ?>
						</td>

						<td>
							<select name= "perm_<?php	echo $v['ID'] ?>" />
                                <option value="1"
                                    <?php echo ($userACL->hasPermission($v['Key']) && $rPerms[$v['Key']]['inheritted'] != true) ? 'selected="selected"' :'' ?>
                                >Allow</option>

                            <option value="0"
                                <?php
                echo (in_array($v['Key'], $rPerms)  && $rPerms[$v['Key']]['value'] === false &&
                    $rPerms[$v['Key']]['inheritted'] != true) ? 'selected="selected"' :'';
                                                    $iVal = '';
                                        ?>
                            >Deny</option>

                            <?php
                                    echo "<option value=\"x\"";
                                    if (in_array($v['Key'], $rPerms) && $rPerms[$v['Key']]['inheritted'] == true || !array_key_exists($v['Key'],$rPerms))
                                    {
                                        echo " selected=\"selected\"";
                                            if (in_array($v['Key'], $rPerms) && $rPerms[$v['Key']]['value'] === true )
                                                {
                                                    $iVal = '(Allow)';
                                            } else {
                                                    $iVal = '(Deny)';
                                            }
                                    }
				echo ">Inherit $iVal</option>";
				echo "</select></td></tr>"; ?>
				<?php   endforeach ; ?>
    	</table>

    	<input type="hidden" name="action" value="savePerms" />
      <input type="hidden" name="userID" value="<?php  echo $_GET['userID']; ?>" />
    	<input type="submit" name="Submit" value="Submit" />
    </form>
    <form action="users.php" method="post">
    	<input type="button" name="Cancel" onclick="window.location='?action=user&userID=<?php echo $_GET['userID']; ?>'" value="Cancel" />
    </form>
    <?php } ?>
</div>
</body>
</html>
