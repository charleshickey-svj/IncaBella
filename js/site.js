/* Inca Bella: shared header, footer, "My list" and page effects. */
(function () {
  "use strict";

  var CONTACT = {
    email: "Lucy@incabella.co.uk",
    phone: "07946 471707",
    phoneHref: "+447946471707",
    address: ["Sopley Mill, Mill Lane", "Nr Christchurch", "Dorset, BH23 7AU"],
    sopley: "https://sopleymill.co.uk/"
  };

  var NAV = [
    { href: "index.html", label: "Home", page: "home" },
    { href: "about.html", label: "About", page: "about" },
    { href: "flowers.html", label: "Flowers", page: "flowers" },
    { href: "hire.html", label: "Hire", page: "hire" },
    { href: "gallery.html", label: "Gallery", page: "gallery" },
    { href: "contact.html", label: "Contact", page: "contact" }
  ];

  /* Flower mark: eight petals set like the spokes of Sopley Mill's wheel. */
  function logoMark(extraClass) {
    var petals = "", dots = "";
    for (var i = 0; i < 8; i++) {
      petals += '<g transform="rotate(' + i * 45 + ' 32 32)"><ellipse class="petal" style="animation-delay:' + (i * 0.07).toFixed(2) + 's" cx="32" cy="16.5" rx="5.2" ry="11" fill="currentColor" opacity="' + (i % 2 ? 0.72 : 1) + '"/></g>';
      var a = (i * 45 + 22.5) * Math.PI / 180;
      dots += '<circle cx="' + (32 + 27 * Math.sin(a)).toFixed(2) + '" cy="' + (32 - 27 * Math.cos(a)).toFixed(2) + '" r="2" fill="currentColor"/>';
    }
    return '<svg class="brand-mark ' + (extraClass || "") + '" viewBox="0 0 64 64" aria-hidden="true">' +
      '<g class="petals">' + petals + dots + '</g>' +
      '<circle cx="32" cy="32" r="6.5" fill="#fff"/><circle cx="32" cy="32" r="4.2" fill="var(--rose)"/></svg>';
  }

  var ARROW = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M4 12 12 4M5.5 4H12v6.5" fill="none" stroke="currentColor" stroke-width="1.4"/></svg>';

  /* ---------- My list (kept in this browser only) ---------- */
  var KEY = "incabella-list";
  var memory = {};
  function read() {
    try { var raw = localStorage.getItem(KEY); return raw ? JSON.parse(raw) : {}; }
    catch (e) { return memory; }
  }
  function write(list) {
    memory = list;
    try { localStorage.setItem(KEY, JSON.stringify(list)); } catch (e) { /* private mode: keep in memory */ }
    document.dispatchEvent(new CustomEvent("listchange"));
  }
  var List = {
    items: function () { return read(); },
    qty: function (slug) { return read()[slug] || 0; },
    set: function (slug, qty) {
      var l = read();
      qty = Math.max(0, Math.min(999, Math.round(qty) || 0));
      if (qty) l[slug] = qty; else delete l[slug];
      write(l);
    },
    add: function (slug, n) { List.set(slug, List.qty(slug) + (n || 1)); },
    clear: function () { write({}); },
    count: function () { var l = read(), c = 0; for (var k in l) c += l[k]; return c; }
  };

  function products() { return window.INCABELLA_PRODUCTS || []; }
  function product(slug) { return products().filter(function (p) { return p.slug === slug; })[0]; }
  function money(n) {
    return "£" + n.toLocaleString("en-GB", { minimumFractionDigits: n % 1 ? 2 : 0, maximumFractionDigits: 2 });
  }
  function img(p, i) { return "assets/img/products/" + p.images[i || 0]; }
  function esc(s) { return String(s).replace(/[&<>"]/g, function (c) { return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;" }[c]; }); }

  /* ---------- header & footer ---------- */
  function listButton(compact) {
    var n = List.count();
    return '<a class="list-btn' + (compact ? " list-btn--compact" : "") + '" href="list.html"' + (document.body.dataset.page === "list" ? ' aria-current="page"' : "") + '>' +
      '<span class="label">My list</span><span class="list-count" data-count="' + n + '" aria-label="' + n + ' items">' + n + '</span></a>';
  }

  function renderHeader() {
    var el = document.querySelector("[data-site-header]");
    if (!el) return;
    var page = document.body.dataset.page;
    var links = NAV.map(function (n) {
      return '<li><a href="' + n.href + '"' + (n.page === page ? ' aria-current="page"' : "") + ">" + n.label + "</a></li>";
    }).join("");
    el.outerHTML =
      '<div class="topbar"></div>' +
      '<header class="site-header"><div class="header-inner">' +
      '<a class="brand" href="index.html" aria-label="Inca Bella home">' + logoMark("bloom") +
      '<span class="brand-text"><span class="brand-name">IncaBella</span><span class="brand-sub">Floristry &amp; Wedding Hire</span></span></a>' +
      '<nav class="nav" id="site-nav" aria-label="Main"><ul class="nav-links">' + links + "</ul>" + listButton(false) + "</nav>" +
      '<div class="header-actions">' + listButton(true) +
      '<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav"><span></span><span></span><span></span><span class="visually-hidden">Menu</span></button></div>' +
      "</div></header>";

    var toggle = document.querySelector(".menu-toggle");
    toggle.addEventListener("click", function () {
      var open = document.body.classList.toggle("menu-open");
      toggle.setAttribute("aria-expanded", open);
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && document.body.classList.contains("menu-open")) { toggle.click(); toggle.focus(); }
    });
    var header = document.querySelector(".site-header");
    var onScroll = function () { header.classList.toggle("is-scrolled", window.scrollY > 8); };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  function renderFooter() {
    var el = document.querySelector("[data-site-footer]");
    if (!el) return;
    el.outerHTML =
      '<footer class="site-footer"><div class="wrap"><div class="footer-top">' +
      '<div class="footer-brand"><a class="brand" href="index.html" aria-label="Inca Bella home">' + logoMark("") +
      '<span class="brand-text"><span class="brand-name">IncaBella</span><span class="brand-sub">Floristry &amp; Wedding Hire</span></span></a>' +
      "<p>Flowers, lanterns and finishing touches for weddings at Sopley Mill, set up by Lucy before you arrive.</p></div>" +
      "<div><h3>Address</h3><address>" + CONTACT.address.join("<br>") + "</address></div>" +
      '<div><h3>Contact</h3><ul><li><a href="mailto:' + CONTACT.email + '">' + CONTACT.email + '</a></li><li><a href="tel:' + CONTACT.phoneHref + '">' + CONTACT.phone + "</a></li></ul></div>" +
      '<div><h3>Explore</h3><ul><li><a href="hire.html">Hire collection</a></li><li><a href="flowers.html">Flowers</a></li><li><a href="list.html">My list</a></li><li><a href="' + CONTACT.sopley + '" target="_blank" rel="noopener">Sopley Mill</a></li></ul></div>' +
      '</div><div class="footer-bottom"><span>© ' + new Date().getFullYear() + ' Incabella Floristry &amp; Wedding Hire</span><span>Sister company to Sopley Mill</span></div></div></footer>';
  }

  function refreshCounts() {
    var n = List.count();
    document.querySelectorAll(".list-count").forEach(function (c) {
      if (c.textContent !== String(n)) { c.classList.remove("bump"); void c.offsetWidth; c.classList.add("bump"); }
      c.textContent = n; c.dataset.count = n; c.setAttribute("aria-label", n + " items");
    });
    document.querySelectorAll("[data-add]").forEach(syncAddButton);
  }

  /* ---------- "Add to my list" buttons ---------- */
  var PLUS = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5"/></svg>';
  var TICK = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="m3 8.5 3 3 7-7" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>';
  function syncAddButton(btn) {
    var q = List.qty(btn.dataset.add);
    btn.classList.toggle("is-added", q > 0);
    btn.innerHTML = q > 0 ? TICK + "In my list" + (q > 1 ? " (" + q + ")" : "") : PLUS + "Add to my list";
  }
  document.addEventListener("click", function (e) {
    var btn = e.target.closest("[data-add]");
    if (!btn) return;
    e.preventDefault();
    var qtyInput = btn.dataset.qtyFrom && document.querySelector(btn.dataset.qtyFrom);
    List.add(btn.dataset.add, qtyInput ? parseInt(qtyInput.value, 10) || 1 : 1);
  });

  /* ---------- slow fade on scroll ---------- */
  function setupFades() {
    var els = document.querySelectorAll(".reveal");
    if (!("IntersectionObserver" in window) || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add("is-in"); io.unobserve(en.target); }
      });
    }, { rootMargin: "0px 0px -8% 0px" });
    els.forEach(function (el) {
      // Only hide what starts below the first screen, so the page is complete at rest.
      if (el.getBoundingClientRect().top > window.innerHeight * 0.92) { el.classList.add("fade"); io.observe(el); }
    });
  }

  /* ---------- cursor dot (mouse only) ---------- */
  function setupCursor() {
    if (!window.matchMedia("(hover: hover) and (pointer: fine)").matches) return;
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
    var dot = document.createElement("div");
    dot.className = "cursor-dot";
    document.body.appendChild(dot);
    var x = 0, y = 0, tx = 0, ty = 0;
    document.addEventListener("mousemove", function (e) {
      tx = e.clientX; ty = e.clientY; dot.classList.add("is-on");
      dot.classList.toggle("is-link", !!e.target.closest("a, button, input, textarea, select, label"));
    });
    document.addEventListener("mouseleave", function () { dot.classList.remove("is-on"); });
    (function loop() {
      x += (tx - x) * 0.22; y += (ty - y) * 0.22;
      dot.style.transform = "translate(" + x + "px," + y + "px)";
      requestAnimationFrame(loop);
    })();
  }

  window.IB = { List: List, products: products, product: product, money: money, img: img, esc: esc, contact: CONTACT, arrow: ARROW, logoMark: logoMark };

  renderHeader();
  renderFooter();
  document.addEventListener("listchange", refreshCounts);
  window.addEventListener("storage", refreshCounts);
  document.addEventListener("DOMContentLoaded", function () {
    refreshCounts();
    setupFades();
    setupCursor();
  });
})();
