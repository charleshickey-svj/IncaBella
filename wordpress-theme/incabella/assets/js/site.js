/* IncaBella: menu, page effects, hero slideshow, hire filters, product photos, gallery and enquiry form. */
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

  setupHeader();
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
