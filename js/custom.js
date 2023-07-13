if (document.querySelector(".form") != null) {
  let form = document.querySelector(".form");
form.addEventListener("submit",(e)=>{
    e.preventDefault();
})
}

// reg_form_submit start
let reg_form_submit = async ()=>{
  let ajax = {
      method : "post",
      body : new FormData(document.querySelector(".reg_form")),
  }
  let response = await fetch("./php_files/register.php",ajax);
     let data = await response.json();
     console.log(data.result);
     if (data.result == "success") {
      document.querySelector("#reg_name").value=""
      document.querySelector("#reg_email").value=""
      document.querySelector("#reg_pass").value=""
      document.querySelector("#reg_cpass").value=""
     let reg_success_div = document.querySelector(".reg_success");
     reg_success_div.textContent = "registered successfully";
     reg_success_div.style.display = "block";
     setTimeout(()=>{
      reg_success_div.style.display = "none";
      window.location.href="thankyou.php";
     },2000)
     }else if(data.result == "checkout"){
      document.querySelector("#reg_name").value=""
      document.querySelector("#reg_email").value=""
      document.querySelector("#reg_pass").value=""
      document.querySelector("#reg_cpass").value=""
     let reg_success_div = document.querySelector(".reg_success");
     reg_success_div.textContent = "registered successfully";
     reg_success_div.style.display = "block";
     setTimeout(()=>{
      reg_success_div.style.display = "none";
      window.location.href="checkout.php";
     },2000)
      
     }else{
      let reg_error_div = document.querySelector(".reg_error");
      reg_error_div.textContent = data.result;
      reg_error_div.style.display = "block";
      setTimeout(()=>{
       reg_error_div.style.display = "none";
      },4000)
     }
  }
  // reg_form_submit end

  // login_form_submit start
let login_form_submit = async()=>{
  let ajax = {
      method : "post",
      body : new FormData(document.querySelector(".login_form")),
  }
  let response = await fetch("./php_files/login.php",ajax);
     let data = await response.json();
     console.log(data.result);
     if (data.result == "success") {
      document.querySelector("#login_email").value="";
      document.querySelector("#login_pass").value="";
     let login_success_div = document.querySelector(".login_success");
     login_success_div.textContent = "login successfully";
     login_success_div.style.display = "block";
     setTimeout(()=>{
      login_success_div.style.display = "none";
      window.location.href="thankyou.php";
     },2000)
     }else if(data.result == "checkout"){
      document.querySelector("#login_email").value="";
      document.querySelector("#login_pass").value="";
     let login_success_div = document.querySelector(".login_success");
     login_success_div.textContent = "login successfully";
     login_success_div.style.display = "block";
     setTimeout(()=>{
      login_success_div.style.display = "none";
      window.location.href="checkout.php";
     },2000)
     
     }else{
      let login_error_div = document.querySelector(".login_error");
      login_error_div.textContent = data.result;
      login_error_div.style.display = "block";
      setTimeout(()=>{
       login_error_div.style.display = "none";
      },4000)
     }

}
// login_form_submit end

let DROP = document.querySelectorAll(".DROP");
DROP.forEach((e)=>{
    e.onmouseenter = ()=>{
      e.classList.add("dropdown")
      e.classList.add("open")
      e.style.color="black"
    }
    e.onmouseleave = ()=>{
        e.classList.remove("dropdown")
        e.classList.remove("open")
        e.style.color="white"
      }
})



