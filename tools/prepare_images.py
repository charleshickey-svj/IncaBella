"""Make web-sized copies of the original photos in incabella-images/.

Run from the repo root:  python3 tools/prepare_images.py
Needs ImageMagick (`convert`). Writes assets/img/. After adding photos, list
the new file names in the product's "images" in js/products.js.
"""
import json, os, re, subprocess

SRC = "incabella-images"
OUT = "assets/img"
MAX_PER_PRODUCT = 4

# Products whose photos live in the shared _site folder rather than their own folder.
EXTRA = {
    "table-centre-piece-long-table": ["b05315a3-fc65-4b83-b1a7-61741248a692.jpeg", "d1e581ab-a335-4b30-be13-e33d78466a50.jpeg"],
    "vintagetrunk": ["IMG_5841-e1517832558639.jpg", "IMG_5842-e1517833177128.jpg"],
    "full-set-of-all-8-garden-games": ["IB-sets-of-games-images.jpg", "giant-outdoor-chess.jpg"],
    "rope-lantern": ["IMG_0946.jpeg", "lantern-wrope-hndl-h250x180mm-gls-grey.jpeg"],
    "bunting": ["english-country-bunting.jpg"],
    "moroccanlantern": ["IMG_2614.jpg"],
    "ndiki-lantern": ["0ECE9A96-8D21-45B5-99FA-412A2590D4A7.jpeg", "29329CBA-9791-4C5A-9FA8-1596D8E787E6.jpeg"],
    "small-vintagemilkchurn": ["IMG_4492.jpg"],
    "medium-vintage-milk-churn": ["IMG_9301.jpg"],
    "large-vintage-milk-churn": ["Image.jpg", "IMG_4803.jpg"],
    "hanging-heart-tea-light": ["hanging-heart-tea-light-holder.jpeg"],
    "log-slices": ["IMG_8203-e1549817586734.jpg"],
    "sparkling-silver-t-light-large": ["Sparkling-Silver-T-Light-Holder-IMG_4275.jpeg", "Sparkling-Silver-T-Light-20000102-A_20765.jpeg"],
    "set-of-4-garden-games": ["giant-outdoor-chess.jpg"],
}

# Page photos: output name -> source path under incabella-images/
SITE = {
    "hero": "home/untitled-260-scaled.jpeg",
    "bouquets": "home/EL-ES-APR-2022-0635-scaled.jpg",
    "ceremony": "home/EL-ES-APR-2022-0435-scaled.jpg",
    "tent": "home/IB-lifestyle-bg-1.jpg",
    "games": "home/games.jpg",
    "chess": "home/IMG_3112.jpg",
    "jenga": "garden-games/Giant-Jenga-in-garden.jpg",
    "ladder-toss": "garden-games/IMG_0980.jpeg",
    "arch": "products-list/IMG_3283.jpeg",
    "churn-flowers": "_site/Image.jpg",
    "flowers-jug": "_site/IMG_4803.jpg",
    "long-table": "_site/b05315a3-fc65-4b83-b1a7-61741248a692.jpeg",
    "vase-pink": "_site/IMG_1673.jpg",
    "potted-ladder": "_site/IMG_1158.jpg",
    "crates": "_site/fullsizeoutput_50c2.jpeg",
    "river-window": "_site/IMG_4084.jpeg",
    "centrepiece": "_site/IMG_7095.jpeg",
    "firepit-night": "_site/IMG_1713.jpg",
    "mill-lawn": "_site/giant-outdoor-chess.jpg",
    "potted-aisle": "extra/potted-aisle.webp",
    "jars-on-bench": "extra/flowers/jars-on-bench.webp",
    "potted-violas-thyme": "extra/flowers/potted-violas-thyme.webp",
    "nigella-closeup": "extra/flowers/nigella-closeup.webp",
    "crate-display-mill": "extra/flowers/crate-display-mill.webp",
    "wildflower-bouquet": "extra/flowers/wildflower-bouquet.webp",
    "delphinium-bouquet": "extra/flowers/delphinium-bouquet.webp",
    "white-daisy-vase": "extra/flowers/white-daisy-vase.webp",
    "riverside-bouquet": "extra/flowers/riverside-bouquet.webp",
    "logo": "_site/IncaBella_logo_02.png",
}

THUMB = re.compile(r"-\d+x\d+@2x$")


def base(name):
    stem = os.path.splitext(name)[0]
    stem = THUMB.sub("", stem)
    stem = re.sub(r"-scaled$", "", stem)
    return stem


def pixels(path):
    out = subprocess.run(["identify", "-format", "%w %h", path + "[0]"], capture_output=True, text=True).stdout
    w, h = (int(x) for x in out.split()[:2])
    return w * h


def convert(src, dst, size):
    os.makedirs(os.path.dirname(dst), exist_ok=True)
    subprocess.run(["convert", src + "[0]", "-auto-orient", "-resize", f"{size}x{size}>",
                    "-strip", "-interlace", "Plane", "-quality", "78", dst], check=True)


def main():
    products = json.load(open("products.json", encoding="utf-8"))
    images = {}
    for p in products:
        slug = p["slug"]
        folder = os.path.join(SRC, "product_" + slug)
        sources = []
        if os.path.isdir(folder):
            groups = {}
            for f in sorted(os.listdir(folder)):
                if THUMB.search(os.path.splitext(f)[0]):
                    continue  # WordPress thumbnail; the full image is also here
                groups.setdefault(base(f), []).append(os.path.join(folder, f))
            for files in groups.values():
                sources.append(max(files, key=pixels))
        sources += [os.path.join(SRC, "_site", f) for f in EXTRA.get(slug, [])]
        seen, names = set(), []
        for s in sources:
            if base(os.path.basename(s)) in seen:
                continue
            seen.add(base(os.path.basename(s)))
            n = len(names) + 1
            convert(s, f"{OUT}/products/{slug}-{n}.jpg", 1200)
            names.append(f"assets/img/products/{slug}-{n}.jpg")
            if len(names) == MAX_PER_PRODUCT:
                break
        images[slug] = names
        print(slug, len(names))
    for name, src in SITE.items():
        ext = ".png" if src.endswith(".png") else ".jpg"
        convert(os.path.join(SRC, src), f"{OUT}/site/{name}{ext}", 900 if ext == ".png" else 2000)
    print("Done. Image names per product:", json.dumps(images, indent=1))

if __name__ == "__main__":
    main()
