$(document).ready(function () { let o = JSON.parse(jQuery("#data-size").attr("data-sizes")), i = $("#data-color").val(); c(i, o), $(document).on("change", "#data-color", function () { let t = $("#data-color").val(); c(t, o) }), $(document).on("change", "#data-size", function () { let t = JSON.parse(jQuery("#data-size").attr("data-sizes")), a = $("#data-size").val(), s = $("#data-color").val(); t.forEach(r => { r.product_color_id == s && r.product_size_id == a && $("#quantity_remain").text(r.quantity) }) }), $(document).on("click", ".star", function () { $(".rating label .fa-star").css({ color: "#b1b1b1" }); let t = $(this).attr("id"); for (let a = 1; a <= t.split("star")[1]; a++)$(`#icon-star${a} i`).css({ color: "#F5A623" }) }) }); function c(o, i) {
   let t = ""; i.forEach(a => {
      a.product_color_id == o && (t += `
          <option value='${a.product_size_id}'>${a.size_name}</option>
       `)
   }), $("#data-size").html(t), d(i)
} function d(o) { let i = $("#data-size").val(); o.forEach(t => { t.product_size_id == i && $("#quantity_remain").text(t.quantity) }) }
