// admin login start
//VARIABLES

let form = document.querySelector(".form")
let name = document.querySelector(".adminName")
let pass = document.querySelector(".adminPass")
let login_btn = document.querySelector(".btn")
//FUNCTIONS
form.addEventListener("submit", async (e) => {
    e.preventDefault();
})
let admin_login = async () => {
    let formData = {
        admin_name: name.value,
        admin_pass: pass.value,
    }
    let jsondata = JSON.stringify(formData);
    let ajax = {
        method: "post",
        body: jsondata
    }

    let response = await fetch("http://localhost//E-com%20vishal/admin/php_files/admin.php", ajax);
    let data = await response.json();
    console.log(data);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "loged Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "dashboard.php";
        }, 1000);


    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }
}
// admin login end

// manage category start
let cat_name = document.querySelector(".cat_name")
let add_cat_btn = document.querySelector(".add_cat_login_btn")

let manage_cat = async (e) => {
    let formData = {
        cat_name: cat_name.value,
    }
    let jsondata = JSON.stringify(formData);
    let ajax = {
        method: "post",
        body: jsondata
    }
    let response;
    if (add_cat_btn.textContent === "ADD") {
        response = await fetch("php_files/category.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/category.php?id=" + id, ajax);
    }

    let data = await response.json();
    console.log(data);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Category added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "category.php"
        }, 1000);


    } else if (data.result == "cat_success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Category updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "category.php"
        }, 1000);
    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }
}

// manage category End


// manage color start
let color = document.querySelector(".color")
let add_color_btn = document.querySelector(".add_color_login_btn")

let manage_color = async (e) => {
    let formData = {
        color: color.value,
    }
    let jsondata = JSON.stringify(formData);
    let ajax = {
        method: "post",
        body: jsondata
    }
    let response;
    if (add_color_btn.textContent === "ADD") {
        response = await fetch("php_files/color.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/color.php?id=" + id, ajax);
    }

    let data = await response.json();
    console.log(data);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Color added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "color.php"
        }, 1000);


    } else if (data.result == "cat_success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Color updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "color.php"
        }, 1000);
    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }
}
// manage color end

// manage size start
let size_name = document.querySelector(".size_name")
let add_size_btn = document.querySelector(".add_size_login_btn")

let manage_size = async (e) => {
    let formData = {
        size_name: size_name.value,
    }
    let jsondata = JSON.stringify(formData);
    let ajax = {
        method: "post",
        body: jsondata
    }
    let response;
    if (add_size_btn.textContent === "ADD") {
        response = await fetch("php_files/size.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/size.php?id=" + id, ajax);
    }

    let data = await response.json();
    console.log(data);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Size added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "size.php"
        }, 1000);


    } else if (data.result == "cat_success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Size updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "size.php"
        }, 1000);
    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }
}
// manage size end

// manage sub_category start
async function manage_sub_cat() {
    let add_sub_cat_btn = document.querySelector(".add_sub_cat_login_btn");
    let ajax = {
        method: "post",
        body: new FormData(document.querySelector(".sub_cat_form"))
    }
    let response;
    if (add_sub_cat_btn.textContent === "ADD") {
        response = await fetch("php_files/sub_category.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/sub_category.php?id=" + id, ajax);
    }

    let data = await response.json();
    console.log(data);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "sub_Category added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "sub_categries.php"
        }, 1000);


    } else if (data.result == "sub_cat_success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "sub_Category updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "sub_categries.php"
        }, 1000);
    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }

}
// manage sub_category end

// manage sub_category start
async function manage_brands(params) {
    let add_brand_btn = document.querySelector(".add_brand_login_btn");
    let ajax = {
        method: "post",
        body: new FormData(document.querySelector(".brand_form"))
    }
    let response;
    if (add_brand_btn.textContent === "ADD") {
        response = await fetch("php_files/brands.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/brands.php?id=" + id, ajax);
    }

    let data = await response.json();
    //  console.log(data);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Brand added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "brands.php"
        }, 1000);


    } else if (data.result == "brand_success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "Brand updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "brands.php"
        }, 1000);
    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }
}
// manage sub_category end

// manage product start---------------------------->>>>>
//add multiple images of product
var image_num = 1;
function add_product_img() {
    image_num++;
    var html = `<div class="form-group col-md-12 ${"img_num_" + image_num}" ><div class="col-md-8 "><label for="">Image</label><?php $required;isset($_GET['id']) ? $required="" : $required = "required"; ?><input  type="file" class="product_image"  name="product_images[]"></div><div class="col-md-4" style="text-align:end;padding:0""><button class="btn btn-danger" style="margin-top:17px" onclick="remove_img('${image_num}')">dalete</button></div></div>`;
    jQuery(".images_div").append(html)


}

function remove_img(img_num) {
    document.querySelector(".img_num_" + img_num).remove()
}

//add multiple images of product

let add_pro_btn = document.querySelector(".pro_btn");

let manage_pro = async () => {
    let ajax = {
        method: "post",
        body: new FormData(document.querySelector(".pro_form"))
    }
    let response;
    if (add_pro_btn.textContent === "ADD") {
        response = await fetch("php_files/product.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/product.php?id=" + id, ajax);
    }

    let data = await response.json();
    console.log(data.result);
    if (data.result == "success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "products added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "products.php"
        }, 1000);


    } else if (data.result == "pro_success") {
        let success = document.querySelector(".success");
        success.style.display = "block";
        success.textContent = "product updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "products.php"
        }, 1000);
    } else {
        let error = document.querySelector(".error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }
}
let cat_id_selector = document.querySelector("#cat_id select");
cat_id_selector.addEventListener("change", () => {
    get_options("", "", "")
})
async function get_options(id, sub_cat_id, brand_id) {
    let cat_id = "";
    if (id == "") {
        cat_id = cat_id_selector.value;
    } else {
        cat_id = id;
    }
    let formData = {
        cat_id: cat_id,
        sub_cat_id: sub_cat_id,
        brand_id: brand_id
    }
    let jsondata = JSON.stringify(formData);
    let ajax = {
        method: "post",
        body: jsondata
    }
    response = await fetch("php_files/get_options.php", ajax);
    let data = await response.json();
    // console.log(data);
    let sub_cat_selector = document.querySelector(".sub_cat_selector select");
    let brand_selector = document.querySelector(".brand_selector select");
    sub_cat_selector.innerHTML = data[0];
    brand_selector.innerHTML = data[1];
}


async function manage_venders() {
    let ajax = {
        method: "post",
        body: new FormData(document.querySelector(".vender_form"))
    }
    let add_pro_btn = document.querySelector(".add_vender_btn");
    let response;
    if (add_pro_btn.textContent === "ADD") {
        response = await fetch("php_files/vender.php", ajax);
    } else {
        let id = document.querySelector(".hidden").value;
        response = await fetch("php_files/vender.php?id=" + id, ajax);
    }

    let data = await response.json();
    console.log(data.result);
    if (data.result == "success") {
        let success = document.querySelector(".vender_success");
        success.style.display = "block";
        success.textContent = "vender added Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "venders.php"
        }, 1000);
    } else if (data.result == "up_success") {
        let success = document.querySelector(".vender_success");
        success.style.display = "block";
        success.textContent = "vender updated Successfully";
        setTimeout(() => {
            success.style.display = "none";
            window.location.href = "venders.php"
        }, 1000);
    } else {
        let error = document.querySelector(".vender_error");
        error.style.display = "block";
        error.textContent = data.result;
        setTimeout(() => {
            error.style.display = "none";
        }, 5000);
    }

}
// manage vender end

// add color size qty price logic srart
let attr_num = 1;
function add_attr() {
    let size_html = document.querySelector("#size_selector").innerHTML;
   size_html= size_html.replace("selected","")
    let color_html = document.querySelector("#color_selector").innerHTML;
    color_html= color_html.replace("selected","")
    attr_num++;

    var html = ` <div class=" ${"attr_" + attr_num}" ><div class="form-group col-md-3"><label for="">Price</label><input placeholder="Price" required type="text" class="form-control product_price" name="product_price[]" requried=""></div><div class="form-group col-md-2"><label for="">Qty</label><input placeholder="Qty" required type="number" class="form-control product_qty" name="product_qty[]" requried="" ></div><div class="form-group col-md-2"><label for="">Size</label><select class="form-control product_category" name="size[]">'${size_html}</select></div><div class="form-group col-md-3"><label for="">Color</label><select class="form-control product_category" name="color[]">';${color_html}</select></div><div class="form-group col-md-2"><input onclick="remove_attr(${attr_num})" style="margin-top: 22px;" type="button" class="btn btn-danger" value="remove"></div></div>`;
    jQuery(".attr").after(html)
}

function remove_attr(attr_id) {
    document.querySelector(".attr_" + attr_id).remove()
    // alert("ss")
}




