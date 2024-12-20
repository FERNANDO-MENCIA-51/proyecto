
        // Fecha actual
        function updateDate() {
            const now = new Date();
            document.getElementById('currentDate').textContent = now.toLocaleDateString('es-ES', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
        updateDate();
        setInterval(updateDate, 1000);

        // Modo oscuro
        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            const icon = document.querySelector('.theme-toggle i');
            icon.classList.toggle('fa-moon');
            icon.classList.toggle('fa-sun');
        }