# BlackCoffeePHP 2017
  - Framework gerador de classes.
  - v2.0.
  - Atualizado 10/08/2017.
  - Ferramenta Livre.
  - Atualmente só funciona para banco MySQL.

# Instruções para rodar o projeto
  Existem duas formas de rodar este projeto:
  * A primeira você deve ter um ambiente php configurado e colocar esse projeto dentro do seu servidor e acessar via navegador
  * A segunda é via docker, que é a mais prática devido todo ambiente já estar configurado e apenas ser necessário subir o container,
  nesse caso também é necessário que tenha o docker e o docker-compose configurados na sua máquina.

  Vamos fazer os passo para a forma via docker:
  1. Clone este projeto na sua máquina
  2. Via terminal navegue até a pasta do projeto
  3. Dentro da raiz do projeto via terminal rode o seguinte
  ```sh
  docker-compose -f docker-compose/docker-compose.yaml up -d
  ```
  4. Se tudo estiver ok no seu ambiente os containers do projeto devem ser levantados, para verificar se os containers desse docker-compose estão up utilize o seguinte comando:
  ```sh
  docker-compose ps
  ```
  5. O projeto irá rodar na porta `3132`, então no seu navegador digite:
  >localhost:3132
  6. Se tudo deu certo você deve ver a interface do BlackCoffeePHP.

# Quem desenvolve ?
  Olá! Eu sou Adelson Guimarães criador deste projeto, seja bem vindo!
  Trabalho desde de 2015 com desenvolvimento em PHP, JavaDesktop, Mobile com Ionic, tenho conhecimento também com BootStrap,
  AngularJS, JQuery.
  
  Contato: adelsonguimaraes@gmail.com

# O que é o BlackCoffee ?
  O projeto é baseado em funcionalidade "ormlite", ele a partir de um banco de dados MySQL, acessa as tabelas, 
  varre os campos e em seguida gera as classes que são necessárias em uma estrutura MVC de PHP para utilização de 
  um CRUD, Cadastro, Atualização, Listagem e Remoção de valores do banco de dados.

# O que eu preciso para rodar a ferramenta ?
  É necessário ter um ambiente de programação PHP com um servidor como APACHE rodando local no computador, é recomendado
  que o usuário tenha um pouco de conhecimento com PHP, também pode ser utilizado o XAMPP ou WAMP para facilitar esse
  processo, é muito fácil encontrar tutoriais na internet explicando como fazer esse processo.
  Também é preciso que o MySql do servidor seja 5.2 ou superior, pois a ferramenta utiliza o mysqli.

# Qual as bases de padrão utilizados nesse projeto ?
  Esse projeto foi criado por uma grande necessidade pessoal em agilizar o processo de criação de classes backend dos projetos,
  dependendo do tamanho do banco de dados e sua quantidades de tabelas, a criação manual das classes poderia levar até em torno
  de 2 semanas, e com a criação do BlackCoffee esse tempo foi completamente reduzido em 90%, pois a ferramenta cria as classes
  em segundos, tendo assim um grande ganho de tempo para atacar em outras partes do projeto como Regras de Negócio.
  A base de padrão utilizada nesse projeto foi a mesma que utilizo hoje em meus projetos e que utilizo na empresa que trabalho,
  um padrão já validado a anos e que para mim é uma das melhores estruturas que já trabalhei.

# Como são criados esses arquivos ?
  A ferramenta inicialmente irá criar dentro da raiz do próprio projeto uma pasta denominada "src", então dentro 
  desse diretório ele irá colocar todos os arquivos que serão gerados.
  
# Quais arquivos são gerados ?
  1. Estrutura MVC, Model, DAO, Controls de todas as tabelas;
  2. Classes Rest Full de todas as tabelas;
  3. Classe de Conexão(MySQl);
  4. Classe de Tratamento de Erros MySql;
  5. Classe de AutoLoad, utilizando a função de auto_load do PHP para carregar classes no momento em que são declaradas;
  6. Classe SuperDAO para tratamento de erros com retornos para a interface.
  7. Classes de Teste, para que o possam ser testadas as funcionalidade do Projeto gerado, tendo as funções de Cadastrar,
  Deletar, BuscarPorId e Atualizar, após a Geração das Classes a ferramenta automáticamente redireciona para a Home de
  Testes, onde há uma lista com todas as classes e pode-se acessar cada uma das telas para testar o CRUD de cada class.
  
# As Classes de testes podem ser reaproveitadas para produção ?
  As classes são feitas com Html, Bootstrap e JQuery, podem sim ser aproveitadas para a produção, porém, será necessário
  eidita-las da forma que o projeto exija, pois elas são muito simples e praticamente serve para que o utilizador possa testar
  as classes que foram criadas e ver se a comunicação entre elas está com boa funcionalidade.
  
# Qualquer pessoa pode utilizar está ferramenta ?
  Está ferranta é muito simples de ser utilizada, porém é necessário que o usuário tenha o mínimo conhecimento de PHP, REST,
  MVC, JQUERY.
  
# Para qual tipo de usuário está ferramenta é recomendada ?
  É recomendada a usuário iniciantes e avançados, para grandes projetos e para estudo, estudantes que estão inciando os estudos
  com PHP terão uma grande facilidade em entender como funciona o fluxo dos projetos com a estrutura que está ferramenta cria,
  facilitando o aprendizado.
