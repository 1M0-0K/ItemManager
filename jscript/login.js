((window, document, undefined)=>{
    'use strict'

    //Selectors
    const form = document.querySelector("form");    
    const submitButton = document.querySelector("#login");
    const errorLabel = document.querySelector(".error");
    let formData;

    //Methods
    const login = () => {
        formData = new FormData(form);
        fetch("./php/login.php",{
            method: "POST",
            body: formData
        })
        .then(res => {
                if(!res.ok){
                    throw Error("Data could not be fetched");
                }else{
                    if(res.status !== 200){
                        throw Error("Data could not be fetched");
                    }
                }
                return res.text();
        })
        .then(data => {
            if(data == true){
                    location.href = "index.php";
            }else{
                errorLabel.style.display="block";
                errorLabel.innerText = data;
            }

        })
        .catch(err => {
                console.log("Could not fetch the data" + err);
        })
    }

    //Events
    form.addEventListener("submit",(e) =>{ e.preventDefault() });
    submitButton.addEventListener("click",login)
    
    

})(window, document);

