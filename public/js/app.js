document.addEventListener('DOMContentLoaded', function() {

    // --- منطق منوی سایدبار ---
    const menuItems = document.querySelectorAll('.sidebar-menu .has-submenu > a');
    menuItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const parentLi = this.parentElement;

            // بستن سایر منوهای باز
            document.querySelectorAll('.sidebar-menu .has-submenu.open').forEach(openMenu => {
                if(openMenu !== parentLi) {
                    openMenu.classList.remove('open');
                }
            });

            // باز/بسته کردن منوی فعلی
            parentLi.classList.toggle('open');
        });
    });

    // --- منوی کشویی پروفایل ---
    const dropdownToggle = document.getElementById('profile-dropdown-toggle');
    if (dropdownToggle) {
        dropdownToggle.addEventListener('click', function(event) {
            event.stopPropagation(); 
            this.classList.toggle('active');
        });

        window.addEventListener('click', function() {
            if (dropdownToggle.classList.contains('active')) {
                dropdownToggle.classList.remove('active');
            }
        });
    }

    // --- منوی همبرگری برای سایدبار ---
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('closed');
        });
    }

});