# IncaBella

## WordPress theme

- **Try it in WordPress Playground (nothing to install):** open
  https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/charleshickey-svj/IncaBella/refs/heads/claude/laughing-wozniak-0w2n9m/wordpress-theme/playground-blueprint.json
  It's a temporary test site that disappears when you close the tab. You're logged in as admin, so the IncaBella menu is in the dashboard at /wp-admin.
- **Install:** `dist/incabella-theme.zip`. In WordPress go to Appearance → Themes → Add New → Upload Theme, choose the zip, then Activate.
  If the host's upload limit is smaller than the zip (about 31 MB), unzip it and copy the `incabella` folder into `wp-content/themes/` with FTP or the host's file manager instead.
- **Source:** `wordpress-theme/incabella/`. It's the static site (from the `claude/kind-cori-175nui` branch) with its CSS, JavaScript and photos unchanged. See `wordpress-theme/incabella/readme.txt` for how it's put together.
- **Changing prices and photos:** `wordpress-theme/HOW-TO-CHANGE-PRICES-AND-PHOTOS.md` is the plain-English guide.

Rebuild the zip after changing the theme:

```
cd wordpress-theme && zip -qr -X ../dist/incabella-theme.zip incabella
```
