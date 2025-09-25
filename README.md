# Sistema de Gestão de Funcionários em PHP

Este é um projeto acadêmico desenvolvido como atividade de faculdade para praticar **funções, classes e POO** em PHP, integrando **SQL** para persistência de dados.

O sistema permite:
- Fazer login com uma conta de usuário.
- Criar um novo funcionário.
- Editar dados de um funcionário existente.
- Excluir um funcionário.
- Desconectar-se do sistema (logout).

Ele utiliza algumas técnicas importantes:
- **Roteamento** através do arquivo `index.php`.
- **Configuração de rotas** definidas no projeto.
- **Arquitetura de pastas organizada** para separar lógica, páginas e recursos (ex.: CSS, JS).

---

## Estrutura de Pastas

Atividade_18-09/
├─ config/ # Arquivos de configuração (paths, sessão);
├─ pages/ # Páginas do sistema (login, dashboard, cadastro, edição);
├─ src/ # CSS, incluindo input.css e output.css do Tailwind;
├─ models/ # Onde são armazenados os modelos de classe;
├─ controllers/ # Controle de funções e manipulação de dados;
├─ db/ # Configuração do banco de dados;
├─ tests/ # Uma pasta de testes para algumas funcionalidades ou rotas;
├─ index.php # Roteador principal;
├─ tailwind.config.js;
├─ postcss.config.js;
└─ README.md;
---

## Tecnologias Utilizadas

- XAMPP servidor Apache;
- PHP 7.x ou superior;
- SQL (MySQL);
- Tailwind CSS;
- Node.js (para compilar Tailwind);
- Git (controle de versão);

---

## Instalação e Execução

1. Clone este repositório:
```bash
git clone <URL_DO_REPOSITORIO>
```
2. Acesse a pasta do projeto
```bash
cd Atividade_18-09
```
3. Instale as dependências do Tailwind
```bash
npm install
```
4. Compile o CSS do tailwind (modo Watch para desenvolvimento)
```bash
npx tailwindcss -i ./src/input.css -o ./src/output.css --watch
```
5. Abra o projeto no XAMPP ou outro servidor local, acessando:
```bash
http://localhost/Atividade_18-09/
```

---

## Observações

- Não é necessário subir node_modules para o Git (veja .gitignore).
- O arquivo output.css é gerado automaticamente pelo Tailwind.
- Este projeto é uma atividade acadêmica e não deve ser usado em produção sem ajustes de segurança.

---

## Contato/Autor

- Projeto desenvolvido por Pedro Perrenoud como atividade de faculdade;

