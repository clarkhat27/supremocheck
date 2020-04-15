<?php session_start();
if(isset($_POST['Submit'])){
$logins = array('supremo' => 'supremo');

$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

if (isset($logins[$Password])){
$_SESSION['UserData']['Password']=$logins[$Password];
header("location:index.php");
exit;
} else {
$msg="<span style='color:red'>Invalid Password</span>";
}
}
?>
<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <td align="right">Password</td>
      <td><input name="Password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td> </td>
      <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
    </tr>
  </table>
</form>