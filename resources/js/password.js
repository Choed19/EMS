function checkPassword(){
    let password = document.getElementById
    ('password').value;
    let cnfrmpassword = document.getElementById
    ("cnfrm-password").value;
    console.log(password,cnfrmpassword);
    let message = document.getElementById
    ("massage");

    if(password.length !=0){
        if(password == cnfrmpassword){
          massage.TectContent = "Passwords Match";
          massage.style.backgroundColor ="#3ae374"
        }
        else{
            massage.TectContent = "Password don't match";
            massage.style.backgroundColor = "#ff4d4d"
        }
    }
    else{
        alert("password con't be empty");
        massage.TectContent= "";
    }
}