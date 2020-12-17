            function addToggleEffect() {
                var sidenav = document.getElementById("sidebar");
                sidenav.classList.add("active");
            }

            function removeToggleEffect() {
                var sidenav = document.getElementById("sidebar");
                var closeSidebar = document.getElementById("sidenavClose");
                sidenav.classList.remove("active");
            }