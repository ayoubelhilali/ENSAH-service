document.addEventListener("DOMContentLoaded",()=>{
    const input_password = document.getElementById("input_password") ;
    const icone_Eye = document.getElementById("icone_Eye") ;

    icone_Eye.addEventListener("click",()=>{
        const isPassword= input_password.type == "password" ;
        input_password.type = isPassword? "text":"password" ;
        icone_Eye.textContent= isPassword? "visibility":"visibility_off" ;
    })
}) ;

