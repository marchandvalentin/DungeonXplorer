// Configuration Tailwind CSS
tailwind.config = {
    theme: {
        extend: {
            colors: {
                medieval: {
                    dark: '#1a1614',
                    brown: '#2d2520',
                    red: '#c62828',
                    lightred: '#fc9e9eff',
                    cream: '#e8d4b0',
                }
            }, 
            fontFamily: {
                'inter': ['Inter', 'sans-serif'],
            }
        }
    }
};

// Fonction d'initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    console.log('DungeonXPlorer initialized! 🏰');
    
    // Check for notification parameter (should run on all pages)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('notification') === 'hpFull') {
        console.log('Notification parameter found: hpFull');
        showNotification('Votre vie est déjà pleine');
    }
    
    // Ajout d'animations supplémentaires ou fonctionnalités JavaScript ici
    
    // Modal inventory setup
    const openModal = document.getElementById('openInventoryModal');
    const modal = document.getElementById('inventoryModal');
    const closeModal = document.getElementById('closeInventoryModal');

    console.log('Modal elements:', { openModal, modal, closeModal });

    if (openModal && modal && closeModal) {
        console.log('All modal elements found, adding event listeners');
        
        openModal.addEventListener('click', function() {
            openModal.setAttribute('src', '/res/sacImg/sac_ouvert_plein.png');
            console.log('Opening inventory modal');
            modal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', function() {
            openModal.setAttribute('src', '/res/sacImg/sac_fermé.png');
            console.log('Closing inventory modal');
            modal.classList.add('hidden');
        });
        
        // Close modal when clicking outside of it
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                console.log('Clicking outside modal, closing');
                openModal.setAttribute('src', '/res/sacImg/sac_fermé.png');
                modal.classList.add('hidden');
            }
        });
        
        // Auto-open inventory if URL parameter is present
        if (urlParams.get('openInventory') === '1') {
            console.log('Auto-opening inventory from URL parameter');
            openModal.setAttribute('src', '/res/sacImg/sac_ouvert_plein.png');
            modal.classList.remove('hidden');
        }
        
        // Clean up URL parameters
        if (urlParams.has('openInventory') || urlParams.has('notification')) {
            const newUrl = new URL(window.location);
            newUrl.searchParams.delete('openInventory');
            newUrl.searchParams.delete('notification');
            window.history.replaceState({}, '', newUrl.toString());
        }
    } else {
        console.log('Inventory modal elements not found on this page (normal for non-chapter pages)');
    }
});

// Notification functions
function showNotification(message) {
    console.log('showNotification called with message:', message);
    const toast = document.getElementById('notificationToast');
    const messageElement = document.getElementById('notificationMessage');
    
    console.log('Toast element:', toast);
    console.log('Message element:', messageElement);
    
    if (toast && messageElement) {
        messageElement.textContent = message;
        toast.classList.remove('hidden');
        console.log('Notification displayed, starting animation');
        
        // Slide in animation
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';
        }, 10);
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            hideNotification();
        }, 3000);
    } else {
        console.error('Toast or message element not found!');
    }
}

function hideNotification() {
    const toast = document.getElementById('notificationToast');
    if (toast) {
        console.log('Hiding notification');
        toast.style.transform = 'translateX(400px)';
        toast.style.opacity = '0';
        
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 500);
    }
}

