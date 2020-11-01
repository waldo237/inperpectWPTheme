
const moreAboutMe = document.querySelectorAll(".lazy-effect");
    moreAboutMe.forEach((item) => {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) =>
          (entry.isIntersecting && !item.classList.contains('fadeInUpx')) ? item.classList.add("fadeInUpx") : ""
        );
      });
      observer.observe(item);
    }, { rootMargin: "100px" })

