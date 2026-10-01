/* IncaBella: shared header, footer, "My list" and page effects. */
(function () {
  "use strict";

  var CONTACT = {
    email: "Lucy@incabella.co.uk",
    phone: "07946 471707",
    phoneHref: "+447946471707",
    address: ["Sopley Mill, Mill Lane", "Nr Christchurch", "Dorset, BH23 7AU"],
    sopley: "https://sopleymill.co.uk/",
    instagram: "https://www.instagram.com/incabella_/",
    facebook: "https://www.facebook.com/incabellaweddinghire/",
    directions: "https://www.google.com/maps/dir/?api=1&destination=Sopley+Mill%2C+Mill+Lane%2C+Sopley%2C+Christchurch+BH23+7AU"
  };

  var SOCIAL_ICONS = {
    instagram: '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor"/></svg>',
    facebook: '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-7.5h2.6l.4-3h-3V8.6c0-.9.3-1.5 1.5-1.5h1.6V4.4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21z" fill="currentColor"/></svg>'
  };
  function socialLinks() {
    return '<div class="social">' +
      '<a href="' + CONTACT.instagram + '" target="_blank" rel="noopener" aria-label="IncaBella on Instagram">' + SOCIAL_ICONS.instagram + "</a>" +
      '<a href="' + CONTACT.facebook + '" target="_blank" rel="noopener" aria-label="IncaBella on Facebook">' + SOCIAL_ICONS.facebook + "</a></div>";
  }

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
  function priceLabel(p) {
    return (p.from ? "From " : "") + money(p.price) + (p.unit ? ' <span class="unit">' + p.unit + "</span>" : "");
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
      '<a class="brand" href="index.html" aria-label="IncaBella home">' + logoMark("bloom") +
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
      '<div class="footer-brand"><a class="brand" href="index.html" aria-label="IncaBella home">' + logoMark("") +
      '<span class="brand-text"><span class="brand-name">IncaBella</span><span class="brand-sub">Floristry &amp; Wedding Hire</span></span></a>' +
      "<p>Flowers, lanterns and finishing touches for weddings at Sopley Mill, set up by Lucy before you arrive.</p>" + socialLinks() + "</div>" +
      "<div><h3>Address</h3><address>" + CONTACT.address.join("<br>") + "</address></div>" +
      '<div><h3>Contact</h3><ul><li><a href="mailto:' + CONTACT.email + '">' + CONTACT.email + '</a></li><li><a href="tel:' + CONTACT.phoneHref + '">' + CONTACT.phone + "</a></li></ul></div>" +
      '<div><h3>Explore</h3><ul><li><a href="hire.html">Hire collection</a></li><li><a href="flowers.html">Flowers</a></li><li><a href="list.html">My list</a></li><li><a href="' + CONTACT.sopley + '" target="_blank" rel="noopener">Sopley Mill</a></li></ul></div>' +
      '</div><div class="footer-bottom"><span>© ' + new Date().getFullYear() + ' IncaBella Floristry &amp; Wedding Hire</span><span>Weddings at Sopley Mill, Christchurch</span></div></div></footer>';
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
    var n = qtyInput ? parseInt(qtyInput.value, 10) || 1 : 1;
    List.add(btn.dataset.add, n);
    showToast(btn.dataset.add, n);
  });

  /* ---------- "Added to your list" panel ---------- */
  var toast, toastTimer;
  function showToast(slug, n) {
    var p = product(slug);
    if (!p) return;
    if (!toast) {
      toast = document.createElement("div");
      toast.className = "toast";
      toast.setAttribute("role", "status");
      document.body.appendChild(toast);
      toast.addEventListener("click", function (e) { if (e.target.closest(".toast-close")) hideToast(); });
      toast.addEventListener("mouseenter", function () { clearTimeout(toastTimer); });
      toast.addEventListener("mouseleave", function () { toastTimer = setTimeout(hideToast, 2500); });
    }
    toast.innerHTML = '<img src="' + img(p) + '" alt="">' +
      '<div class="toast-body"><p class="toast-title">Added to your list</p><p>' + (n > 1 ? n + " × " : "") + esc(p.name) + "</p>" +
      '<a class="text-link" href="list.html">View my list</a></div>' +
      '<button class="toast-close" type="button" aria-label="Close">×</button>';
    toast.classList.remove("is-shown");
    void toast.offsetWidth;
    toast.classList.add("is-shown");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(hideToast, 4500);
  }
  function hideToast() { if (toast) toast.classList.remove("is-shown"); }

  /* ---------- slow fade on scroll ---------- */
  function setupFades() {
    var els = document.querySelectorAll(".reveal");
    if (!("IntersectionObserver" in window) || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
    var io = new IntersectionObserver(function (entries) {
      // Items arriving together (a row of cards) fade in one after another.
      entries.filter(function (en) { return en.isIntersecting; }).forEach(function (en, i) {
        en.target.style.setProperty("--delay", i * 110 + "ms");
        en.target.classList.add("is-in");
        io.unobserve(en.target);
      });
    }, { rootMargin: "0px 0px -8% 0px" });
    document.querySelectorAll(".stagger").forEach(function (group) {
      [].forEach.call(group.children, function (child, i) { child.style.setProperty("--i", i); });
    });
    els.forEach(function (el) {
      // Only hide what starts below the first screen, so the page is complete at rest.
      if (el.getBoundingClientRect().top > window.innerHeight * 0.92) { el.classList.add("fade"); io.observe(el); }
    });
  }

  /* ---------- photos fade in as they load ---------- */
  function markLoaded(root) {
    (root || document).querySelectorAll("img").forEach(function (im) {
      if (im.complete && im.naturalWidth) im.classList.add("is-loaded");
    });
  }
  document.addEventListener("load", function (e) { if (e.target.tagName === "IMG") e.target.classList.add("is-loaded"); }, true);
  window.addEventListener("load", function () { document.querySelectorAll("img").forEach(function (im) { im.classList.add("is-loaded"); }); });

  /* ---------- soft fade between pages ---------- */
  function setupPageFade() {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
    document.addEventListener("click", function (e) {
      var a = e.target.closest("a[href]");
      if (!a || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      var href = a.getAttribute("href");
      if (a.target === "_blank" || /^(https?:|mailto:|tel:|#)/.test(href) || !/\.html/.test(href)) return;
      var here = location.pathname.split("/").pop() || "index.html";
      if (href.split("#")[0] === here) return; // same page, just a different section
      e.preventDefault();
      document.documentElement.classList.add("is-leaving");
      setTimeout(function () { location.href = href; }, 380);
    });
    window.addEventListener("pageshow", function (e) { if (e.persisted) document.documentElement.classList.remove("is-leaving"); });
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

  window.IB = { List: List, products: products, product: product, money: money, priceLabel: priceLabel, img: img, esc: esc, contact: CONTACT, arrow: ARROW, logoMark: logoMark, socialLinks: socialLinks, markLoaded: markLoaded };

  document.documentElement.classList.add("js");

  renderHeader();
  renderFooter();
  document.addEventListener("listchange", refreshCounts);
  window.addEventListener("storage", refreshCounts);
  document.addEventListener("DOMContentLoaded", function () {
    refreshCounts();
    markLoaded();
    setupFades();
    setupPageFade();
    setupCursor();
  });
})();
