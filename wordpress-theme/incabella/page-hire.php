<?php
/**
 * Hire (originally hire.html).
 */

get_header();
?>

<main>
  <section class="page-hero">
    <img src="<?php echo esc_url( ib_photo_url( 'hire' ) ); ?>" alt="<?php echo esc_attr( ib_photo_alt( 'hire' ) ); ?>">
    <div class="wrap inner">
      <p class="script">The hire collection</p>
      <h1>Everything to style your day</h1>
    </div>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <p class="lede">Add anything you like to your list, then send it to Lucy. She'll confirm what's available for your date and send you a quote. Each price shows what it covers, such as per table or per 10.</p>
      </div>
      <div class="filters" role="group" aria-label="Show a category" data-filters></div>
      <div data-groups></div>
    </div>
  </section>
</main>

<?php
ob_start();
?>
<script>
  (function () {
    var groups = window.INCABELLA_GROUPS;
    var filters = document.querySelector("[data-filters]");
    var holder = document.querySelector("[data-groups]");

    filters.innerHTML = '<button class="chip" type="button" data-filter="all" aria-pressed="true">All</button>' +
      groups.map(function (g) { return '<button class="chip" type="button" data-filter="' + g.id + '" aria-pressed="false">' + g.name + "</button>"; }).join("");

    holder.innerHTML = groups.map(function (g) {
      var items = IB.products().filter(function (p) { return p.group === g.id; });
      return '<section class="group" id="' + g.id + '" data-group="' + g.id + '">' +
        '<div class="group-head reveal"><h2>' + g.name + "</h2><p>" + g.blurb + "</p></div>" +
        '<div class="grid' + (g.id === "packages" ? " grid--packages" : "") + '">' +
        items.map(function (p) {
          return '<article class="card reveal"><a class="card-link" href="product.html#' + p.slug + '">' +
            '<div class="ph"><img src="' + IB.img(p) + '" alt="' + IB.esc(p.name) + '" loading="lazy"></div>' +
            "<h3>" + IB.esc(p.name) + "</h3></a>" +
            '<p class="price">' + IB.priceLabel(p) + "</p>" +
            '<button class="add-btn" type="button" data-add="' + p.slug + '">Add to my list</button></article>';
        }).join("") + "</div></section>";
    }).join("");

    function show(id) {
      filters.querySelectorAll(".chip").forEach(function (c) { c.setAttribute("aria-pressed", c.dataset.filter === id); });
      holder.querySelectorAll("[data-group]").forEach(function (s) { s.hidden = id !== "all" && s.dataset.group !== id; });
      holder.querySelectorAll(".fade").forEach(function (el) { el.classList.add("is-in"); });
    }
    filters.addEventListener("click", function (e) {
      var chip = e.target.closest("[data-filter]");
      if (chip) show(chip.dataset.filter);
    });
    var start = location.hash.slice(1);
    if (groups.some(function (g) { return g.id === start; })) show(start);
  })();
</script>
<?php
get_footer( null, array( 'script' => ob_get_clean() ) );
