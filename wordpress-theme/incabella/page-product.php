<?php
/**
 * Product (originally product.html).
 */

get_header();
?>

<main>
  <div class="wrap">
    <p class="crumbs"><a href="hire.html">Hire collection</a> / <a href="hire.html" data-crumb-group>…</a></p>
    <div class="product" data-product></div>
  </div>

  <section class="section section--mist">
    <div class="wrap">
      <div class="section-head reveal"><p class="script">You might also like</p></div>
      <div class="grid" data-related></div>
    </div>
  </section>
</main>

<?php
ob_start();
?>
<script>
  (function () {
    var box = document.querySelector("[data-product]");

    function render() {
      var slug = location.hash.slice(1);
      var p = IB.product(slug) || IB.products()[0];
      var g = window.INCABELLA_GROUPS.filter(function (x) { return x.id === p.group; })[0];
      document.title = p.name + " · IncaBella";
      var crumb = document.querySelector("[data-crumb-group]");
      crumb.textContent = g.name; crumb.href = "hire.html#" + g.id;

      // Blank line = new paragraph; "- " lines = bullet list; a short line before a list = subheading.
      var paras = p.description.split(/\n\s*\n/).map(function (block) {
        var lines = block.split("\n"), html = "", items = [];
        function flush() { if (items.length) { html += "<ul>" + items.join("") + "</ul>"; items = []; } }
        lines.forEach(function (line, i) {
          if (/^- /.test(line)) { items.push("<li>" + IB.esc(line.slice(2)) + "</li>"); return; }
          flush();
          var heading = lines.length > 1 && i === 0 && line.length < 40 && /^- /.test(lines[1] || "");
          html += heading ? '<p class="sub">' + IB.esc(line) + "</p>" : "<p>" + IB.esc(line) + "</p>";
        });
        flush();
        return html;
      }).join("");
      box.innerHTML =
        '<div class="product-gallery"><img class="main" src="' + IB.img(p) + '" alt="' + IB.esc(p.name) + '">' +
        (p.images.length > 1 ? '<div class="thumbs">' + p.images.map(function (f, i) {
          return '<button type="button" data-i="' + i + '"' + (i ? "" : ' aria-current="true"') + '><img src="' + IB.img(p, i) + '" alt="Photo ' + (i + 1) + '"></button>';
        }).join("") + "</div>" : "") + "</div>" +
        '<div class="product-info"><h1>' + IB.esc(p.name) + "</h1>" +
        '<p class="price">' + IB.priceLabel(p) + "</p>" +
        '<div class="desc">' + paras + "</div>" +
        '<div class="qty-row"><div class="qty"><button type="button" data-step="-1" aria-label="One fewer">−</button>' +
        '<input id="qty" type="number" inputmode="numeric" min="1" max="999" value="1" aria-label="Quantity">' +
        '<button type="button" data-step="1" aria-label="One more">+</button></div>' +
        '<button class="add-btn" type="button" data-add="' + p.slug + '" data-qty-from="#qty">Add to my list</button></div>' +
        '<p class="note">Adding to your list doesn\'t book anything. When you send your list, Lucy will confirm availability for your date and send a quote.</p>' +
        '<p><a class="text-link" href="list.html">View my list</a></p></div>';

      box.querySelectorAll(".thumbs button").forEach(function (b) {
        b.addEventListener("click", function () {
          box.querySelector(".main").src = IB.img(p, +b.dataset.i);
          box.querySelectorAll(".thumbs button").forEach(function (x) { x.removeAttribute("aria-current"); });
          b.setAttribute("aria-current", "true");
        });
      });
      box.querySelectorAll("[data-step]").forEach(function (b) {
        b.addEventListener("click", function () {
          var q = document.getElementById("qty");
          q.value = Math.max(1, Math.min(999, (parseInt(q.value, 10) || 1) + +b.dataset.step));
        });
      });

      var related = IB.products().filter(function (x) { return x.group === p.group && x.slug !== p.slug; }).slice(0, 4);
      document.querySelector("[data-related]").innerHTML = related.map(function (r) {
        return '<article class="card"><a class="card-link" href="product.html#' + r.slug + '"><div class="ph"><img src="' + IB.img(r) + '" alt="' + IB.esc(r.name) + '" loading="lazy"></div>' +
          "<h3>" + IB.esc(r.name) + '</h3></a><p class="price">' + IB.priceLabel(r) + '</p><button class="add-btn" type="button" data-add="' + r.slug + '">Add to my list</button></article>';
      }).join("");
      document.dispatchEvent(new CustomEvent("listchange"));
      IB.markLoaded(document);
    }

    render();
    window.addEventListener("hashchange", function () { render(); window.scrollTo(0, 0); });
  })();
</script>
<?php
get_footer( null, array( 'script' => ob_get_clean() ) );
