document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".stats-number");
    const speed = 200; // Adjust speed (Lower is faster)

    const startCounting = (counter) => {
        const target = +counter.getAttribute("data-target");
        let count = 0;
        const increment = Math.ceil(target / speed);

        const updateCount = () => {
            count += increment;
            counter.innerText = count;
            if (count < target) {
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = target; // Set final value
            }
        };

        updateCount();
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                if (!counter.dataset.started) {
                    counter.dataset.started = true;
                    startCounting(counter);
                }
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        counter.innerText = "0"; // Reset to 0
        observer.observe(counter);
    });
});


//registration form reset

function resetForm() {
    document.getElementById("registrationForm").reset();
}

//shop slider


// Get the slider, max price display, and reset button elements
const priceRange = document.getElementById('priceRange');
const maxPrice = document.getElementById('maxPrice');
const resetButton = document.querySelector('.btn-outline-secondary');

// Update the price display when the slider is moved
priceRange.addEventListener('input', function() {
    maxPrice.textContent = priceRange.value;
});

// Reset the price range and display when the reset button is clicked
resetButton.addEventListener('click', function() {
    priceRange.value = 0; // Reset the slider value
    maxPrice.textContent = priceRange.value; // Update the displayed price
});

