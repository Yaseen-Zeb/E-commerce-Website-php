

if (document.querySelector(".color_section") == null && document.querySelector("#size_selector") == null && document.querySelector(".pid") != null) {
  get_attribute_details(document.querySelector(".pid").value, 0, 0)
}
if (document.querySelector(".color_section") == null && document.querySelector("#size_selector_div") != null) {
  document.querySelector("#size_selector_div").style.display = "block";
};

// contact_form_submit start
let contact_form_submit = async () => {
  let ajax = {
    method: "post",
    body: new FormData(document.querySelector(".contact_fom"))
  }
  let response = await fetch("./php_files/contact.php", ajax);
  let data = await response.json();
  if (data.result == "success") {
    document.querySelector("#name").value = ""
    document.querySelector("#email").value = ""
    document.querySelector("#phone").value = ""
    document.querySelector("#comment").value = ""
    let contact_success_div = document.querySelector(".cantact_success");
    contact_success_div.textContent = "Massege sent successfully";
    contact_success_div.style.display = "block";
    setTimeout(() => {
      contact_success_div.style.display = "none";
    }, 4000)
  } else {
    let contact_error_div = document.querySelector(".cantact_error");
    contact_error_div.textContent = data.result;
    contact_error_div.style.display = "block";
    setTimeout(() => {
      contact_error_div.style.display = "none";
    }, 4000)
  }
}
// contact_form_submit end







// manage cart start
async function manage_cart(pid, action, from, attr_id) {
  let qty;
  let c_id;
  let s_id;
  let avilable_qty;
  if (from == "notFromCartPage") {
    avilable_qty = document.querySelector("#avilable_qty").value
    qty = document.querySelector(".p_qty");
  } else if(from == "FromCheckoutPage"){
    avilable_qty = 1;
    qty = document.querySelector("#qty" + attr_id)
  }else{
    avilable_qty = 1;
    qty = document.querySelector("#qty" + attr_id);
  }


  if (document.querySelector('.color_id') == null) {
    c_id = "null"
  } else {
    c_id = document.querySelector('.color_id').value
  }
  if (document.querySelector('.size_id') == null) {
    s_id = "null";
  } else {
    s_id = document.querySelector('.size_id').value
  }


  if (qty == null) {
    qty = "";
  } else {
    qty = qty
  }
  if (qty.value == 0) {
    window.location.href = window.location.href;
  } else {
    if (avilable_qty == 0) {
      let catrt_alert = document.querySelector(".catrt_alert")
      let wrap_butons = document.querySelector(".wrap-butons")
      catrt_alert.textContent = "Out of Stock";
      wrap_butons.classList.remove("mt-3")
      wrap_butons.classList.add("pt-0")
      wrap_butons.classList.add("mt-0")
      catrt_alert.style.display = "block";
      setTimeout(() => {
        catrt_alert.style.display = "none";
        wrap_butons.classList.add("mt-3")
      }, 4000)
    } else {
      let stringfy_data = JSON.stringify({
        PID: pid,
        ACTION: action,
        QTY: qty.value,
        CID: c_id,
        SID: s_id,
        ATT_ID: attr_id
      })
      let ajax = {
        method: "post",
        body: stringfy_data,
      }
      let response = await fetch("./php_files/manage_cart.php", ajax);
      let data = await response.json();
      console.log(data);
      if (data.result == "add_success") {
        window.location.href = window.location.pathname + "?id=" + pid;
      } else if (data.result == "delete_success" || data.result == "update_success") {
        window.location.href = window.location.href;
      } else {

        let catrt_alert = document.querySelector(".catrt_alert")
        let wrap_butons = document.querySelector(".wrap-butons")

        catrt_alert.textContent = data.result;
        wrap_butons.classList.remove("mt-3")
        wrap_butons.classList.add("pt-0")
        wrap_butons.classList.add("mt-0")
        catrt_alert.style.display = "block";
        setTimeout(() => {
          catrt_alert.style.display = "none";
          wrap_butons.classList.add("mt-3")
        }, 4000)
      }
    }
  }
}
// manage cart end

//manage order start
async function manage_order() {
  let ajax = {
    method: "post",
    body: new FormData(document.querySelector(".checkout_form")),
  }
  let response = await fetch("./php_files/manage_checkout.php", ajax);
  let data = await response.json();
  if (data.result == "success") {
    window.location.href = "thankyou.php?con=or";
  } else {
    document.querySelector(".checkout_error").textContent = data.result;
  }
}
//manage order end

// manage wishlist start
async function manage_wishlist(pid) {
  let stringfy_data = JSON.stringify({
    PID: pid,
  })
  let ajax = {
    method: "post",
    body: stringfy_data,
  }
  let response = await fetch("php_files/manage_wishlist.php", ajax);
  let data = await response.json();
  //    console.log(data.result);
  if (data.result == "success") {
    window.location.href = window.location.href;
  } else {
    let wistlist_alert_div = document.querySelector(".wishlist_alert");
    wistlist_alert_div.textContent = data.result;
    wistlist_alert_div.style.display = "block";
    setTimeout(() => {
      wistlist_alert_div.style.display = "none";
    }, 6000)
  }

}
//manage wishlist end

// manage sorting start
function sort(search) {
  let sort_val = document.querySelector(".sort").value;
  if (search == "") {
    window.location.href = window.location.pathname + "?sort=" + sort_val;
  } else {
    window.location.href = window.location.pathname + "?search=" + search + "&sort=" + sort_val;
  }
};

function cat_sort(id) {
  let cat_sort_val = document.querySelector(".cat_sort").value;
  window.location.href = window.location.pathname + "?id=" + id + "&sort=" + cat_sort_val;

}

function sub_cat_sort(id, sub_cat_id) {
  let cat_sort_val = document.querySelector(".cat_sort").value;
  window.location.href = window.location.pathname + "?id=" + id + "&sub_cat=" + sub_cat_id + "&sort=" + cat_sort_val;

}
//manage sorting end

//manage review start
async function manage_review() {
  let ajax = {
    method: "post",
    body: new FormData(document.querySelector(".review_form")),
  }
  let response = await fetch("php_files/manage_review.php", ajax);
  let data = await response.json();
  console.log(data);
  if (data.result == "success") {
    let review_success_div = document.querySelector(".review_success_div");
    review_success_div.textContent = "Your Review Submited Successfully";
    review_success_div.style.display = "block";
    setTimeout(() => {
      review_success_div.style.display = "none";
    }, 6000)
  } else {
    let review_error_div = document.querySelector(".review_error_div");
    review_error_div.textContent = data.result;
    review_error_div.style.display = "block";
    setTimeout(() => {
      review_error_div.style.display = "none";
    }, 6000)
  }
}
//manage review end

//manage product attributes logic start
async function get_size(pid, color_id, from, size_id) {
  if (document.querySelector("#size_selector_div") != null) {
    if (from == 1) {
      document.querySelector(".color_id").value = color_id;
      document.querySelector(".size_id").value = "";
      let stringfy_data = JSON.stringify({
        PID: pid,
        COLOR_ID: color_id,
      })
      let ajax = {
        method: "post",
        body: stringfy_data,
      }
      let response = await fetch("./php_files/get_size.php", ajax);
      let data = await response.json();

      document.querySelector("#size_selector").innerHTML = data.result;
      document.querySelector("#size_selector_div").style.display = "block";
      // console.log(data.result);

    } else {
      document.querySelector(".size_id").value = document.querySelector("#size_" + size_id).value
      let cid;
      if (document.querySelector(".color_id") != null) {
        cid = document.querySelector(".color_id").value
      } else {
        cid = 0;
      }
      get_attribute_details(pid, cid, document.querySelector(".size_id").value)
    }
  } else {
    document.querySelector(".color_id").value = color_id;
    let sid = 0;
    get_attribute_details(pid, document.querySelector(".color_id").value, sid)
  }
}
//////////
async function get_attribute_details(pid, cid, sid) {
  let stringfy_data = JSON.stringify({
    PID: pid,
    CID: cid,
    SID: sid,
  })
  let ajax = {
    method: "post",
    body: stringfy_data,
  }
  let response = await fetch("./php_files/get_attrbute_details.php", ajax);
  let data = await response.json();
  document.querySelector(".product-price").textContent = "Rs" + data.price;
  let counter = document.querySelector(".p_qty");
  counter.setAttribute("data-max", data.qty)
  document.querySelector(".qty_in_stock").textContent = data.qty + " Quantities In Stock"
  document.querySelector("#avilable_qty").value = data.qty
}
//manage product attributes logic end