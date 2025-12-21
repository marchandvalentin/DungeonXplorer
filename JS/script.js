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
    
    // Ajout d'animations supplémentaires ou fonctionnalités JavaScript ici
    
    // Modal inventory setup
    const openModal = document.getElementById('openInventoryModal');
    const modal = document.getElementById('inventoryModal');
    const closeModal = document.getElementById('closeInventoryModal');

    console.log('Modal elements:', { openModal, modal, closeModal });

    if (openModal && modal && closeModal) {
        console.log('All modal elements found, adding event listeners');
        
        openModal.addEventListener('click', function() {
            console.log('Opening inventory modal');
            modal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', function() {
            console.log('Closing inventory modal');
            modal.classList.add('hidden');
        });
        
        // Close modal when clicking outside of it
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                console.log('Clicking outside modal, closing');
                modal.classList.add('hidden');
            }
        });
    } else {
        console.error('Missing modal elements!');
    }
});

