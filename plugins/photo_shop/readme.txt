Plugin "Shopping cart" (new version) by Stramm

Version 1.4

Announcement thread: http://forum.coppermine-gallery.net/index.php/topic,57206.0.html

demo: http://stramm.st.funpic.org
supported languages atm: english

I’m starting a new thread for the new photo shop version 1.4 to avoid cluttering the old announcement thread even more. Also there are a lot of new features. Therefore I think that’s OK.

This plugin adds a shopping cart to CPG.

    * You can decide to either let users download the purcheased pictures or send the customers prints (!! either or). In addition to that you can let customers bundle a CD that you’ll have to send them.  Different price levels for CDs are supported. Eg. 25 images for 40USD and up to 50 images for 70USD.
    * Free downloads are now supported as well.
    * The next new feature is PayPal IPN support (instant payment notification). Paypal sends back a notification to your server. The shop then knows the customer has paid and (if you opt for downloads) then creates the download folder for the customer and copies his items in that password protected dir. A warning: You should use SSL (https) for the checkout. That way IPN (communication between your server and Paypal) will be more secure as well.
    * The configuration now is all done in the shops config backend (no more gateway.inc.php needed).
    * Basic VAT support.
    * Modpack support (it’s even recommended to use or at least the watermarking mod if you go for the download feature – more later)
    * Oh, and in that version it’s possible to change currency in the config. No more need to edit the lang files.


Now a quick installation guide:

    * Upgrade:

Uninstall the old version using the plugin manager. Don’t opt to remove the database.
Upload all files replacing the old shop files.
In the plugin manager install the new version

    * New install:

Upload the shop directory and everything it contains into your Coppermines plugins folder.
Use the plugin manager to install the plugin.
Have a look at photo_shop/images_to_move/css_changes.txt - that file describes the additional css the shop is using (add it to your themes style.css) . Copy the images in that very directory to the images folder of the theme you’re using.
[/list]

Preparing Coppermine – user data:
For the shop to work it’s necessary that a customer can be identified. As a registered user he’ll get assigned a user id. That’s what the shop uses, too. So if a not logged in customer checks out, he’ll get redirected to a login/ register page (even if disabled in Coppermines config). I recommend to go to the coppermine config -> Custom fields for user profile and add there the user data you need from your customers (street, zip, city etc.).

Preparing the confirmation emails:
You should modify the confirmation email template in the plugins lang file.
You can use placeholders
{USER_NAME}
{SITE_NAME}
{ORDER_ID}
{PRICE}
{ADMIN}
{USER_PROFILE1} - {USER_PROFILE6}

Adding items:
Open  the shop admin (link 'Shop' in admin menu). Now below the shop button you clicked in the table  header click ‘config’. Have a look around, most is self explaining.
However the shop won’t do anything if you do not create items. So click ‘create new item’.
-   Type: Photo, CD or Shipping -> CD to create a CD item, photo (download or ‘for print’ item), shipping to define the global shipping fee
-   Description: The name to use for your item (eg. Download 1280px image or 15x10 photo)
-   Price: OK, everyone should know what that means. As delimiter you have to use . (point). If you set the price to -1 that item will be a free item (0.00). In the lang file is an entry for free items that’ll get added in the dropdown (atm ‘free’) ->  'free' => 'free',
-   Max items on CD: If you have set type to CD, then you can set here some number. The set price is valid up to that number.
-   Shipping: You can override the global shipping (eg. 2USD) with the shipping for a specific item (eg. a framed image 5USD)
-   (max)w/h: If you set here anything other than 0 (zero), then the system will treat that item as a ‘for download item’. It’ll get resized to the defined size and put into the customers download folder. If the set size is bigger than the size of the image you’ve uploaded, then this item won’t be offered to the customer. It’s good to use my watermarking mod or the modpack. Enable watermarking. This will lead in the sytem, to create backup copies of the uploaded images. This backups will get used to create the resized downloads for your customers. Means you have a eg. 2000x1000px image as original on your server. The image you show your customers is a 500x300px watermarked image. If the customer purcheases the image he’ll get the not watermarked image in a bigger version into his download folder. You should protect the orig_ files (backups) from access from the web. For that purpose copy sample.htaccess (in the shops main dir) to the albums dir and rename it to .htaccess (only *nix boxes)

Test the shop:
Try to add some items to your basket. Delete them, increase/ decrease amounts etc.. Just get familiar with it. As guest checkout (only possible when items are in your cart). You'll get to a combined signup/ login form. Enter a new username/ pwd etc. and submit. The user'll get automatically logged in and directed back to the checkout. Here he sees an overview of his items. If he confirms the purchease,  the stuff is added to the SQL and emails sent to the user and you.

Now open the shop admin again (link 'Shop' in admin menu)
You'll see the new order in an overview. Icons in front  meaning (order) viewed, paid, (items) sent (to user). When clicking the order you'll see the detail view. Thumbs of the items etc, pid, price, amounts, cd or photo (and size). In the header user name-> link to profile, email, total price. Just have a look. You can mark the checkboxes and do certain actions (delete, mark paid/ sent, mark unpaid, unsent). If you mark all items of one order as sent or paid then the status changes in the overview for the entire order as well. In detail view click an item to go back to the overview. When order has been processed you can here move the order to the archive.
If it’s a download order, then you’ll see some small buttons in the order overview.
d: crate directory (email sent to user with password – you only have to do that if problems occur)
c: copy files into the download folder (same as above)
x: delete dir (as above, after deleting the down dir, you can test create dir and copy files)
p: paypal ipn log

Per Album Settings:
If you do not want global prices for all items, then you have the possibility to set different prices for each album or to disable the shop for certain albums.
For that check in the shops config the ‘Per Album Settings’. If you set as price 0.00 for an item in the per album settings, the this item won’t show in the dropdown anymore.

More features:
-   If you need the basket buttons elsewhere, then edit template.html and use the placeholder {CART_MENU} where you need it.
-   In the shops admin you can download a zip of all purcheased items of an order (in the order overview)
-    basic support for google checkout (this is just a theoretical implementation. Utterly untested, enable it only for testing purposes and to report back here. I'm from Europe and didn't want to sign up with google using fake info) 
-   invoices (plain text attached to the confirmation email) sent to the user and the admin with the order confirmation
-   -added support for discounts. Default off. There's no gui where you can set the discounts. You'll have to open functions.inc.php in the plugins include dir, scroll down to the bottom and find function calculate_discount. It's pretty easy to do. I've already added there two examples. You just need to uncomment one to enable it. The two examples are:
1. 10% discount if user orders more than 10 pics for print
2. 10% discount if order volume is >= 100 USD
-   MyOrders page. Users can view their orders (history). It's a stripped down version of the shop admin. User of course can't change or delete stuff. If the admin deletes an order, moves it to the archive or marks an order as paid/ sent, then the user will see these changes.  If it’s a download order, the user can create the dir or initiate the copy process for files
-   if you use the modpack you may like that one. If enbabled, minithumbs get used
-   added global shipping/ shipping per item
Now you can set as usual a global shipping (in the shop admin set as type not cd or photo but shipping) and one per item. As with the discount you can easily change (in the code functions.inc.php, function calculate_shipping()) the beahaviour of the shipping calculation. Out of the box it's doing the following. Using the global shipping. If a user buys an item where you specified a different shipping than the global and it's higher than the global then the new (per item) shipping is used. You have nearly unlimited possibilities to customize that.

Don’t forget the backups!!!
