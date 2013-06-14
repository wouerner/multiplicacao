<?php
//include("../assets/php/database.php");
//include("../assets/php/class.acl.php");
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : '';
$_GET['roleID'] = isset($_GET['roleID']) ? $_GET['roleID'] : '';

//$myACL = new ACL();
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'saveRole':
            $strSQL = sprintf("REPLACE INTO `roles` SET `ID` = %u, `roleName` = '%s'",$_POST['roleID'],$_POST['roleName']);
            mysql_query($strSQL);
            if (mysql_affected_rows() > 1) {
                $roleID = $_POST['roleID'];
            } else {
                $roleID = mysql_insert_id();
            }
            foreach ($_POST as $k => $v) {
                if (substr($k,0,5) == "perm_") {
                    $permID = str_replace("perm_","",$k);
                    if ($v == 'X') {
                        $strSQL = sprintf("DELETE FROM `role_perms` WHERE `roleID` = %u AND `permID` = %u",$roleID,$permID);
                        mysql_query($strSQL);
                        continue;
                    }
                    $strSQL = sprintf("REPLACE INTO `role_perms` SET `roleID` = %u, `permID` = %u, `value` = %u, `addDate` = '%s'",$roleID,$permID,$v,date ("Y-m-d H:i:s"));
                    mysql_query($strSQL);
                }
            }
            header("location: /seguranca/acl/roles");
        break;
        case 'delRole':
            $strSQL = sprintf("DELETE FROM `roles` WHERE `ID` = %u LIMIT 1",$_POST['roleID']);
            mysql_query($strSQL);
            $strSQL = sprintf("DELETE FROM `user_roles` WHERE `roleID` = %u",$_POST['roleID']);
            mysql_query($strSQL);
            $strSQL = sprintf("DELETE FROM `role_perms` WHERE `roleID` = %u",$_POST['roleID']);
            mysql_query($strSQL);
            header("location: /seguranca/acl/roles");
        break;
    }
}
/*if ($myACL->hasPermission('access_admin') != true) {
    header("location: ../index.php");
}*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ACL Test</title>
<link href="/modulos/seguranca/ACL/assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"></div>
<div id="adminButton"><a href="/seguranca/acl">Main Screen</a> | <a href="/seguranca/acl/admin">Admin Home</a></div>
<div id="page">

    <?php if ($_GET['action'] == '') { ?>
        <h2>Select a Role to Manage:</h2>
        <?php
        $roles = $myACL->getAllRoles('full');
        foreach ($roles as $k => $v) {
            echo "<a href=\"?action=role&roleID=" . $v['ID'] . "\">" . $v['Name'] . "</a><br />";
        }
        if (count($roles) < 1) {
            echo "No roles yet.<br />";
        } ?>
        <input type="button" name="New" value="New Role" onclick="window.location='?action=role'" />
    <?php }
    if ($_GET['action'] == 'role') {
        if ($_GET['roleID'] == '') {
        ?>
        <h2>New Role:</h2>
        <?php } else { ?>
        <h2>Manage Role: (<?php echo $myACL->getRoleNameFromID($_GET['roleID']); ?>)</h2><?php } ?>

        <form action="/seguranca/acl/roles" method="post">
            <label for="roleName">Name:</label><input type="text" name="roleName" id="roleName" value="<?php echo  $myACL->getRoleNameFromID($_GET['roleID']); ?>" />
            <table border="0" cellpadding="5" cellspacing="0">
            <tr><th></th><th>Allow</th><th>Deny</th><th>Ignore</th></tr>
            <?php
            $rPerms = $myACL->getRolePerms($_GET['roleID']);
                        $aPerms = $myACL->getAllPerms('full');
                        //var_dump($rPerms);
                        //var_dump($aPerms);

                        ?>

                        <?php foreach ($aPerms as $k => $v): ?>
                        <tr><td><label>
                                <?php  echo  $v['Name'] ;?>
                            </label></td>

                        <td>
                            <input type="radio" name="perm_<?php echo $v['ID'] ?>" id="perm_<?php echo $v['ID'] ?>_1" value="1"

                                <?php	if (isset($rPerms[$v['Key']]['value']) && $rPerms[$v['Key']]['value'] === true && $_GET['roleID'] != '') : ?>
                                    checked="checked"
                                <?php endif; ?>
                                />
                        </td>

                        <td>
                            <input type="radio" name="perm_<?php echo $v['ID'] ?>"  id="perm_<?php echo $v['ID'] ?>_0" value="0"
                                <?php if (isset($rPerms[$v['Key']]['value']) && $rPerms[$v['Key']]['value'] != true && $_GET['roleID'] != ''): ?>
                                    checked="checked"
                                <?php endif; ?>
                        /></td>

                        <td>
                            <input type="radio" name="perm_<?php echo $v['ID'] ; ?>" id="perm_<?php echo $v['ID'] ?>_X" value="X"

                                <?php  if ($_GET['roleID'] == '' || !array_key_exists($v['Key'],$rPerms)) : ?>
                                     checked="checked"
                                <?php endif ; ?>

                                 />
                            </td>
                </tr>

                    <?php endforeach ; ?>
        </table>
        <input type="hidden" name="action" value="saveRole" />
        <input type="hidden" name="roleID" value="<?php echo $_GET['roleID']; ?>" />
        <input type="submit" name="Submit" value="Submit" />
    </form>
    <form action="/seguranca/acl/roles" method="post">
         <input type="hidden" name="action" value="delRole" />
         <input type="hidden" name="roleID" value="<?php echo $_GET['roleID']; ?>" />
        <input type="submit" name="Delete" value="Delete" />
    </form>
    <form action="/seguranca/acl/roles" method="post">
        <input type="submit" name="Cancel" value="Cancel" />
    </form>
    <?php } ?>
</div>
</body>
</html>
