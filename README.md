# IncaBella

New website for Incabella Floristry & Wedding Hire, the sister company to Sopley Mill.
It's a plain HTML/CSS/JavaScript site with no build step: open `index.html` in a browser.

## Pages

| File | Page |
|---|---|
| `index.html` | Home |
| `about.html` | About Lucy and Sopley Mill |
| `flowers.html` | Flowers (enquiry-led, no prices) |
| `hire.html` | Hire collection, grouped and filterable |
| `product.html` | One hire item (`product.html#firepit` etc.) |
| `gallery.html` | Photo gallery |
| `contact.html` | Contact form and details |
| `list.html` | "My list": chosen items, estimated total and the quote request form |

## Changing products and prices

Everything about the hire items lives in **`js/products.js`**: name, price, group, photos and description.
Change a price by editing its `price` number. Add a product by copying an existing entry.

New photos go in `assets/img/products/`. To make web-sized copies from the originals in
`incabella-images/`, run `python3 tools/prepare_images.py` (needs ImageMagick).

## Not done yet

- **Form emails.** The list request and contact forms show a confirmation but don't send anything yet.
  Connect them to a form service (e.g. Netlify Forms or Formspree) to email Lucy@incabella.co.uk.
- **Hosting.** Move `incabella.co.uk` to a static host (e.g. Netlify or Cloudflare Pages).

## WordPress theme

`wordpress-theme/incabella/` is the same site as an installable WordPress theme (no plugins needed).
Build the zip from the `wordpress-theme` folder:

```
cd wordpress-theme && zip -qr ../dist/incabella-theme.zip incabella
```

- Hire items, prices and photos: the **Hire items** menu in the dashboard.
- Page photos, contact details and reviews: **Appearance → Customise → IncaBella**.
- Enquiry form: emails Lucy and saves a copy under **Enquiries**.
- Lucy's how-to guide: `wordpress-theme/docs/lucy-guide.html` (printed to PDF).
