// Setup the image lazy loader
let observer = new IntersectionObserver(function(entries, self) {
    // Loop through each tracked image element
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // This image is currently about to enter the browser viewport

            // Load the image from the "data-src" attribute completely
            // before copying it to the "src" attribute so that the browser displays it
            var image = entry.target;
            var downloadingImage = new Image();
            downloadingImage.onload = function() {
                entry.target.src = this.src;   
            };
            downloadingImage.src = entry.target.dataset.src;

            // This image is loaded, stop monitoring it
            self.unobserve(entry.target);
        }
    });
}, {
    rootMargin: '0px 0px 50px 0px',
    threshold: 0
});

// Extract and track the state of the relevant image elements
const imgs = document.querySelectorAll('[data-src]');
imgs.forEach(img => {
    observer.observe(img);
});
