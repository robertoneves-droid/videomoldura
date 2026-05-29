# Módulo Moodle: Vídeo com Moldura (mod_videomoldura)

Um plugin nativo para Moodle desenvolvido com o objetivo de otimizar a experiência visual e pedagógica das salas de aula virtuais. Este módulo permite que Professores e Designers Educacionais (DEs) incorporem videoaulas com um design limpo, encapsulando o conteúdo em uma moldura responsiva que simula um dispositivo digital.

## 🌟 Funcionalidades

* **Exibição Nativa (Rótulo):** O vídeo é injetado diretamente na página inicial do curso, sem exigir que o aluno clique em links externos ou carregue novas páginas.
* **Conversão Automática de Links:** Não é necessário buscar o código de incorporação (`embed`). O plugin converte automaticamente URLs padrão do YouTube.
* **Cabeçalho Personalizável:** Permite adicionar o título da aula e o nome do professor/subtítulo.
* **Seletor de Cores:** Integração com a paleta de cores HTML5 para personalizar a barra superior da moldura de acordo com a identidade visual da disciplina, suportando também a inserção direta de código HEX (ex: `#496637`).

---

## ⚙️ Requisitos do Sistema

Este plugin foi estruturado para manter compatibilidade com as versões mais recentes e estáveis do Moodle, cobrindo ambientes legados até as atualizações mais modernas.

* **Versão do Moodle:** 4.0 ou superior (Testado e homologado para Moodle 4.0.3, 4.3, 4.5 e 5.0).
* **Versão do PHP:** * Mínima recomendada: **PHP 7.4.x** (Para instâncias rodando Moodle 4.0 a 4.1).
  * Ideal / Atual: **PHP 8.0 a 8.2+** (Para instâncias rodando Moodle 4.3, 4.5 e 5.0).
* **Banco de Dados:** Totalmente compatível com PostgreSQL (incluindo a versão 15) e MySQL/MariaDB.

---

## 🚀 Instalação

### Método 1: Instalação via Painel Administrativo (Recomendado)
1. Baixe ou compacte o diretório do plugin em um arquivo `videomoldura.zip`.
2. Acesse o seu Moodle como Administrador.
3. Navegue até **Administração do Site > Plugins > Instalar plugins**.
4. Faça o upload do arquivo `.zip` e selecione o tipo de plugin como `Módulo de Atividade (mod)`.
5. Siga os passos na tela para atualizar o banco de dados do Moodle.

### Método 2: Instalação Manual (Via Servidor/Terminal)
1. Extraia o conteúdo deste repositório/pasta.
2. Copie a pasta inteira `videomoldura` para dentro do diretório `/mod/` da sua instalação Moodle. O caminho final deve ser: `[diretorio_moodle]/mod/videomoldura/`.
3. Acesse o Moodle pelo navegador como Administrador. O sistema detectará automaticamente o novo plugin e solicitará a atualização do banco de dados.
4. Clique em **Atualizar banco de dados Moodle agora**.

> **Aviso de Cache:** Após a instalação ou atualização de qualquer arquivo do plugin, é estritamente necessário navegar até **Administração do site > Desenvolvimento > Limpar todos os caches** para que as alterações visuais e de idioma sejam aplicadas.

---

## 🛠️ Como Usar (Para Designers Educacionais)

1. Em um curso, ative o **Modo de Edição**.
2. Clique em **Adicionar uma atividade ou recurso**.
3. Selecione a ferramenta **Vídeo com Moldura**.
4. Preencha os campos obrigatórios:
   * **Nome:** O título principal que aparecerá acima do vídeo.
   * **URL do Vídeo:** Cole o link direto do YouTube.
5. Preencha os campos opcionais (Design):
   * **Descrição / Nome do Professor:** Texto secundário exibido logo abaixo do título.
   * **Cor da Borda e Título:** Utilize a paleta de cores ou digite o HEX desejado para combinar com o curso.
6. Clique em **Salvar e voltar ao curso**.

---

## 📁 Estrutura de Arquivos

* `/db/install.xml`: Estrutura da tabela de banco de dados (`mdl_videomoldura`) e seus campos personalizados.
* `/lang/`: Arquivos de internacionalização (`en` e `pt_br`).
* `/pix/`: Contém o ícone oficial do plugin (`icon.svg` ou `icon.png`).
* `lib.php`: Funções vitais do módulo, incluindo a injeção do HTML (`get_coursemodule_info`) para o comportamento de rótulo.
* `mod_form.php`: Definição dos campos do formulário de configuração.
* `view.php`: Página de visualização estendida e tratamentos de fallback.
* `version.php`: Controle de versão e dependências do plugin.

---

## 👥 Créditos
Desenvolvido internamente pela equipe de **Suporte TI / AVA Moodle da SEAD** para otimização de rotinas de design educacional.