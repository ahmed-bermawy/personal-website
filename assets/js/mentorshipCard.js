/**
 * Mentorship card functionality
 * Handles the animation and interaction of the mentorship service card
 */
document.addEventListener('DOMContentLoaded', () => {
    const mentorshipCard = document.getElementById('mentorshipCard');
    
    // Input validation for DOM elements
    if (!mentorshipCard) {
        console.error('mentorshipCard element not found');
        return;
    }
    
    // Show the mentorship card after 1 second (before the main content starts)
    setTimeout(() => {
        mentorshipCard.classList.add('show');
    }, 1000);
    
    // Auto-hide the card after 15 seconds if user doesn't interact
    const autoHideTimeout = setTimeout(() => {
        hideMentorshipCard();
    }, 30000);
    
    
    // Handle card hover to pause auto-hide
    mentorshipCard.addEventListener('mouseenter', () => {
        clearTimeout(autoHideTimeout);
    });
    
    // Resume auto-hide when mouse leaves (with shorter timeout)
    // mentorshipCard.addEventListener('mouseleave', () => {
    //     setTimeout(() => {
    //         if (mentorshipCard.classList.contains('show')) {
    //             hideMentorshipCard();
    //         }
    //     }, 3000);
    // });
    //
    /**
     * Hides the mentorship card with animation
     */
    function hideMentorshipCard() {
        mentorshipCard.classList.remove('show');
        mentorshipCard.classList.add('hide');
    }
    
    // Optional: Allow clicking outside the card to close it
    document.addEventListener('click', (e) => {
        if (!mentorshipCard.contains(e.target) && mentorshipCard.classList.contains('show')) {
            setTimeout(() => {
                hideMentorshipCard();
            }, 1000); // Small delay to avoid immediate closure
        }
    });
});