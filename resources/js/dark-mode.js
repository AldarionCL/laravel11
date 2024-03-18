var dark_mode_toggle = document.getElementById("dark-mode");
var icon_mode_dark = document.getElementById("icon-mode-dark");
var root_html = document.querySelector("html");

var dark;

if (localStorage.theme === 'dark') {
    root_html.classList.add('dark')
    dark = true;
} else {
    root_html.classList.remove('dark')
    dark = false;
}

dark_mode_toggle.addEventListener("click", function () {

    dark = !dark;

    dark_mode_toggle.setAttribute("manual", "true");

    if (dark) {
        root_html.classList.add("dark");
        icon_mode_dark.classList.remove('fa-moon-o')
        icon_mode_dark.classList.add('fa-sun-o')
        localStorage.setItem('theme', 'dark');
    } else {
        root_html.classList.remove("dark");
        icon_mode_dark.classList.remove('fa-sun-o')
        icon_mode_dark.classList.add('fa-moon-o')
        localStorage.setItem('theme', 'light');
    }

});
