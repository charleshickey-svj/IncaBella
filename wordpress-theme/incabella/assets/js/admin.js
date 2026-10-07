/* IncaBella dashboard: pick, reorder and remove photos for hire items and the gallery. */
(function ($) {
  "use strict";

  $(".ib-photos").each(function () {
    var box = $(this);
    var list = box.find(".ib-photo-list");
    var input = box.find('input[type="hidden"]');
    var frame;

    function sync() {
      input.val(list.children("li").map(function () { return $(this).data("token"); }).get().join(","));
    }

    function addItem(token, url) {
      var li = $('<li><img alt=""><button type="button" class="ib-photo-remove" aria-label="Remove this photo">×</button></li>');
      li.attr("data-token", token).data("token", token);
      li.find("img").attr("src", url);
      list.append(li);
    }

    list.sortable({ placeholder: "ib-photo-placeholder", update: sync });

    list.on("click", ".ib-photo-remove", function () {
      $(this).closest("li").remove();
      sync();
    });

    box.on("click", ".ib-photo-add", function (e) {
      e.preventDefault();
      if (!frame) {
        frame = wp.media({ title: "Choose photos", button: { text: "Add these photos" }, library: { type: "image" }, multiple: "add" });
        frame.on("select", function () {
          frame.state().get("selection").each(function (att) {
            var a = att.toJSON();
            var thumb = (a.sizes && (a.sizes.thumbnail || a.sizes.medium || a.sizes.full)) || a;
            addItem(String(a.id), thumb.url);
          });
          sync();
        });
        frame.on("open", function () { frame.state().get("selection").reset(); });
      }
      frame.open();
    });
  });
})(jQuery);
