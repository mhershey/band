<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CC9999">
<tr>
<form name="form1" method="post" action="checklogin.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CC9999">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="text" id="mypassword"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

<h2>Member Login</h2>
<form method = 'post' action='account.php'>
<h3><b>Username <input type='text' maxlength='16' name='user' value='<?php echo (isset($_POST['user'])?$_POST['user']:'');?>' /><br /> Password  <input type='password' maxlength='16' name='pass' value='<?php echo (isset($_POST['pass'])?$_POST['pass']:'');?>' /><br /> 
<input type='submit' value='Login' /> </b></h3>
</form>

<h2>Member Login</h2>

<form method = 'post' action='account.php'>$error
<h3><b>Username <input type='text' maxlength='16' name='user' value='' /><br /> Password  <input type='password' maxlength='16' name='' value='' /><br /> 
<input type='submit' value='Login' /> </b></h3>
</form>
