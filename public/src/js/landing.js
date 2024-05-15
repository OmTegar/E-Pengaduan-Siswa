let sections = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header nav div div ul li a');

window.onscroll = () => {
    sections.forEach(sec => {
        let top = window.scrollY;
        let offset = sec.offsetTop - 100;
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('text-biru','dark:text-white','lg:text-biru','bg-biru','lg:bg-transparent','rounded','text-white');
                links.classList.add('text-gray-700', 'border-b', 'border-gray-100', 'hover:bg-gray-50', 'lg:hover:bg-transparent', 'lg:border-0', 'lg:hover:text-biru','dark:text-gray-400', 'lg:dark:hover:text-white', 'dark:hover:bg-gray-700', 'dark:hover:text-white', 'lg:dark:hover:bg-transparent', 'dark:border-gray-700');
                document.querySelector('header nav div div ul li a[href*='+id+']').classList.remove('text-gray-700', 'border-b', 'border-gray-100', 'hover:bg-gray-50', 'lg:hover:bg-transparent', 'lg:border-0', 'lg:hover:text-biru','dark:text-gray-400', 'lg:dark:hover:text-white', 'dark:hover:bg-gray-700', 'dark:hover:text-white', 'lg:dark:hover:bg-transparent', 'dark:border-gray-700');
                document.querySelector('header nav div div ul li a[href*='+id+']').classList.add('text-biru','dark:text-white','lg:text-biru','bg-biru','lg:bg-transparent','rounded','text-white');
            });   
        }
        
    });
};
