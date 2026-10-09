/* IncaBella dashboard: find an item, and choose photos from the Media Library. */
(function ($) {
  "use strict";

  $("#ib-search").on("input", function () {
    var q = this.value.trim().toLowerCase();
    $(".ib-item").each(function () {
      var match = !q || this.getAttribute("data-name").indexOf(q) !== -1;
      this.hidden = !match;
      if (q && match) this.open = true;
    });
    $(".ib-group").each(function () {
      this.hidden = !$(this).nextUntil(".ib-group", ".ib-item").filter(function () { return !this.hidden; }).length;
    });
  });

  function sync(box) {
    var images = box.find("li").map(function () { return $(this).attr("data-image"); }).get();
    box.find("input[type=hidden]").val(images.join(","));
    var summary = box.closest(".ib-item").find("summary img");
    if (summary.length && images.length) summary.attr("src", box.find("li img").first().attr("src"));
  }

  function choose(title, done) {
    var frame = wp.media({ title: title, library: { type: "image" }, button: { text: "Use this photo" }, multiple: false });
    frame.on("select", function () {
      var a = frame.state().get("selection").first().toJSON();
      var thumb = a.sizes && (a.sizes.medium || a.sizes.thumbnail) ? (a.sizes.medium || a.sizes.thumbnail).url : a.url;
      done(String(a.id), thumb);
    });
    frame.open();
  }

  function item(image, src, single) {
    return $("<li>").attr("data-image", image)
      .append($("<img alt=''>").attr("src", src))
      .append(single ? '<button type="button" class="button ib-replace">Replace</button>'
        : '<button type="button" class="button-link ib-replace">Replace</button> <button type="button" class="button-link ib-remove">Remove</button>');
  }

  $(document).on("click", ".ib-photos .ib-replace", function () {
    var li = $(this).closest("li"), box = li.closest(".ib-photos");
    choose("Choose a photo", function (id, src) {
      li.attr("data-image", id).find("img").attr("src", src);
      sync(box);
    });
  });

  $(document).on("click", ".ib-photos .ib-remove", function () {
    var box = $(this).closest(".ib-photos");
    if (box.find("li").length < 2) { window.alert("Every item needs at least one photo. Use Replace to change it."); return; }
    $(this).closest("li").remove();
    sync(box);
  });

  $(document).on("click", ".ib-photos .ib-add", function () {
    var box = $(this).closest(".ib-photos");
    choose("Add a photo", function (id, src) {
      box.find("ul").append(item(id, src, false));
      sync(box);
    });
  });

  $(document).on("click", ".ib-photos .ib-reset", function () {
    var box = $(this).closest(".ib-photos"), base = box.attr("data-base"), single = box.hasClass("ib-photos--single");
    var ul = box.find("ul").empty();
    box.attr("data-originals").split(",").forEach(function (f) { ul.append(item(f, base + f, single)); });
    sync(box);
  });
})(jQuery);
