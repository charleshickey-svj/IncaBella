=== IncaBella ===
Requires at least: 5.9
Tested up to: 6.5
Requires PHP: 7.4
License: GPLv2 or later

The IncaBella website (flowers and wedding hire at Sopley Mill) as a WordPress theme.

== How it is built ==

The front end is the original static site, unchanged:

* assets/css/style.css   the site's stylesheet
* assets/js/site.js      header, footer, My list, scroll fades, page fade, cursor dot
* assets/js/products.js  the hire items and their default prices, descriptions and photos
* assets/img/            the site's photos

Each page template holds that page's original markup and script:

* front-page.php    index.html (home)
* page-about.php    about.html
* page-flowers.php  flowers.html
* page-hire.php     hire.html
* page-product.php  product.html (one hire item, e.g. product.html#firepit)
* page-gallery.php  gallery.html
* page-contact.php  contact.html
* page-list.php     list.html

The pages keep their original addresses (yoursite.co.uk/about.html and so on), so links, the
page fade and the "current page" underline work exactly as before. No WordPress pages need to
be created. On activation the theme switches Settings > Permalinks to "Post name" if it was
still on "Plain", because the .html addresses need it.

WordPress's own front-end extras (emoji script, block styles, global styles, admin bar,
speculative preloading) are left out so the pages render exactly like the original site.

== Editing ==

Dashboard > IncaBella:

* Hire prices & photos: price, description and photos for each hire item.
* Hero photos: the four home page slideshow photos and the top photos on About, Flowers and Hire.
* Enquiry email: where list and contact form enquiries are sent.
* Enquiries: a copy of every enquiry.

Changes are stored in the options ib_product_edits and ib_photo_edits and applied on top of
products.js in the page, so anything not edited stays exactly as it was. Uploaded photos are
served at the same sizes as the site's own photos (1200px for hire items, 2000px for hero photos).

== Notes ==

* The "Send my list" and contact forms post to admin-ajax.php (action ib_enquiry). Each enquiry
  is emailed with wp_mail() to the address under IncaBella > Enquiry email (default
  Lucy@incabella.co.uk), with Reply-To set to the sender, and saved as a private "Enquiries"
  post. Prices in the email come from the server, including dashboard changes. For reliable
  delivery, send WordPress mail through SMTP (e.g. the WP Mail SMTP plugin).
* Don't let a caching or speed plugin combine, defer or delay the theme's JavaScript; the
  scripts must run in their original order at the end of the page.
