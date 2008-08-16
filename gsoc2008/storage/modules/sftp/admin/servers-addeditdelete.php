<?PHP

if (!GALLERY_ADMIN_MODE) {
  cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

require("storage/modules/sftp/config.inc.php");

starttable('100%', $lang_admin_php['storage_servers_manage_sftp_server'], 1);

$show_form = false;

?>

    <tr>
        <td class="tableb">
			<form method='post' action='admin-storage-servers.php?module=<?PHP echo $module; ?>&action=<?PHP echo $action; ?><?PHP if($superCage->get->testInt('id')) echo "&id=".$superCage->get->getInt('id'); ?>'>
			<table>

				<tr>
					<td class="tableb" colspan='2'>
						<a href="admin-storage-servers.php?module=<?PHP echo $module; ?>"><?PHP echo $lang_admin_php['storage_servers_go_back_server_list']; ?></a>
					</td>
				</tr>

<?PHP

if($superCage->get->testInt('id')) // editing or deleting
{
	$id = (int)$superCage->get->getInt('id');
	if($superCage->get->testInt('delete')) // deleting
	{
		$show_form = false;
		$sql = "DELETE FROM {$CONFIG['TABLE_SFTP_SERVERS']} WHERE id='".$id."'";
		cpg_db_query($sql);

		echo"
				<tr>
					<td class='tableb' colspan='2'>
						".$lang_admin_php['storage_servers_server_deleted']."
					</td>
				</tr>
		";

	}
	elseif($superCage->post->keyExists('hostname')) // real editing
	{
		$show_form = false;
		$sql = "SELECT * FROM {$CONFIG['TABLE_SFTP_SERVERS']} WHERE id='".mysql_escape_string($id)."'";		
		$allowed_post_elements = array("hostname", "username", "password", "prefix_url", "root_path", "status");
		
		$sql = "";

		foreach($allowed_post_elements as $allowed_post_element)
		{
			if($superCage->post->keyExists($allowed_post_element))
			{
				if(strlen($sql)>0)
					$sql.=", ";
				else
					$sql.=" SET ";
				$sql.=" ".$allowed_post_element."='".mysql_escape_string($superCage->post->getRaw($allowed_post_element))."'";
			}
		}

		if(strlen($sql)>0)
		{
			$sql = "UPDATE {$CONFIG['TABLE_SFTP_SERVERS']}".$sql. " WHERE id='".$id."'";
			cpg_db_query($sql);

			echo"
					<tr>
						<td class='tableb' colspan='2'>
							".$lang_admin_php['storage_servers_server_edited']."
						</td>
					</tr>
			";

		}

	}
	else // show form for editing
	{
		$show_form = true;

		$sql = "SELECT * FROM {$CONFIG['TABLE_SFTP_SERVERS']} WHERE id='".mysql_escape_string($id)."'";
		cpg_db_query($sql);
		$result = cpg_db_query($sql);
		$form_fields = mysql_fetch_assoc($result);
	}
}
else
{
	if($superCage->post->keyExists('hostname')) // if form is submitted, try to send to mysql
	{
		$show_form = false;
		$form_fields['hostname'] = htmlspecialchars($superCage->post->getRaw('hostname'));
		$form_fields['username'] = htmlspecialchars($superCage->post->getRaw('username'));
		$form_fields['password'] = htmlspecialchars($superCage->post->getRaw('password'));
		$form_fields['prefix_url'] = htmlspecialchars($superCage->post->getRaw('prefix_url'));
		$form_fields['root_path'] = htmlspecialchars($superCage->post->getRaw('root_path'));
		$form_fields['status'] = htmlspecialchars($superCage->post->getRaw('status'));

		$sql = "INSERT INTO {$CONFIG['TABLE_SFTP_SERVERS']} SET quota='536870912000', used='0', free='536870912000', users='0'";

		foreach($form_fields as $id => $value)
			$sql.=", ".mysql_escape_string($id)."='".mysql_escape_string($value)."'";

		cpg_db_query($sql);

		echo"
				<tr>
					<td class='tableb' colspan='2'>
						".$lang_admin_php['storage_servers_the_account']." <b>".$form_fields['username']."@".$form_fields['hostname']."</b> ".$lang_admin_php['storage_servers_was_added'].".
					</td>
				</tr>
		";

	}
	else // just show the form
		$show_form = true;
}

//$id = (int)$superCage->get->getInt('id');
//$hostname = $superCage->post->getRaw('hostname');
//if($id!=0 || isset($hostname))

if($show_form)
{

?>

				<tr>
					<td class="tableb">
					  <?PHP echo $lang_admin_php['storage_servers_hostname']; ?>
					</td>
					<td class="tableb">
					  <input type="text" name="hostname" size="50" value="<?PHP if(isset($form_fields)) {echo $form_fields['hostname'];} ?>">
					</td>
				</tr>

				<tr>
					<td class="tableb">
					  <?PHP echo $lang_admin_php['storage_servers_username']; ?>
					</td>
					<td class="tableb">
					  <input type="text" name="username" size="50" value="<?PHP if(isset($form_fields)) {echo $form_fields['username'];} ?>">
					</td>
				</tr>

				<tr>
					<td class="tableb">
					  <?PHP echo $lang_admin_php['storage_servers_password']; ?>
					</td>
					<td class="tableb">
					  <input type="text" name="password" size="50" value="<?PHP if(isset($form_fields)) {echo $form_fields['password'];} ?>">
					</td>
				</tr>

				<tr>
					<td class="tableb">
					  <?PHP echo $lang_admin_php['storage_servers_prefix_url']; ?>
					</td>
					<td class="tableb">
					  <input type="text" name="prefix_url" size="50" value="<?PHP if(isset($form_fields)) {echo $form_fields['prefix_url'];} ?>">
					</td>
				</tr>

				<tr>
					<td class="tableb">
					  <?PHP echo $lang_admin_php['storage_servers_root_path']; ?>
					</td>
					<td class="tableb">
					  <input type="text" name="root_path" size="50" value="<?PHP if(isset($form_fields)) {echo $form_fields['root_path'];} ?>">
					</td>
				</tr>

				<tr>
					<td class="tableb">
					  <?PHP echo $lang_admin_php['storage_servers_status']; ?>
					</td>
					<td class="tableb">
					  <select name='status'>
						<?PHP
						$status_options['active'] = "Active";
						$status_options['inactive'] = "Inactive";

						foreach($status_options as $value => $name)
						{
							echo "<option value='".$value."'";
							if(isset($form_fields) && $form_fields['status']==$value)
								echo " selected";
							echo ">".$name."</option>\n";
						}

						?>
					  </select>
					</td>
				</tr>

				<tr>
					<td class="tableb">
					  <input type='submit' value='<?PHP

							if($superCage->get->testInt('id'))
								echo $lang_admin_php['storage_servers_edit_server'];
							else
								echo $lang_admin_php['storage_servers_add_new_server'];

						?>'>
					</td>
					<td class="tableb">
						&nbsp;
					</td>
				</tr>
	
<?PHP

}

?>
			</table>
			</form>
        </td>
    </tr>

<?PHP

endtable();
print '<br />'.$lineBreak;

?>
