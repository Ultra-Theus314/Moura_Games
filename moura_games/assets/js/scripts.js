document.addEventListener('DOMContentLoaded', () => {
    // Adiciona um listener de clique a todos os links da navbar
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault(); // Impede o comportamento padrão do link

            // Obtém o id da seção para mostrar
            const sectionId = e.target.getAttribute('data-section');
            showSection(sectionId);
        });
    });

    function showSection(id) {
        // Esconde todas as seções
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });

        // Mostra a seção selecionada
        const sectionToShow = document.getElementById(id);
        if (sectionToShow) {
            sectionToShow.style.display = 'block';
        }
    }

    // Mostra a seção padrão ao carregar a página
    showSection('home');

    // Adiciona funcionalidade de clique para o botão do dropdown
    document.querySelectorAll('.dropbtn').forEach(dropbtn => {
        dropbtn.addEventListener('click', () => {
            const dropdownContent = dropbtn.nextElementSibling;
            dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
        });
    });

    // Fecha o dropdown se o usuário clicar fora dele
    window.addEventListener('click', (event) => {
        if (!event.target.matches('.dropbtn')) {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(dropdown => {
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            });
        }
    });
});
