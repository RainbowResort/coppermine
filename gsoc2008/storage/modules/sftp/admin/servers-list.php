<?PHP

if (!GALLERY_ADMIN_MODE) {
  cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

require("storage/modules/sftp/config.inc.php");

starttable('100%', $lang_admin_php['storage_servers_admin_sftp_servers'], 1);

$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_SFTP_SERVERS']}");
if (mysql_num_rows($result) > 0)
{
	while($row = mysql_fetch_assoc($result))
	{
		print "
			<tr>
				<td class=\"tableb\">
				  ".htmlspecialchars($row['hostname'])." - 
				  ".htmlspecialchars($row['username'])." - 
				  ".htmlspecialchars($row['prefix_url'])." - 
				  <a href='admin-storage-servers.php?module=".$module."&action=addeditdelete&id=".$row['id']."'>".$lang_admin_php['storage_servers_edit']."</a>
				  <a href='admin-storage-servers.php?module=".$module."&action=addeditdelete&id=".$row['id']."&delete=1'>".$lang_admin_php['storage_servers_delete']."</a>
				</td>
			</tr>
		";
		
	}
}else
{
	print "
    <tr>
        <td class=\"tableb\">
          ".$lang_admin_php['storage_servers_none_defined']."
        </td>
    </tr>
	";
}

print "
    <tr>
        <td class=\"tableb\">
          <a href='admin-storage-servers.php?module=sftp&action=add_edit_delete'>".$lang_admin_php['storage_servers_add_new']."</a>
        </td>
    </tr>
";

endtable();
print '<br />'.$lineBreak;

?>
