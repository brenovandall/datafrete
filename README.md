# Olá, Datafrete!

Primeiramente, gostaria de me apresentar. Me chamo Breno Van-Dall e estou no mercado de T.I a um pouco mais de 1 ano.
Comecei meus estudos em desenvolvimento de software exatamente há um ano, e desde então, tenho me aprofundado em .NET em seu todo, desde a construção de uma API até a construção de microsserviços com CQRS, orquestração, docker, RDS, etc. Neste teste prático me desafiei a construir o sistema proposto desde o princípio, tendo em vista que este foi meu primeiro contato com PHP e VueJS.
Tech technologies: PHP, VueJS3, Phinx, Docker, Laragon e MariaDB.

# Setup

Primeiramente, devemos instalar o Laragon (plataforma de desenvolvimento local para Windows que facilita a configuração de um projeto PHP) para seguir com o clone do repositório. Você pode fazer a instalação a partir deste link: https://laragon.org/download/index.html. Caso você tenha qualquer dificuldade ou precise de ajuda adicional, consulte a documentação oficial: https://laragon.org/docs/install.html.
Após isto, você deve localizar o diretório em que o Laragon foi instalado (geralmente na partição de disco C:), e então, navegue até o diretório ~\\laragon\\www. Inicie uma janela do git bash dentro deste diretório, e execute o comando: 
```sh
git clone https://github.com/brenovandall/datafrete.git
```
Depois disto, inicie o Laragon.

# Docker

Após clonar o repositório, certifique-se que você tem o Docker Desktop instalado (em caso de Windows ou Mac), caso não tenha, utilize a documentação oficial para obter o docker desktop: https://docs.docker.com/desktop/install/windows-install/, certifique-se de instalar o WSL também.

O próximo passo será executar o arquivo compose já configurado no projeto. Então, abra o terminal e vá até a pasta root do projeto:
```sh
C:\laragon\www\datafrete
```

Na pasta do projeto, execute o comando:
```sh
docker compose up
```

Este comando irá criar as imagens do banco de dados MariaDB e Adminer, rodando nas portas 3606 e 8080, respectivamente. (O Docker desktop deve estar aberto para o comando ser executado). Agora, você já pode acessar o Adminer através da URL http://localhost:8080/.
System: MySQL
Server: mysql
Username: root
Password: root
Database: datafrete

Para a criação das tabelas no banco de dados, vamos utilizar o Phinx. Você deve executar este comando no terminal do windows dentro do diretório do projeto:
```sh
vendor/bin/phinx migrate
```

No linux:
```sh
vendor\bin\phinx migrate
```

Este comando irá realizar a criação das tabelas no banco de dados.

# Vue

Para iniciar o vue, devemos ir até o diretório datafrete-ui no terminal:
```sh
cd C:\laragon\www\datafrete\ui\datafrete-ui
```

Na pasta do projeto, execute o seguinte comando no terminal:
```sh
npm run dev
```
Caso o npm não seja instalado automaticamente, execute também:
```sh
npm install
```

E então, o projeto estará disponível em http://localhost:5173.
