// This script creates a seamless scrolling effect for accreditation logos on the homepage
  document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".carousel-track");
    const logos = Array.from(track.children);
    const logoCount = logos.length;

    // Duplicate all logos once for seamless looping
    logos.forEach(logo => {
      const clone = logo.cloneNode(true);
      track.appendChild(clone);
    });

    let index = 0;
    const logoWidth = logos[0].getBoundingClientRect().width + 100; // 100px gap

    const scrollStep = () => {
      index++;
      track.style.transition = 'transform 0.3s ease-in-out';
      track.style.transform = `translateX(-${index * logoWidth}px)`;

      // Seamlessly reset after scrolling through the original set
      if (index >= logoCount) {
        setTimeout(() => {
          track.style.transition = 'none';
          track.style.transform = 'translateX(0)';
          index = 0;
        }, 650); // Just after transition ends
      }
    };

    // Trigger the scroll every 2.5s
    setInterval(scrollStep, 5000); // 5000ms = 5 seconds
  });
