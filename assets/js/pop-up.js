document.addEventListener("DOMContentLoaded", function(){

    const modal = document.getElementById('laveraAlertModal');

    if(modal){
        setTimeout(function(){
            modal.remove();
        }, 2200);
    }

});

document.addEventListener("DOMContentLoaded", function(){

    const openBtn = document.getElementById("openProfileModal");
    const closeBtn = document.getElementById("closeProfileModal");
    const modal = document.getElementById("profileModal");

    if(openBtn && closeBtn && modal){

        openBtn.addEventListener("click", function(e){
            e.preventDefault();
            modal.classList.add("active");
        });

        closeBtn.addEventListener("click", function(){
            modal.classList.remove("active");
        });

        modal.addEventListener("click", function(e){
            if(e.target === modal){
                modal.classList.remove("active");
            }
        });
    }

});

document.addEventListener("DOMContentLoaded", function(){

    const openLogoutModal =
    document.getElementById("openLogoutModal");

    const closeLogoutModal =
    document.getElementById("closeLogoutModal");

    const logoutModal =
    document.getElementById("logoutModal");

    if(openLogoutModal){

        openLogoutModal.addEventListener("click", function(e){

            e.preventDefault();

            logoutModal.classList.add("active");

        });

    }

    if(closeLogoutModal){

        closeLogoutModal.addEventListener("click", function(){

            logoutModal.classList.remove("active");

        });

    }

    if(logoutModal){

        logoutModal.addEventListener("click", function(e){

            if(e.target === logoutModal){

                logoutModal.classList.remove("active");

            }

        });

    }

});

document.addEventListener("DOMContentLoaded", function(){

    const openForgot = document.getElementById("openForgotModal");
    const closeForgot = document.getElementById("closeForgotModal");
    const forgotModal = document.getElementById("forgotModal");

    if(openForgot && closeForgot && forgotModal){

        openForgot.addEventListener("click", function(e){
            e.preventDefault();
            forgotModal.classList.add("active");
        });

        closeForgot.addEventListener("click", function(){
            forgotModal.classList.remove("active");
        });

        forgotModal.addEventListener("click", function(e){
            if(e.target === forgotModal){
                forgotModal.classList.remove("active");
            }
        });
    }

});