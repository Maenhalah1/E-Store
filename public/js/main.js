(function(){

    var usernameField = document.querySelector(".checkUsernameAjax");
    if(usernameField.value != null){
        usernameField.addEventListener('blur', function(){
            var req = new XMLHttpRequest();
            req.open('POST', "http://www.estore.com/users/checkUserExistsAjax");
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            req.onreadystatechange = function(){
                if(this.readyState == this.DONE && this.status == 200){
                    if(this.responseText == 1){
                        // var ele = document.createElement("i");
                        // ele.innerHTML = "fa fa-times";
                        // console.log(usernameField.parentElement.appendChild(ele));
                    }else if(this.responseText == -1){

                    }
                }
            }
            req.send("username="+ usernameField.value);
        }, false);
    }
})();

