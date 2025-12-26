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
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('openInventory') === '1') {
            console.log('Auto-opening inventory from URL parameter');
            openModal.setAttribute('src', '/res/sacImg/sac_ouvert_plein.png');
            modal.classList.remove('hidden');
        }
    } else {
        console.error('Missing modal elements!');
    }
});

