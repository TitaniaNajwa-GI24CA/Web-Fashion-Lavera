<script>
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if(menuToggle && navMenu){
        menuToggle.addEventListener('click', function () {
            navMenu.classList.toggle('active');
        });
    }

    window.addEventListener('scroll', function(){

        const navbar = document.querySelector('.navbar');

        if(navbar){
            if(window.scrollY > 40){
                navbar.classList.add('navbar-scrolled');
            } else{
                navbar.classList.remove('navbar-scrolled');
            }
        }

    });
</script>

<script src="<?= base_url('assets/aos/aos.js'); ?>"></script>

<script>
    AOS.init({
        duration: 900,
        once: true,
        offset: 120
    });

    const notifBtn =
        document.getElementById("notificationToggle");

    const notifDropdown =
        document.getElementById("notificationDropdown");

    if(notifBtn){

        notifBtn.addEventListener("click", function(e){

            e.stopPropagation();

            notifDropdown.classList.toggle("active");

        });

        document.addEventListener("click", function(){

            notifDropdown.classList.remove("active");

        });

    }
</script>
<script src="<?= base_url('assets/js/pop-up.js'); ?>"></script>


</body>
</html>