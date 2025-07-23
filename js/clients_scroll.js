document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".tooltip-carousel");
  const track = carousel.querySelector(".carousel-track");
  const wrappers = Array.from(track.children).slice(0);
  const wrapperCount = wrappers.length;

  // Clone original elements once only
  wrappers.forEach(wrapper => {
    const clone = wrapper.cloneNode(true);
    track.appendChild(clone);
  });

  let index = 0;
  let interval;

  let wrapperWidth = wrappers[0].getBoundingClientRect().width + 60;

  const recalculateWidth = () => {
    wrapperWidth = wrappers[0].getBoundingClientRect().width + 60;
  };

  window.addEventListener("resize", recalculateWidth);

  const stepScroll = () => {
    index++;
    track.style.transition = 'transform 0.3s ease-in-out';
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
    if (!interval) interval = setInterval(stepScroll, 5000);
  };

  const stopScrolling = () => {
    clearInterval(interval);
    interval = null;
  };

  carousel.addEventListener("mouseover", stopScrolling);
  carousel.addEventListener("mouseout", startScrolling);

  recalculateWidth();
  startScrolling();
});
