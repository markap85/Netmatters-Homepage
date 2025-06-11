
  document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.querySelector(".tooltip-carousel");
    const track = carousel.querySelector(".carousel-track");
    const wrappers = Array.from(track.children);
    const wrapperCount = wrappers.length;

    // Clone for seamless scroll
    wrappers.forEach(wrapper => {
      track.appendChild(wrapper.cloneNode(true));
    });

    let index = 0;
    let interval;
    const wrapperWidth = wrappers[0].getBoundingClientRect().width + 100;

    const stepScroll = () => {
      index++;
      track.style.transition = 'transform 0.6s ease-in-out';
      track.style.transform = `translateX(-${index * wrapperWidth}px)`;

      if (index >= wrapperCount) {
        setTimeout(() => {
          track.style.transition = 'none';
          track.style.transform = 'translateX(0)';
          index = 0;
        }, 650);
      }
    };

    const startScrolling = () => {
      if (!interval) interval = setInterval(stepScroll, 2500);
    };

    const stopScrolling = () => {
      clearInterval(interval);
      interval = null;
    };

    carousel.addEventListener("mouseover", stopScrolling);
    carousel.addEventListener("mouseout", startScrolling);

    startScrolling();
  });