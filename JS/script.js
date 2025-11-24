// Configuration Tailwind CSS
tailwind.config = {
    theme: {
        extend: {
            colors: {
                medieval: {
                    dark: '#1a1614',
                    brown: '#2d2520',
                    gold: '#d4af37',
                    lightgold: '#f4e5c3',
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
});