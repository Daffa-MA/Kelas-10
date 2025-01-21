// Add any JavaScript functionality here
document.addEventListener('DOMContentLoaded', function() {
    console.log("TROPIZZ Parfume website loaded.");
});

fetch('toggle_wishlist.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'product_id=' + productId
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        const wishlistBtn = document.querySelector('.wishlist-btn');
        wishlistBtn.classList.toggle('active');
        // Optional: Show success message
        alert(data.message);
    } else if (data.redirect) {
        // Redirect to login if user is not authenticated
        window.location.href = data.redirect;
    } else {
        // Show error message
        alert(data.message);
    }
})
.catch(error => {
    console.error('Error:', error);
    alert('An error occurred while updating the wishlist');
});