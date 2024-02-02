window.addEventListener('load', () => {
    const tl = gsap.timeline();

    tl
    .from('.corner-left-top', 1.5, {y: +120,x: +400,opacity: 50,ease:'power1.in'})
    .from('.corner-right-bottom', 1.5, {y: -120,x: -400,opacity: 50,ease:'power1.in'}, '-=1.5')
    .from('.titre', 1.5, {opacity: 0}, '-=0.30');


    tl.play();
})