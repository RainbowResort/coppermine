API Commands and Parameters

/* Command: login
 * Checks the username and password of a user. Returns a session key along with user data on success. 
 * @ username	The username of the user logging in
 * @ password	The corresponding password
 */

/* Command: logout
 * Checks the session key and unsets the session key if authenticated.
 * @ username	The username of the user logging out
 * @ sessionkey	The current session key for this user	
 */


/* Command: showusers
 * Admin specific command to list all users in the system
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 */

/* Command: register
 * Allows a user to register
 * @ username	The requested username
 * @ password	The password for the new account
 * @ email		Email address of the new user
 * @ profile[]	The six profile admin-defined parameters, optional for register
 */

/* Command: modifyprofile
 * Allows a user to modify her profile
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ password	A new password if changing password, blank otherwise
 * @ email		The new email address
 * @ profile[]	The six profile admin-defined parameters
 */

/* Command: activate
 * Allows a user to activate her account
 * @ username	The username for the account being activated
 * @ act_key	The activation key that was emailed to the user
 */

/* Command: reactivate
 * Resends the activation email to a user at the email address provided during
 * registration. Asks for email address as a security check.
 * @ username	The username of the account to be activated
 * @ email		The email address provided during registration
 */

/* Command: forgotpassword
 * Sends an email to the user to confirm if she requested a new password. The
 * email contains a password key required for generating new password.
 * @ username	The username for the account with forgotten password
 * @ email		The email address associated with the account
 */

/* Command: generatepassword
 * Generates a new password for the user. Requires her to use the password key
 * contained in the email sent by forgotpassword.
 * @ username	The username of the account with forgotten password
 * @ pass_key	The password key included in the forgot password email
 */

/* Command: adduser
 * Admin specific command that allows an admin to add a user to the system. The user is by default
 * added to the group of "Registered" users.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	Username for the new user 
 * @ password		Password for the new user
 * @ email			Email address of the new user
 */

/* Command: removeuser
 * Admin specific command allowing her to remove a user from the system
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The username of the user being removed
 */

/* Command: updateuser
 * Admin specific command allowing her to update the basic information for any user
 * Admin specific command allowing her to remove a user from the system
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The username of the account being updated
 * @ password		A new password for this account, if the password is being changed. Blank otherwise.	
 * @ email			The email address for this account
 * @ active			The activation condition of this account
 */

/* Command: showgroups
 * Admin specific command to list all groups in the system
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 */

/* Command: addgroup
 * Admin specific command to add a group in the system
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 * @ groupname	The name of the new group
 * @ admin		Boolean value of the "admin" property of the group
 */

/* Command: updategroup
 * Admin specific command to update an existing group
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 * @ groupname	The name of the group to be updated
 * @ admin		Boolean value of the "admin" property of the group
 */

/* Command: removegroup
 * Admin specific command to remove an existing group from the system. Destroys
 * the related entries in userxgroup.
 * @ username	The username of the admin
 * @ sessionkey	The key of the current admin session
 * @ group_id	The integral value of the id of the group to be removed
 */

/* Command: addusertogroup
 * Admin specific command to add an existing user to an existing group
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The id of the user who has to be added to the group
 * @ group_id		The id of the group to which the user has to be added
 */

/* Command: removeuserfromgroup
 * Admin specific command to remove an existing user from an existing group
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ addusername	The id of the user who has to be removed from the group
 * @ group_id		The id of the group from which the user has to be removed
 */

/* Command: getconfig
 * Returns all parameters for application configuration. To see a list of parameters, see
 * the $config variable in the cpgAPIdisplayspecs file.
 * @ no parameters
 */

/* Command: setconfig
 * Admin specific command to set the parameters for application configuration. Only the parameters
 * visible using the getconfig command can be set using this command.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 * @ parametername	The name of the parameter to be set
 */

/* Command: createcategory
 * Command to create a new category (analogously gallery). Can be invoked by both users and admin.
 * However, users must give a non-zero value for the parent category, and the new category
 * is visible only to them. 
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the parent category
 * @ categoryname	The name of the new category
 * @ categorydesc	The description of the new category
 */

/* Command: modifycategory
 * Command to modify an existing category. Can be invoked by both users and admin.
 * However, users can update only the categories they own or their group is responsible for.
 * Admin can modify all categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the category to be modified
 * @ categoryname	(optional) A new name for the category
 * @ categorydesc	(optional) A new description for the category
 * @ categoryparent	(optional) Id for a new parent category for this category
 * @ categorythumb	(optional) Id of the picture which is the thumbnail for this category
 */

/* Command: viewcategory
 * Command to get the recursive view of an existing category (analogously gallery).
 * Can be invoked by both users and admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the required category
 */

/* Command: movecategory
 * Command to change the position of an existing category. Can be invoked by both users and admin.
 * However, users can move only the categories they own or their group is responsible for.
 * Admin can move all categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the category to be moved
 * @ categorypos	The new position of the category
 */

/* Command: removecategory
 * Command to remove an existing category from the system. Can be invoked by both users and admin.
 * However, users can remove only the categories they own or their group is responsible for.
 * Admin can remove all categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the category to be removed
 */

/* Command: showcategories
 * Command to get the recursive view of all categories visible to a user.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 */
   
/* Command: showmycategories
 * Command to get the recursive view of all categories owned by the current user.
 * For administrators, this command does NOT return admin-owned categories.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 */

/* Command: showadmincategories
 * Admin specific command to show the recursive view of all admin-owned categories,
 * i.e. the categories visible to all users.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 */

/* Command: createalbum
 * Command to create a new album. Can be invoked by both users and admin. Users can create
 * albums in only those categories which they own, or for which their groups are responsible.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ categoryid		The id of the parent category
 * @ albumname		The name of the new album
 * @ albumdesc		The description of the new album
 * @ albumkeywords	The keywords describing of the new album
 */

/* Command: modifyalbum
 * Command to modify an existing album. Can be invoked by both users and admin.
 * However, users can update only the albums they own or their group is responsible for.
 * Admin can modify all albums.
 * @ username			The username of the current user
 * @ sessionkey			The sessionkey for the current session of this user
 * @ albumid			The id of the album to be modified
 * @ albumname			(optional) A new name for the album
 * @ albumdesc			(optional) A new description for the album
 * @ albumkeywords		(optional) Keywords describing the album
 * @ albumthumb			(optional) Id of the picture which is the thumbnail for this album
 * @ albumpassword		(optional) Password required for a non-owner to access the album
 * @ albumpasswordhint	(optional) Hint given to a user to guess the password for the album
 */

/* Command: viewalbum
 * Command to get the view of an existing album along with details on the contained pictures.
 * Can be invoked by both users and admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ albumid		The id of the required album
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: movealbum
 * Command to change the position of an existing album. Can be invoked by both users and admin.
 * However, users can move only the albums they own or their group is responsible for.
 * Admin can move all albums.
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ albumid	The id of the album to be moved
 * @ albumpos	The new position of the album
 */
   
/* Command: removealbum
 * Command to remove an existing album from the system. Can be invoked by both users and admin.
 * However, users can remove only the albums they own or their group is responsible for.
 * Admin can remove all albums.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ albumid		The id of the album to be removed
 */

/* Command: addpicture
 * Command to add a new picture to an existing album. Can be invoked by both users and admin.
 * However, users can only add pictures to albums they own or their group is responsible for.
 * Admin can add pictures anywhere.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ albumsid		The id of the parent album
 * @ pictitle		A title for the picture
 * @ piccaption		A caption for the picture
 * @ pickeywords	Keywords describing the picture
 * @ user1			Value corresponding to system defined user field 1
 * @ user2			Value corresponding to system defined user field 2
 * @ user3			Value corresponding to system defined user field 3
 * @ user4			Value corresponding to system defined user field 4
 * @ filename		(optional) The name of the file being uploaded
 * @ filecontents	(optional) The binary data for the file being uploaded
 * @ _FILE[file]	(optional) The file upload parameter to be passed if using HTML forms
 */

/* Command: getpicture
 * Command to fetch a picture. Can be invoked by both users and admin.
 * However, users can only fetch the pictures they have authorization to see.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture to be fetched
 * @ searchphrase	The value to be put into the hit statistic for this picture, if fetched as the result of a search
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: getpicturedata
 * Command to get the metadata associated with a picture. Also returns the comments of
 * this picture. Can be invoked by both users and admin.
 * However, users can only get the data for pictures they have authorization to see.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose metadata is required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: movepicture
 * Command to change the position of an existing picture. Can be invoked by both users and admin.
 * However, users can move only the pictures they own or their group is responsible for.
 * Admin can move all pictures.
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ pictureid	The id of the picture to be moved
 * @ picturepos	The new position of the picture
 */

/* Command: modifypicture
 * Command to modify the metadata associated with a picture. Can be invoked by both users and admin.
 * However, users can only modify the data for pictures they own or their group is responsible for.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose metadata is required
 * @ pictitle		(optional) A new title for the picture
 * @ piccaption		(optional) A new caption for the picture
 * @ pickeywords	(optional) Keywords describing the picture
 * @ user1			(optional) Value corresponding to system defined user field 1
 * @ user2			(optional) Value corresponding to system defined user field 2
 * @ user3			(optional) Value corresponding to system defined user field 3
 * @ user4			(optional) Value corresponding to system defined user field 4
 */

/* Command: removepicture
 * Command to remove an picture from an album in the system. Can be invoked by both users and admin.
 * However, users can remove only the pictures they own or their group is responsible for.
 * Admin can remove all albums.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture to be removed
 */

/* Command: createthumb
 * Command to create the thumbnail for a picture. Requires GD. Can be invoked by both users and admin.
 * However, users can only create thumbnails for pictures they own or their group is responsible for.
 * Admin can access all pictures.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose metadata is required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: getthumb
 * Command to fetch a thumbnail. Can be invoked by both users and admin.
 * However, users can only fetch the thumbnails they have authorization to see.
 * Admin can access all thumbnails.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose thumbnail is to be fetched
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: createcomment
 * Command to create a new comment. Can be invoked by both users and admin. Users can create
 * comments on any picture that they can see.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture commented
 * @ authorname		(optional) Name of the comment author
 * @ msgbody		The body of the comment
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: approvecomment
 * Command to approve an existing comment. Can be invoked by both picture owner and admin. 
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ msgid		The id of the comment to be approved
 */

/* Command: viewcomment
 * Command to view an existing comment. Can be invoked by both users and admin. Users can view
 * comments on any picture that they can see.
 * @ username	The username of the current user
 * @ sessionkey	The sessionkey for the current session of this user
 * @ msgid		The id of the comment to be viewed
 */

/* Command: getcomments
 * Command to get all info about the approved comments of an existing picture.
   Can be invoked by anyone.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose votes are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: getallcomments
 * Command to get all info about all of the comments of an existing picture.
   Can be invoked only by picture owner, album owner or admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose votes are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: modifycomment
 * Command to modify a comment. Can be invoked by only the user who originally wrote the comment, or admin.
 * 
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ msgid			The id of the comment to be modified
 * @ msgbody		(optional) A new body of the comment
 */

/* Command: removecomment
 * Command to remove an existing comment from the system. Can be invoked by both users and admin.
 * However, users can remove comments that they have written, or from the pictures they own or their group is responsible for.
 * Admin can remove all comments.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ msgid			The id of the comment to be removed
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: createvote
 * Command to create a new vote. Can be invoked by both users and admin. Users can create
 * vote on any picture that they can see.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture voted
 * @ rating			Rating of the vote
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: getvotes
 * Command to get all info about the votes of an existing picture. Can be invoked only by admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose votes are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: removevote
 * Command to remove an existing vote from the system. Can be invoked only by the admin.
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ sid			The id of the vote to be removed
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: gethits
 * Command to get all info about the hits of an existing picture. Can be invoked by both users and admin.
 * However, users can get details only for the pictures they own or their group is responsible for.
 * Admin can access all hits. 
 * @ username		The username of the current user
 * @ sessionkey		The sessionkey for the current session of this user
 * @ pictureid		The id of the picture whose hits are required
 * @ albumpassword	(optional) Password required for a non-owner to access the album
 */

/* Command: phpinfo
 * Admin specific command to print phpinfo. Does not print headers.
 * @ username		The username of the admin
 * @ sessionkey		The key of the current admin session
 */
