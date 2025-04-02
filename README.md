# **Projeto de Agenda Eletrônica com CodeIgniter 4**

Este projeto é uma agenda eletrônica simples, criada com **CodeIgniter 4**, permitindo aos usuários se autenticarem, cadastrarem suas atividades, e visualizá-las em uma lista e em um calendário. O sistema suporta **login**, **cadastro**, **CRUD** de atividades e exibe um calendário interativo com **FullCalendar** (ou **TUI Calendar**, dependendo da escolha).

## **Tecnologias Utilizadas**

- **CodeIgniter 4**: Framework PHP para desenvolvimento rápido e seguro.
- **MySQL**: Banco de dados relacional para armazenar usuários e atividades.
- **TUI Calendar** (ou **FullCalendar**): Biblioteca de JavaScript para visualização de atividades no calendário.
- **Bootstrap**: Framework CSS para uma interface responsiva e simples.

## **Pré-requisitos**

1. **Laragon** instalado no seu sistema. Se você ainda não tem o **Laragon** instalado, faça o download e instale a partir do [site oficial](https://laragon.org/).
2. **Git** para clonar o repositório.

## **Passos para Executar o Projeto**

### 1. **Clonando o Repositório**

Abra o terminal (ou Git Bash) e clone o repositório para a pasta `www` do **Laragon**:

```bash
cd C:\laragon\www
git clone https://github.com/seu-usuario/seu-repositorio.git
```

Substitua `https://github.com/seu-usuario/seu-repositorio.git` pelo **URL** correto do seu repositório no GitHub.

### 2. **Configurando o Banco de Dados**

1. Abra o **Laragon** e inicie o **Apache** e o **MySQL**.
2. Acesse o **phpMyAdmin** através do **Laragon**:
   - Vá até o navegador e digite `http://localhost/phpmyadmin`.
   - Crie um banco de dados chamado `agenda_data`.
   - Importe ou crie as tabelas necessárias para o projeto. Aqui está um exemplo de uma tabela de usuários simples:

```sql
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `login` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
);

CREATE TABLE `activities` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `start_datetime` DATETIME,
  `end_datetime` DATETIME,
  `status` ENUM('pendente', 'concluida', 'cancelada') DEFAULT 'pendente',
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
```

### 3. **Configurando o Banco de Dados no CodeIgniter**

1. No projeto, abra o arquivo **`.env`** e edite as configurações do banco de dados:

```plaintext
database.default.hostname = localhost
database.default.database = agenda_data
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

2. Caso você queira usar outro banco de dados ou credenciais, altere o **`username`** e o **`password`** conforme a sua configuração do MySQL.

### 4. **Instalando as Dependências**

Se você estiver usando **composer** no projeto, navegue até o diretório do projeto e execute:

```bash
composer install
```

### 5. **Executando o Projeto com o Laragon**

Agora, para **executar o projeto no Laragon**, siga esses passos:

1. Abra o **Laragon**.
2. Vá até a pasta onde o projeto foi clonado (por padrão, será em `C:\laragon\www\seu-repositorio`).
3. No **Laragon**, clique com o botão direito na **bandeja do sistema** (ícone do Laragon).
4. Escolha **"www"** e selecione o diretório onde o seu projeto foi clonado. Isso definirá o diretório do projeto como o **diretório raiz**.
5. Em seguida, clique em **"Start All"** (para iniciar o Apache e MySQL).
6. Agora, no navegador, acesse o projeto através da URL:

```plaintext
http://localhost/seu-repositorio
```

Esse será o endereço local do seu projeto, e você verá a tela de **login** do sistema.

### 6. **Testar a Funcionalidade**

1. **Login e Cadastro**: Acesse a tela de login (`http://localhost/seu-repositorio/login`) e faça login com o usuário criado ou registre um novo.
2. **CRUD de Atividades**: Após o login, você verá a tela do **dashboard**, onde poderá cadastrar novas atividades, visualizar as existentes, editar ou excluir.
3. **Calendário**: Abaixo da lista de atividades, o **calendário** interativo será exibido com os eventos cadastrados.

### 7. **Depuração**

Se houver algum erro ao acessar o sistema, verifique o arquivo de logs do **CodeIgniter** (geralmente em **`writable/logs`**) para obter mais detalhes.

---

## **Conclusão**

Com isso, você terá o projeto totalmente configurado e em funcionamento, usando o **Laragon** para servir o projeto localmente. Basta acessar **http://localhost/seu-repositorio** para começar a usar o sistema de **login**, **cadastro**, **atividades** e **calendário**.

Qualquer dúvida ou problema durante a instalação, fique à vontade para abrir uma **issue** no GitHub ou me pedir ajuda aqui!

---

Esse **README.md** contém as instruções detalhadas para executar o seu projeto no **Laragon**, incluindo a execução via a interface do Laragon e o acesso ao projeto pelo navegador.
