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

function navigate(page) 
{
  const content = document.getElementById('content');
  if (page === 'cadastrar') 
  {
      content.innerHTML = `
          <div class="container_jogos">
          <section>
            <h2>Cadastrar Produto</h2>
            <hr>
            <form id="ProdForm">
            <label for="produto">Produto:</label>
            <input type="text" id="produto" name="produto" placeholder="Digite o nome do produto aqui..." required>
            <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                <option value="GAME">JOGOS</option>
                <option value="ARCADE">ARCADES</option>
                <option value="CONSOLE">CONSOLE</option>
                <option value="BONECO">MINIATURAS</option>
                <option value="ACESSORIO">ACESSORIOS</option>
            </select><br>
            <label>Plataforma: <br>
            <select name="plataforma" id="plataforma">
                <option value="PSN">PLAYSTATION</option>
                <option value="XBOX">XBOX</option>
                <option value="NINTENDINHO">NINTENDO</option>
                <option value="PC">PC</option>
            </select><br>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Digite a descrição aqui..." required></textarea>
            <label for="valor">Valor:</label>
            <input type="text" id="valor" placeholder="Digite o valor aqui..." name="valor">
            <label for="foto">Foto:</label>
            <input class="btn btn-primary" type="file" id="foto" name="foto">
            <hr>
            <input class="btn btn-primary" type="submit" name="cadastrar" value="Cadastrar" />
            <hr>
            </form>
           </section>
           </div>
`;
      document.getElementById('ProdForm').addEventListener('submit', function(event) 
      {
          event.preventDefault();
          const formData = new FormData(this);
          fetch('./cadastrar_jogos/inclusao.php', {
              method: 'POST',
              body: formData
          }).then(response => response.text()).then(data => 
          {
              alert(data);
          });
          document.getElementById("produto").value=""
          document.getElementById("tipo").value=""
          document.getElementById("plataforma").value=""
          document.getElementById("descricao").value=""
          document.getElementById("foto").value=""
          document.getElementById("valor").value=""
      });
  }
}

function navigate(page) {
    const content = document.getElementById('content');
    if (page === 'alterar') {
        fetch(`./obter_produto.php?id=${produtoId}`)
            .then(response => response.json())
            .then(data => {
                content.innerHTML = `
                    <div class="container_jogos">
                    <section>
                        <h2>Alterar Produto</h2>
                        <hr>
                        <form id="ProdForm">
                        <input type="hidden" id="produtoId" name="produtoId" value="${data.id}">
                        <label for="produto">Produto:</label>
                        <input type="text" id="produto" name="produto" value="${data.produto}" placeholder="Digite o nome do produto aqui..." required>
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="GAME" ${data.tipo === 'GAME' ? 'selected' : ''}>JOGOS</option>
                            <option value="ARCADE" ${data.tipo === 'ARCADE' ? 'selected' : ''}>ARCADES</option>
                            <option value="CONSOLE" ${data.tipo === 'CONSOLE' ? 'selected' : ''}>CONSOLE</option>
                            <option value="BONECO" ${data.tipo === 'BONECO' ? 'selected' : ''}>MINIATURAS</option>
                            <option value="ACESSORIO" ${data.tipo === 'ACESSORIO' ? 'selected' : ''}>ACESSORIOS</option>
                        </select><br>
                        <label>Plataforma: <br>
                        <select name="plataforma" id="plataforma">
                            <option value="PSN" ${data.plataforma === 'PSN' ? 'selected' : ''}>PLAYSTATION</option>
                            <option value="XBOX" ${data.plataforma === 'XBOX' ? 'selected' : ''}>XBOX</option>
                            <option value="NINTENDINHO" ${data.plataforma === 'NINTENDINHO' ? 'selected' : ''}>NINTENDO</option>
                            <option value="PC" ${data.plataforma === 'PC' ? 'selected' : ''}>PC</option>
                        </select><br>
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="4" placeholder="Digite a descrição aqui..." required>${data.descricao}</textarea>
                        <label for="valor">Valor:</label>
                        <input type="text" id="valor" value="${data.valor}" placeholder="Digite o valor aqui..." name="valor">
                        <label for="foto">Foto:</label>
                        <input class="btn btn-primary" type="file" id="foto" name="foto">
                        <hr>
                        <input class="btn btn-primary" type="submit" name="alterar" value="Alterar" />
                        <hr>
                        </form>
                       </section>
                       </div>
                `;

                document.getElementById('ProdForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(this);
                    fetch('./alterar.php', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.text()).then(data => {
                        alert(data);
                    });
                });
            });
    }
}
