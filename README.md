O **BinaryLibrary** é uma aplicação em PHP estruturada sobre o padrão arquitetural MVC (Model-View-Controller) voltada ao gerenciamento de acervos literários. O grande diferencial técnico deste projeto é a implementação em baixo nível e aplicação prática dos algoritmos clássicos de ordenação **Quicksort** (para ordenação dos registros por critérios dinâmicos) e de busca **Busca Binária** (para localização otimizada de alta performance baseada em chaves indexadas).

Este projeto conta com um pipeline completo de **Integração Contínua (CI)** via **GitHub Actions** para execução automatizada de testes unitários utilizando o **PHPUnit**, garantindo a integridade dos algoritmos de busca e ordenação a cada modificação do código.

---

## 🛠️ Tecnologias e Dependências do Ecossistema

* **Linguagem Core:** PHP (Versão recomendada: `^8.2`)
* **Banco de Dados:** SQLite (Armazenamento leve baseado em arquivo `config/database.db`)
* **Gerenciador de Dependências:** Composer
* **Framework de Testes:** PHPUnit `^11.5` (Suíte de automação para testes de software)
* **Pipeline de CI:** GitHub Actions (Validadores de integridade e automação de scripts)

---

## 🚀 Como Executar o Projeto Localmente

Siga o passo a passo abaixo para clonar, configurar e rodar o ambiente de desenvolvimento na sua máquina.

### 1. Pré-requisitos Obrigatórios
Antes de começar, certifique-se de possuir instalado em sua máquina:
* [Git](https://git-scm.com/)
* [PHP 8.2 ou superior](https://www.php.net/downloads.php) (Garantir que as extensões `pdo_sqlite`, `mbstring` e `xml` estejam ativas no seu `php.ini`)
* [Composer](https://getcomposer.org/)

### 2. Clonar o Repositório
Abra o seu terminal e execute o comando abaixo para trazer o projeto para sua máquina:
```bash
git clone [https://github.com/seu-usuario/binarysearch-quicksort.git](https://github.com/seu-usuario/binarysearch-quicksort.git)
cd binarysearch-quicksort
```

### 3. Instalar as Dependências do Composer
O projeto utiliza mapas de classe estruturados para o Autoloading do padrão MVC e gerenciamento do ambiente do PHPUnit. Instale todas as dependências rodando:

```Bash
composer install
```
Este comando criará a pasta vendor/ e estruturará os binários necessários.

### 4. Otimizar e Gerar o Autoload
Para garantir que o PHP localize perfeitamente as classes localizadas dentro do diretório app/ e tests/ conforme configurado no composer.json, recrie o mapa estático de classes:

```Bash
composer dump-autoload
```

### 5. Iniciar o Servidor Embutido do PHP
O PHP possui um servidor web embutido ideal para testes e desenvolvimento local. Para iniciá-lo, execute:

```Bash
php -S localhost:8000
```
Agora, abra o seu navegador de preferência e acesse o endereço:
👉 http://localhost:8000

ou pode estar sendo usado o XAMPP, utilizando a pasta __htdocs__ rodando em:
```bash
http:localhost/binarysearch-quicksort
```

### 🧪 Como Executar a Suíte de Testes (PHPUnit)
Os testes cobrem os algoritmos de busca, ordenação e integridade dos Models. Para rodar a suíte completa de testes automatizados localmente, utilize o binário do PHPUnit instalado via Composer:

```Bash
./vendor/bin/phpunit
```
Caso esteja utilizando o sistema operacional Windows (via Prompt de Comando tradicional ou PowerShell) e o comando acima falhe na resolução da barra, utilize:

```DOS
vendor\bin\phpunit
```