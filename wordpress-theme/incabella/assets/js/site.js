/* IncaBella: menu, page effects, hero slideshow, hire filters, product photos, gallery, enquiry form and "My list". */
(function () {
  "use strict";

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  document.documentElement.classList.add("js");

  /* ---------- header ---------- */
  function setupHeader() {
    var toggle = document.querySelector(".menu-toggle");
    if (toggle) {
      toggle.addEventListener("click", function () {
        var open = document.body.classList.toggle("menu-open");
        toggle.setAttribute("aria-expanded", open);
      });
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && document.body.classList.contains("menu-open")) { toggle.click(); toggle.focus(); }
      });
    }
    var header = document.querySelector(".site-header");
    if (!header) return;
    var onScroll = function () { header.classList.toggle("is-scrolled", window.scrollY > 8); };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  /* ---------- slow fade on scroll ---------- */
  function setupFades() {
    var els = document.querySelectorAll(".reveal");
    if (!("IntersectionObserver" in window) || reduceMotion) return;
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
    if (reduceMotion) return;
    document.addEventListener("click", function (e) {
      var a = e.target.closest("a[href]");
      if (!a || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      if (a.target === "_blank" || a.hasAttribute("download")) return;
      var url;
      try { url = new URL(a.href, location.href); } catch (err) { return; }
      if (url.origin !== location.origin || /^(mailto|tel):/.test(a.href)) return;
      if (/\/wp-(admin|login)/.test(url.pathname)) return;
      if (url.pathname === location.pathname && url.search === location.search) return; // same page, another section
      e.preventDefault();
      document.documentElement.classList.add("is-leaving");
      setTimeout(function () { location.href = a.href; }, 380);
    });
    window.addEventListener("pageshow", function (e) { if (e.persisted) document.documentElement.classList.remove("is-leaving"); });
  }

  /* ---------- cursor dot (mouse only) ---------- */
  function setupCursor() {
    if (!window.matchMedia("(hover: hover) and (pointer: fine)").matches || reduceMotion) return;
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

  /* ---------- home: slow crossfade between hero photos ---------- */
  function setupSlides() {
    var box = document.querySelector("[data-slides]"), dots = document.querySelector("[data-dots]");
    if (!box || !dots) return;
    var slides = [].slice.call(box.children), current = 0, timer;
    if (!slides.length) return;
    slides[0].classList.add("is-active");
    if (slides.length < 2) return;
    dots.innerHTML = slides.map(function (s, i) {
      return '<button type="button" aria-label="Show photo ' + (i + 1) + '"' + (i ? "" : ' aria-current="true"') + "></button>";
    }).join("");
    function show(i) {
      slides[current].classList.remove("is-active");
      dots.children[current].removeAttribute("aria-current");
      current = (i + slides.length) % slides.length;
      box.classList.add("is-running");
      slides[current].loading = "eager";
      slides[current].classList.add("is-active");
      dots.children[current].setAttribute("aria-current", "true");
    }
    function play() { clearInterval(timer); timer = setInterval(function () { if (!document.hidden) show(current + 1); }, 6500); }
    dots.addEventListener("click", function (e) {
      var b = e.target.closest("button"); if (!b) return;
      show([].indexOf.call(dots.children, b)); play();
    });
    slides.slice(1).forEach(function (s) { s.loading = "eager"; });
    if (!reduceMotion) play();
  }

  /* ---------- hire page: category filters ---------- */
  function setupFilters() {
    var filters = document.querySelector("[data-filters]"), holder = document.querySelector("[data-groups]");
    if (!filters || !holder) return;
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
    if (start && holder.querySelector('[data-group="' + start + '"]')) show(start);
  }

  /* ---------- product page: photo thumbnails ---------- */
  function setupThumbs() {
    var gallery = document.querySelector(".product-gallery");
    if (!gallery) return;
    var main = gallery.querySelector(".main");
    gallery.querySelectorAll(".thumbs button").forEach(function (b) {
      b.addEventListener("click", function () {
        main.src = b.dataset.src;
        gallery.querySelectorAll(".thumbs button").forEach(function (x) { x.removeAttribute("aria-current"); });
        b.setAttribute("aria-current", "true");
      });
    });
  }

  /* ---------- gallery: full-screen viewer ---------- */
  function setupLightbox() {
    var box = document.querySelector("[data-gallery]");
    if (!box) return;
    var photos = [].map.call(box.querySelectorAll("img"), function (im) { return { src: im.dataset.full || im.src, alt: im.alt }; });
    var lb, current = 0, opener;
    function open(i) {
      current = (i + photos.length) % photos.length;
      if (!lb) {
        lb = document.createElement("div");
        lb.className = "lightbox"; lb.setAttribute("role", "dialog"); lb.setAttribute("aria-modal", "true"); lb.setAttribute("aria-label", "Photo viewer");
        lb.innerHTML = '<img alt=""><button class="prev" type="button" aria-label="Previous photo">‹</button><button class="next" type="button" aria-label="Next photo">›</button><button class="close" type="button" aria-label="Close">×</button>';
        lb.addEventListener("click", function (e) {
          if (e.target.closest(".prev")) open(current - 1);
          else if (e.target.closest(".next")) open(current + 1);
          else if (e.target.closest(".close") || e.target === lb) close();
        });
        document.body.appendChild(lb);
      }
      lb.hidden = false;
      lb.querySelector("img").src = photos[current].src;
      lb.querySelector("img").alt = photos[current].alt;
      lb.querySelector(".close").focus();
    }
    function close() { lb.hidden = true; if (opener) opener.focus(); }
    box.addEventListener("click", function (e) { var b = e.target.closest("[data-i]"); if (b) { opener = b; open(+b.dataset.i); } });
    document.addEventListener("keydown", function (e) {
      if (!lb || lb.hidden) return;
      if (e.key === "Escape") close();
      if (e.key === "ArrowLeft") open(current - 1);
      if (e.key === "ArrowRight") open(current + 1);
    });
  }

  /* ---------- contact: check the form before it's sent ---------- */
  function setupEnquiry() {
    var form = document.getElementById("contact-form");
    if (!form) return;
    var error = form.querySelector("[data-error]");
    function pickTopic() { if (location.hash === "#flowers") form.topic.value = "Flowers"; }
    pickTopic();
    window.addEventListener("hashchange", pickTopic);
    var topicLink = document.querySelector("[data-topic]");
    if (topicLink) topicLink.addEventListener("click", function () { form.topic.value = "Flowers"; });

    form.addEventListener("submit", function (e) {
      form.querySelectorAll("[aria-invalid]").forEach(function (f) { f.removeAttribute("aria-invalid"); });
      var missing = [].slice.call(form.querySelectorAll("[required]")).filter(function (f) { return !f.value.trim() || !f.checkValidity(); });
      if (missing.length) {
        e.preventDefault();
        missing.forEach(function (f) { f.setAttribute("aria-invalid", "true"); });
        error.textContent = "Please fill in " + missing.map(function (f) { return form.querySelector('label[for="' + f.id + '"]').textContent.toLowerCase(); }).join(", ") + ".";
        error.hidden = false; missing[0].focus(); return;
      }
      error.hidden = true;
      var btn = form.querySelector('button[type="submit"]');
      btn.disabled = true; btn.textContent = "Sending…";
    });
  }

  /* ---------- My list (kept in this browser, keyed by hire item ID) ---------- */
  var KEY = "incabella-list", memory = {};
  function read() {
    try { var l = JSON.parse(localStorage.getItem(KEY) || "{}"); return l && typeof l === "object" ? l : {}; }
    catch (e) { return memory; }
  }
  function write(list) {
    memory = list;
    try { localStorage.setItem(KEY, JSON.stringify(list)); } catch (e) { /* private browsing: keep it for this visit */ }
    document.dispatchEvent(new CustomEvent("listchange"));
  }
  var List = {
    items: function () { return read(); },
    qty: function (id) { return read()[id] || 0; },
    set: function (id, qty) {
      var l = read();
      qty = Math.max(0, Math.min(999, Math.round(qty) || 0));
      if (qty) l[id] = qty; else delete l[id];
      write(l);
    },
    add: function (id, n) { List.set(id, List.qty(id) + (n || 1)); },
    clear: function () { write({}); },
    count: function () { var l = read(), c = 0; for (var k in l) c += l[k]; return c; }
  };

  function esc(s) { return String(s).replace(/[&<>"]/g, function (c) { return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;" }[c]; }); }
  function money(n) { return "£" + n.toLocaleString("en-GB", { minimumFractionDigits: n % 1 ? 2 : 0, maximumFractionDigits: 2 }); }
  function listUrl() { var a = document.querySelector("a.list-btn"); return a ? a.href : "#"; }

  var PLUS = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5"/></svg>';
  var TICK = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="m3 8.5 3 3 7-7" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>';
  function syncAddButton(btn) {
    var q = List.qty(btn.dataset.add);
    btn.classList.toggle("is-added", q > 0);
    btn.innerHTML = q > 0 ? TICK + "In my list" + (q > 1 ? " (" + q + ")" : "") : PLUS + "Add to my list";
  }
  function refreshCounts() {
    var n = List.count();
    document.querySelectorAll(".list-count").forEach(function (c) {
      if (c.textContent !== String(n)) { c.classList.remove("bump"); void c.offsetWidth; c.classList.add("bump"); }
      c.textContent = n; c.dataset.count = n; c.setAttribute("aria-label", n + (n === 1 ? " item" : " items"));
    });
    document.querySelectorAll("[data-add]").forEach(syncAddButton);
  }
  function setupList() {
    document.querySelectorAll(".list-count").forEach(function (c) { var n = List.count(); c.textContent = n; c.dataset.count = n; c.setAttribute("aria-label", n + (n === 1 ? " item" : " items")); });
    document.querySelectorAll("[data-add]").forEach(syncAddButton);
    document.addEventListener("listchange", refreshCounts);
    window.addEventListener("storage", function (e) { if (e.key === KEY) refreshCounts(); });

    document.addEventListener("click", function (e) {
      var step = e.target.closest(".qty-row [data-step]");
      if (step) {
        var q = document.getElementById("qty");
        q.value = Math.max(1, Math.min(999, (parseInt(q.value, 10) || 1) + +step.dataset.step));
        return;
      }
      var btn = e.target.closest("[data-add]");
      if (!btn) return;
      e.preventDefault();
      var qtyInput = btn.dataset.qtyFrom && document.querySelector(btn.dataset.qtyFrom);
      var n = qtyInput ? Math.max(1, parseInt(qtyInput.value, 10) || 1) : 1;
      List.add(btn.dataset.add, n);
      showToast(btn.dataset.name, btn.dataset.img, n);
    });
  }

  /* ---------- "Added to your list" panel, bottom right ---------- */
  var toast, toastTimer;
  function showToast(name, img, n) {
    if (!toast) {
      toast = document.createElement("div");
      toast.className = "toast";
      toast.setAttribute("role", "status");
      document.body.appendChild(toast);
      toast.addEventListener("click", function (e) { if (e.target.closest(".toast-close")) hideToast(); });
      toast.addEventListener("mouseenter", function () { clearTimeout(toastTimer); });
      toast.addEventListener("mouseleave", function () { toastTimer = setTimeout(hideToast, 2500); });
    }
    toast.innerHTML = '<img src="' + esc(img || "") + '" alt="">' +
      '<div class="toast-body"><p class="toast-title">Added to your list</p><p>' + (n > 1 ? n + " × " : "") + esc(name || "") + "</p>" +
      '<a class="text-link" href="' + esc(listUrl()) + '">View my list</a></div>' +
      '<button class="toast-close" type="button" aria-label="Close">×</button>';
    toast.classList.remove("is-shown");
    void toast.offsetWidth;
    toast.classList.add("is-shown");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(hideToast, 4500);
  }
  function hideToast() { if (toast) toast.classList.remove("is-shown"); }

  /* ---------- My list page ---------- */
  function setupListPage() {
    if (document.querySelector("[data-list-sent]")) { List.clear(); return; }
    var box = document.querySelector("[data-list]"), form = document.getElementById("list-form");
    if (!box || !form) return;
    var cat = {};
    try { JSON.parse(document.getElementById("ib-catalogue").textContent).forEach(function (p) { cat[p.id] = p; }); } catch (e) { /* no items */ }
    var error = form.querySelector("[data-error]");

    // Items Lucy has since hidden or deleted drop out of the list.
    var stored = List.items();
    Object.keys(stored).forEach(function (id) { if (!cat[id]) delete stored[id]; });
    if (Object.keys(stored).length !== Object.keys(List.items()).length) write(stored);

    function lines() {
      var items = List.items();
      return Object.keys(items).filter(function (id) { return cat[id]; }).map(function (id) { return { p: cat[id], qty: items[id] }; });
    }
    function render() {
      var ls = lines();
      if (!ls.length) {
        box.innerHTML = '<div class="empty"><p class="script" style="font-size:3.2rem">Nothing here yet</p>' +
          "<p>Browse the hire collection and tap “Add to my list” on anything you'd like for your day.</p>" +
          '<div class="btn-row"><a class="btn" href="' + esc(box.dataset.hire) + '">Browse the hire collection</a><a class="btn" href="' + esc(box.dataset.flowers) + '">Flowers</a></div></div>';
        return;
      }
      var total = 0, from = false;
      box.innerHTML = '<ul class="list-items">' + ls.map(function (l) {
        var p = l.p, line = p.price * l.qty;
        total += line; from = from || p.from;
        return '<li class="list-item"><a href="' + esc(p.url) + '"><img class="is-loaded" src="' + esc(p.img) + '" alt=""></a>' +
          '<div><h3><a href="' + esc(p.url) + '">' + esc(p.name) + "</a></h3>" +
          '<div class="meta"><span>' + (p.from ? "From " : "") + money(p.price) + " " + esc(p.unit || "each") + "</span>" +
          '<span class="qty"><button type="button" data-dec="' + p.id + '" aria-label="One fewer ' + esc(p.name) + '">−</button>' +
          '<input type="number" inputmode="numeric" min="1" max="999" value="' + l.qty + '" data-qty="' + p.id + '" aria-label="Quantity of ' + esc(p.name) + '">' +
          '<button type="button" data-inc="' + p.id + '" aria-label="One more ' + esc(p.name) + '">+</button></span>' +
          '<button class="remove" type="button" data-remove="' + p.id + '">Remove</button></div></div>' +
          '<span class="line-total">' + money(line) + "</span></li>";
      }).join("") + "</ul>" +
        '<div class="list-total"><span class="kicker">Estimated total</span><strong>' + (from ? "From " : "") + money(total) + "</strong></div>" +
        "<p>Lucy will confirm your final price, including any multi-buy savings.</p>" +
        '<p style="margin-top:24px"><a class="text-link" href="' + esc(box.dataset.hire) + '">Add more items</a></p>';
    }

    box.addEventListener("click", function (e) {
      var t = e.target.closest("button");
      if (!t) return;
      if (t.dataset.inc) List.add(t.dataset.inc, 1);
      if (t.dataset.dec) List.set(t.dataset.dec, Math.max(1, List.qty(t.dataset.dec) - 1));
      if (t.dataset.remove) List.set(t.dataset.remove, 0);
    });
    box.addEventListener("change", function (e) {
      if (e.target.dataset.qty) List.set(e.target.dataset.qty, Math.max(1, parseInt(e.target.value, 10) || 1));
    });
    document.addEventListener("listchange", render);
    render();

    form.addEventListener("submit", function (e) {
      form.querySelectorAll("[aria-invalid]").forEach(function (f) { f.removeAttribute("aria-invalid"); });
      var missing = [].slice.call(form.querySelectorAll("[required]")).filter(function (f) { return !f.value.trim() || !f.checkValidity(); });
      var fail = "";
      if (!lines().length && !form.flowers.checked) fail = "Your list is empty. Add some items from the hire collection, or tick the flowers box, before sending.";
      else if (missing.length) {
        missing.forEach(function (f) { f.setAttribute("aria-invalid", "true"); });
        fail = "Please fill in " + missing.map(function (f) { return form.querySelector('label[for="' + f.id + '"]').textContent.toLowerCase(); }).join(", ") + ".";
      }
      if (fail) {
        e.preventDefault();
        error.textContent = fail; error.hidden = false;
        if (missing.length) missing[0].focus();
        return;
      }
      error.hidden = true;
      var items = {};
      lines().forEach(function (l) { items[l.p.id] = l.qty; });
      form.querySelector("[name=items]").value = JSON.stringify(items);
      var btn = form.querySelector('button[type="submit"]');
      btn.disabled = true; btn.textContent = "Sending…";
    });
  }

  setupHeader();
  setupList();
  setupListPage();
  setupSlides();
  setupFilters();
  setupThumbs();
  setupLightbox();
  setupEnquiry();
  markLoaded();
  setupFades();
  setupPageFade();
  setupCursor();
})();
