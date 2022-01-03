![alt text](https://joaodaniel.space/petaxxon-blog.png)

#### O projeto consiste em um protótipo de uma rede social, com funções de base essenciais. O usuário é capaz de criar uma conta e posteriormente acessar o painel adm. É possível criar, editar e excluir posts. Também é possível interagir com outros usuários através dos comentários.


## Instalação

clone o repositório
$ git clone https://github.com/joaodaniel-ar/petaxxon_blog

acesse o diretório
$ cd petaxxon-blog

instale as dependências do projeto
$ composer install

Crie o seu arquivo .env através do comando: cp .env.example .env e insira as informações do banco de dados.

Execute o comando: $ php artisan key:generate

Execute o comando: $ php artisan migrate

E por fim, execute os comando: 

$ php artisan serve 

$ npm run watch 

para compilar os arquivos de css e js.
