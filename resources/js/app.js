import "./bootstrap";
import Alpine from "alpinejs";
import EasyMDE from "easymde";
import "easymde/dist/easymde.min.css";

// Make EasyMDE available globally for your Alpine component
window.EasyMDE = EasyMDE;

// If You want Alpine's instance to be available globally.
// window.Alpine = Alpine;

// Alpine.start();
document.addEventListener("alpine:init", () => {
    Alpine.directive("swipe-close", (el, { expression }, { evaluate }) => {
        let startX = 0;
        el.addEventListener(
            "touchstart",
            (e) => (startX = e.touches[0].clientX)
        );
        el.addEventListener("touchend", (e) => {
            if (e.changedTouches[0].clientX - startX > 80) evaluate(expression);
        });
    });
});
