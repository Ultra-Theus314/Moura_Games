function loadPagePublic(page) {
    const content = document.getElementById('content');
    fetch(`public/${page}`)
        .then(response => response.text())
        .then(data => {
            content.innerHTML = data;
        })
        .catch(error => {
            content.innerHTML = '<p>Erro ao carregar a página.</p>';
        });
}

function loadPagePrivate(page) {
    const content = document.getElementById('content');
    fetch(`private/${page}`)
        .then(response => response.text())
        .then(data => {
            content.innerHTML = data;
        })
        .catch(error => {
            content.innerHTML = '<p>Erro ao carregar a página.</p>';
        });
}

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
;
