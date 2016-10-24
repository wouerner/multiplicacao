<?php
namespace Seguranca\Modelo;
use \Framework\Modelo\ModeloFramework;

class Acl extends ModeloFramework
{
    public $perms = array();		//Array : Stores the permissions for the user
    public $userID = 0;			//Integer : Stores the ID of the current user
    public $userRoles = array();	//Array : Stores the roles of the current user

    /*public function __constructor($userID = '')
    {
        if ($userID != '')
        {
            $this->userID = floatval($userID);
        } else {
            $this->userID = floatval($_SESSION['userID']);
        }
        $this->userRoles = $this->getUserRoles('ids');
        $this->buildACL();
    }*/

    public function __construct($userID = '')
    {
        $this->con = self::pegarConexao();
        if ($userID != '')
        {
            $this->userID = floatval($userID);
        } else {
            $this->userID = floatval($_SESSION['userID']);
        }
        $this->userRoles = $this->getUserRoles('ids');
        $this->buildACL();
    }

    /*function ACL($userID = '')
    {
        $this->__constructor($userID);
        //crutch for PHP4 setups
    }*/

    function buildACL()
    {
        //first, get the rules for the user's role
        if (count($this->userRoles) > 0)
        {
            $this->perms = array_merge($this->perms,$this->getRolePerms($this->userRoles));
        }
        //then, get the individual user permissions
        $this->perms = array_merge($this->perms,$this->getUserPerms($this->userID));
    }

    function getPermKeyFromID($permID)
    {
        $strSQL = "SELECT `permKey` FROM `permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
        //$data = mysql_query($strSQL);
        $stm = $this->con->prepare($strSQL);
        $stm->execute();
        //$row = mysql_fetch_array($data);
        $row = $stm->fetch();
        return $row[0];
    }

    function getPermNameFromID($permID)
    {
        $strSQL = "SELECT `permName` FROM `permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
        $stm = $this->con->prepare($strSQL);
        $stm->execute();
        //$data = mysql_query($strSQL);
        //$row = mysql_fetch_array($data);
        $row = $stm->fetch();
        return $row[0];
    }

    function getRoleNameFromID($roleID)
    {
        $strSQL = "SELECT `roleName` FROM `roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
        $data = mysql_query($strSQL);
        $row = mysql_fetch_array($data);
        return $row[0];
    }

    function getUserRoles()
    {
        $strSQL = "SELECT * FROM `user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
        //$data = mysqli_query(LINK, $strSQL);
        $resp = array();

        $stm = $this->con->prepare($strSQL);
        $stm->execute();

        //echo mysql_error();
        //while($row = mysql_fetch_array($data))
        while($row = $stm->fetch(\PDO::FETCH_ASSOC))
        {
            $resp[] = $row['roleID'];
        }
        return $resp;
    }

    function getAllRoles($format='ids')
    {
        $format = strtolower($format);
        $strSQL = "SELECT * FROM `roles` ORDER BY `roleName` ASC";
        $data = mysql_query($strSQL);
        $resp = array();
        while($row = mysql_fetch_array($data))
        {
            if ($format == 'full')
            {
                $resp[] = array("ID" => $row['ID'],"Name" => $row['roleName']);
            } else {
                $resp[] = $row['ID'];
            }
        }
        return $resp;
    }

    function getAllPerms($format='ids')
    {
        $format = strtolower($format);
        $strSQL = "SELECT * FROM `permissions` ORDER BY `permName` ASC";
        $data = mysql_query($strSQL);
        $resp = array();
        while($row = mysql_fetch_assoc($data))
        {
            if ($format == 'full')
            {
                $resp[$row['permKey']] = array('ID' => $row['ID'], 'Name' => $row['permName'], 'Key' => $row['permKey']);
            } else {
                $resp[] = $row['ID'];
            }
        }
        return $resp;
    }

    function getRolePerms($role)
    {
        if (is_array($role))
        {
            $roleSQL = "SELECT * FROM `role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
        } else {
            $roleSQL = "SELECT * FROM `role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
        }

        $stm = $this->con->prepare($roleSQL);
        $stm->execute();
        //$data = mysql_query($roleSQL);
        $perms = array();
        while($row = $stm->fetch(\PDO::FETCH_ASSOC))
        {
            $pK = strtolower($this->getPermKeyFromID($row['permID']));
            if ($pK == '') { continue; }
            if ($row['value'] === '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $perms[$pK] = array('perm' => $pK,'inheritted' => true,'value' => $hP,'Name' => $this->getPermNameFromID($row['permID']),'ID' => $row['permID']);
        }
        return $perms;
    }

    function getUserPerms($userID)
    {
        $strSQL = "SELECT * FROM `user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";
        //$data = mysql_query($strSQL);
        $stm = $this->con->prepare($strSQL);
        $stm->execute();
        $perms = array();
        //while($row = mysql_fetch_assoc($data))
        while($row = $stm->fetch(\PDO::FETCH_ASSOC))
        {
            $pK = strtolower($this->getPermKeyFromID($row['permID']));
            if ($pK == '') { continue; }
            if ($row['value'] == '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $perms[$pK] = array('perm' => $pK,'inheritted' => false,'value' => $hP,'Name' => $this->getPermNameFromID($row['permID']),'ID' => $row['permID']);
        }
        return $perms;
    }

    function userHasRole($roleID)
    {
        foreach($this->userRoles as $k => $v)
        {
            if (floatval($v) === floatval($roleID))
            {
                return true;
            }
        }
        return false;
    }

    function hasPermission($permKey)
    {
        $permKey = strtolower($permKey);
        if (array_key_exists($permKey,$this->perms))
        {
            if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true)
            {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getUsername($userID)
    {
        $strSQL = "SELECT `email` FROM `Discipulo` WHERE `id` = " . floatval($userID) . " LIMIT 1";
        $data = mysql_query($strSQL);
        $row = mysql_fetch_array($data);
        return $row[0];
    }
}
