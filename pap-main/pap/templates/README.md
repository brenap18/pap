# Kiocode - Plataforma Educacional de C++

## Sobre o Projeto
O **Kiocode** é uma plataforma educacional desenvolvida em PHP que permite aos utilizadores aprender C++ através de aulas interativas. O sistema permite acompanhar o progresso dos utilizadores com um histórico das aulas frequentadas e uma barra de progresso.

## Tecnologias Utilizadas
- **PHP**: Para a lógica do servidor e gestão de utilizadores.
- **MySQL**: Para armazenar informações dos utilizadores e progresso.
- **XAMPP**: Para execução local do servidor Apache e base de dados MySQL.
- **HTML/CSS**: Para a interface da plataforma.

## Estrutura do Projeto
```
pap-main/
├── pap/
│   ├── static/
│   │   ├── images/    # Imagens do site
│   │   ├── css/       # Ficheiros CSS
│   │   ├── js/        # Scripts JavaScript
│   │   ├── db/        # Base de dados
│   │   ├── scss/      # Ficheiros SCSS para estilos
│   ├── templates/     # Ficheiros HTML/PHP reutilizáveis
│   ├── aula1.php      # Aula 1
│   ├── aula2.php      # Aula 2
│   ├── aula3.php      # Aula 3
│   ├── ...            # Outras aulas
│   ├── aulas.php      # Listagem de todas as aulas
│   ├── contact.php    # Página de contacto
│   ├── contalog.php   # Processa login
│   ├── contareg.php   # Processa registo
│   ├── db_conn.php    # Conexão com a base de dados
│   ├── index.php      # Página inicial
│   ├── login.php      # Formulário de login
│   ├── logout.php     # Terminar sessão
│   ├── register.php   # Formulário de registo
│   ├── sidebar.php    # Barra lateral
│   ├── sobre.php      # Página "Sobre"
│   ├── track_progress.php # Cálculo da barra de progresso
│   ├── utilizador.php # Perfil do utilizador
```

## Instalação e Execução
1. **Instalar o XAMPP** e iniciar o Apache e MySQL.
2. **Colocar os ficheiros** na pasta `htdocs` do XAMPP.
3. **Importar a base de dados** (caso necessário, criar um `sql` com a estrutura de tabelas).
4. **Aceder no navegador**: `http://localhost/pap-main/pap/templates/register.php`.

## Funcionalidades
- Registo e login de utilizadores.
- Listagem de aulas interativas.
- Barra de progresso que mostra o avanço do utilizador.
- Histórico de aulas frequentadas.

## Contribuição
Caso queira contribuir, faça um **fork** do repositório e envie um **pull request** com melhorias ou novas funcionalidades.

---
**Desenvolvido para o Projeto de Aptidão Profissional (PAP)**

