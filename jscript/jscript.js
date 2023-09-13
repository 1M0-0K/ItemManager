((window, document, undefined)=>{
    'use strict'

    //Selectors
    let editBtns;
    let deleteBtns;
    let owners;
    let currentPage = 0;
    let lastPage = 0;
    let offset = 0;
    let newData;
    let searchFieldValue = "id";
    let searchTermValue = "";
    let resData;
    let query;
    let popup;
    let attField;
    let magField;

    const form = document.querySelector("form");
    const searchTerm = document.querySelector("#search");
    const searchField = document.querySelector("[name='search-field");
    const submitBtn = document.querySelector("#submit");
    const orderBy = document.querySelector("[name='orderby'");
    const errorLabel = document.querySelector(".error");
    const arrowPrev = document.querySelector(".arrow.left");
    const arrowNext = document.querySelector(".arrow.right");
    const logoutBtn = document.querySelector(".logout");
    const refreshBtn = document.querySelector(".refresh");
    const page = document.querySelector("#container");

    const table = document.querySelector("table>tbody");

    //Methods
    
    const useFetch = (url) => new Promise((resolve, reject) => {
        
        fetch(url)
        .then(res => {
                if(!res.ok){
                    throw Error("could not be fetched");
                }else{
                    if(res.status !== 200){
                        throw Error("Data could not be fetched");
                    }
                }
                return res.text();
        })
        .then(data => {
                resolve(data);
        })
        .catch(err => {
                console.log("Could not fetch the data" + err);
                reject("net_error");
        })

    })

    const usePopUp = (item) => {

        popup = document.createElement("div");
        let name = item.parentNode.children[1].innerText;
        popup.classList.add("popup");
        popup.innerHTML = `
            <p>Dow you want to delete ${name}?</p> 
            <div>
                <p>Yes</p>
                <p>Cancel</p>
            </div>
        `;
        page.appendChild(popup);
        updatePopupAnswers(item);

    }

    const updatePopupAnswers = (item) => {
        let popupBtns = document.querySelectorAll(".popup>div>p");
        popupBtns[0].addEventListener("click", () => {deleteItem(item);popup.remove()});
        popupBtns[1].addEventListener("click", () => {popup.remove()})

    }

    const getItems = async () => {

        query = `./php/items.php?order=${orderBy.value}&offset=${offset}&field=${searchFieldValue}&search=${searchTermValue}`;

        resData = await useFetch(query);

        if(resData === "net_error"){
            console.log("Request error");
        }else{
            if(resData == 0){
                sendError("There is no date about " + searchTerm.value); 
                table.innerHTML = "";
            }else{
                sendError();

                newData = resData.split("+",2);
                lastPage = Math.ceil(newData[0] / 8);

                table.innerHTML = newData[1];

                ownerLinkUpdate();
                editBtnUpdate();
                deleteBtnUpdate();
            }
        }

    }

    const editItem = async (item) => {

        attField = item.parentNode.children[6];
        magField = item.parentNode.children[7];

        if(attField.hasAttribute("contenteditable") === true){
            query = `./php/items.php?edit=${item.innerText}&att=${attField.innerText}&mag=${magField.innerText}`;
            resData = await useFetch(query);

            if(resData === "net_error"){
                console.log("Request error");
            }else{
                if(resData == false){
                    sendError("Could not update the item");
                }else{
                    sendError();
                }
            }
           attField.removeAttribute("contenteditable"); 
           magField.removeAttribute("contenteditable"); 
        }else{
           attField.setAttribute("contenteditable", "true"); 
           magField.setAttribute("contenteditable", "true"); 
        }

    }

    const deleteItem = async (item) => {
        
        query = `./php/items.php?delete=${item.innerText}`;
        resData = await useFetch(query);

        if(resData === "net_error"){
            console.log("Request error");
        }else{
            if(resData == false){
                sendError("Could not delete the item"); 
            }else{
                sendError();
                item.parentNode.remove();
            }
        }

    }

    const editBtnUpdate = () => {
        editBtns = document.querySelectorAll(".item_edit");
        editBtns.forEach(btn => {
            btn.addEventListener("click", () => {editItem(btn.parentNode.children[0])});
        })

    }

    const deleteBtnUpdate = () => {
        deleteBtns = document.querySelectorAll(".item_delete");
        deleteBtns.forEach(btn => {
            btn.addEventListener("click", () => {usePopUp(btn.parentNode.children[0])});
        })
    }

    const logout = async () => {

        resData = await useFetch("./php/logout.php?logout=1");

        if(resData === "net_error"){
            console.log("Request error");
        }else{
            if(resData == true){
                    location.href = "index.php";
            }
        }

    }

    const searchItem = (e) =>{

        if(e?.key === "Enter" || e?.button === 0){
            if(searchTerm.value.length>0){
                currentPage = 0;
                offset = currentPage * 8;

                searchTermValue = searchTerm.value;
                searchFieldValue = searchField.value;

                getItems();
                sendError();
            }else{
                sendError("The search input is empty");
            }
        }

    }

    const sendError = (error = 0) => {

        if(error === 0 ){
            errorLabel.style.display = "none";
        }else{
            errorLabel.innerText = error;
            errorLabel.style.display = "block";
        }

    }

    const changePage = (dir) => {

        if(dir === -1 && currentPage > 0){
            currentPage--;
        }else if(dir === 1 && currentPage < lastPage-1){
            currentPage++;
        } 

        offset = currentPage * 8;

        getItems();

    }

    const prevPage = () =>{
        changePage(-1);
    }

    const nextPage = () =>{
        changePage(1);
    }

    const getItemByOwner = (owner) => {

        searchTermValue = owner;
        searchFieldValue = "owner";
        currentPage = 0;
        offset = 0;
        getItems();

    }

    const refresh = () => {
        searchTermValue = "";
        searchFieldValue = "name";
        currentPage = 0;
        offset = 0;
        getItems();
    }

    const ownerLinkUpdate = () => {
        owners = document.querySelectorAll("td.owner_name");
        owners.forEach( owner => {
            owner.addEventListener("click", () => getItemByOwner(owner.innerText));
        });

    }

    //Events
    orderBy.addEventListener("change", getItems);
    searchTerm.addEventListener("keydown", searchItem);
    submitBtn.addEventListener("click", searchItem);
    arrowPrev.addEventListener("click", prevPage);
    arrowNext.addEventListener("click", nextPage);
    logoutBtn.addEventListener("click", logout);
    refreshBtn.addEventListener("click", refresh);

    form.addEventListener("submit", e => {
        e.preventDefault();
    })

    window.addEventListener("load", getItems);

    

})(window, document);

