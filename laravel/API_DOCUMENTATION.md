# API de Carrinho de Compras - Documentação

## Visão Geral
Esta API permite gerenciar um sistema de carrinho de compras com produtos, categorias, carrinhos de usuários e anúncios.

## Base URL
```
http://localhost:8080/api
```

*Nota: A aplicação roda na porta 8080 via Docker.*

## Autenticação
A API utiliza Laravel Sanctum para autenticação. Para rotas protegidas, inclua o token no header:
```
Authorization: Bearer {token}
```

## Arquitetura da API

### Padrões Utilizados
- **Repository Pattern**: Separação da lógica de acesso a dados
- **Service Layer**: Encapsulamento da lógica de negócio
- **Dependency Injection**: Injeção de dependências via Laravel Container
- **Soft Deletes**: Exclusões lógicas mantendo histórico de dados

### Estrutura do Projeto
```
app/
├── Http/Controllers/     # Controllers da API
├── Models/              # Models Eloquent
├── Repositories/        # Camada de acesso a dados
├── Services/           # Lógica de negócio
└── Providers/          # Service Providers
```

### Models e Tabelas
- **Categories** → `categorias` (nome, descricao)
- **Products** → `produtos` (nome, descricao, preco, categoria_id)  
- **Carts** → `carrinhos` (usuario_id, total, status)
- **Cart Products** → `carrinho_produtos` (carrinho_id, produto_id, quantidade, preco_unitario)

---

## Endpoints

### Anúncios

A API também inclui um sistema de anúncios legado que mantém compatibilidade.

#### Listar todos os anúncios
```http
GET /anuncios
```

#### Buscar anúncio específico
```http
GET /anuncios/{id}
```

#### Criar novo anúncio
```http
POST /anuncios
```

#### Atualizar anúncio
```http
PUT /anuncios/{id}
```

#### Excluir anúncio
```http
DELETE /anuncios/{id}
```

### Categorias

#### Listar todas as categorias
```http
GET /categorias
```

**Resposta de Sucesso (200):**
```json
[
    {
        "id": 1,
        "nome": "Eletrônicos",
        "descricao": "Produtos eletrônicos em geral",
        "created_at": "2025-08-13T20:00:00.000000Z",
        "updated_at": "2025-08-13T20:00:00.000000Z"
    }
]
```

#### Buscar categoria específica
```http
GET /categorias/{id}
```

**Resposta de Sucesso (200):**
```json
{
    "id": 1,
    "nome": "Eletrônicos",
    "descricao": "Produtos eletrônicos em geral",
    "created_at": "2025-08-13T20:00:00.000000Z",
    "updated_at": "2025-08-13T20:00:00.000000Z"
}
```

**Resposta de Erro (404):**
```json
{
    "error": "Categoria não encontrada"
}
```

#### Criar nova categoria
```http
POST /categorias
```

**Corpo da Requisição:**
```json
{
    "nome": "Nova Categoria",
    "descricao": "Descrição da categoria"
}
```

**Resposta de Sucesso (201):**
```json
{
    "id": 2,
    "nome": "Nova Categoria",
    "descricao": "Descrição da categoria",
    "created_at": "2025-08-13T20:00:00.000000Z",
    "updated_at": "2025-08-13T20:00:00.000000Z"
}
```

#### Atualizar categoria
```http
PUT /categorias/{id}
```

**Corpo da Requisição:**
```json
{
    "nome": "Categoria Atualizada",
    "descricao": "Nova descrição"
}
```

**Resposta de Sucesso (200):**
```json
{
    "message": "Categoria atualizada com sucesso"
}
```

#### Excluir categoria
```http
DELETE /categorias/{id}
```

**Resposta de Sucesso (204):** Sem conteúdo

**Resposta de Erro (400) - Categoria com produtos:**
```json
{
    "error": "Não é possível excluir categoria que possui produtos"
}
```

**Resposta de Erro (404):**
```json
{
    "error": "Categoria não encontrada"
}
```

---

### Produtos

#### Listar todos os produtos
```http
GET /produtos
```

**Resposta de Sucesso (200):**
```json
[
    {
        "id": 1,
        "nome": "Smartphone Samsung Galaxy S23",
        "descricao": "Smartphone com câmera de 50MP",
        "preco": 2599.99,
        "categoria_id": 1,
        "created_at": "2025-08-13T20:00:00.000000Z",
        "updated_at": "2025-08-13T20:00:00.000000Z",
        "category": {
            "id": 1,
            "nome": "Eletrônicos"
        }
    }
]
```

#### Buscar produto específico
```http
GET /produtos/{id}
```

**Resposta de Sucesso (200):**
```json
{
    "id": 1,
    "nome": "Smartphone Samsung Galaxy S23",
    "descricao": "Smartphone com câmera de 50MP",
    "preco": 2599.99,
    "categoria_id": 1,
    "created_at": "2025-08-13T20:00:00.000000Z",
    "updated_at": "2025-08-13T20:00:00.000000Z",
    "category": {
        "id": 1,
        "nome": "Eletrônicos",
        "descricao": "Produtos eletrônicos em geral"
    }
}
```

**Resposta de Erro (404):**
```json
{
    "error": "Produto não encontrado"
}
```

#### Criar novo produto
```http
POST /produtos
```

**Corpo da Requisição:**
```json
{
    "nome": "Novo Produto",
    "descricao": "Descrição do produto",
    "preco": 99.99,
    "categoria_id": 1
}
```

**Resposta de Sucesso (201):**
```json
{
    "id": 2,
    "nome": "Novo Produto",
    "descricao": "Descrição do produto",
    "preco": 99.99,
    "categoria_id": 1,
    "created_at": "2025-08-13T20:00:00.000000Z",
    "updated_at": "2025-08-13T20:00:00.000000Z",
    "category": {
        "id": 1,
        "nome": "Eletrônicos",
        "descricao": "Produtos eletrônicos em geral"
    }
}
```

**Resposta de Erro (400):**
```json
{
    "error": "Mensagem de erro de validação"
}
```

#### Atualizar produto
```http
PUT /produtos/{id}
```

**Corpo da Requisição:**
```json
{
    "nome": "Produto Atualizado",
    "descricao": "Nova descrição",
    "preco": 149.99,
    "categoria_id": 1
}
```

**Resposta de Sucesso (200):**
```json
{
    "message": "Produto atualizado com sucesso"
}
```

**Resposta de Erro (404):**
```json
{
    "error": "Produto não encontrado"
}
```

#### Excluir produto
```http
DELETE /produtos/{id}
```

**Resposta de Sucesso (204):** Sem conteúdo

**Resposta de Erro (404):**
```json
{
    "error": "Produto não encontrado"
}
```

---

### Carrinhos

#### Criar novo carrinho
```http
POST /carrinhos
```

**Corpo da Requisição:**
```json
{
    "usuario_id": 1
}
```

**Resposta de Sucesso (201):**
```json
{
    "id": 1,
    "usuario_id": 1,
    "total": 0,
    "status": "ativo",
    "created_at": "2025-08-13T20:00:00.000000Z",
    "updated_at": "2025-08-13T20:00:00.000000Z"
}
```

#### Buscar carrinho específico
```http
GET /carrinhos/{id}
```

**Resposta de Sucesso (200):**
```json
{
    "id": 1,
    "usuario_id": 1,
    "total": 299.99,
    "status": "ativo",
    "products": [
        {
            "id": 1,
            "nome": "Produto Teste",
            "preco": 99.99,
            "pivot": {
                "quantidade": 3,
                "preco_unitario": 99.99
            }
        }
    ]
}
```

#### Adicionar produto ao carrinho
```http
POST /carrinhos/{id}/produtos
```

**Corpo da Requisição:**
```json
{
    "produto_id": 1,
    "quantidade": 2
}
```

**Resposta de Sucesso (200):**
```json
{
    "message": "Produto adicionado ao carrinho com sucesso"
}
```

#### Remover produto do carrinho
```http
DELETE /carrinhos/{carrinho_id}/produtos/{produto_id}
```

**Resposta de Sucesso (200):**
```json
{
    "message": "Produto removido do carrinho com sucesso"
}
```

#### Atualizar quantidade do produto no carrinho
```http
PUT /carrinhos/{carrinho_id}/produtos/{produto_id}
```

**Corpo da Requisição:**
```json
{
    "quantidade": 5
}
```

**Resposta de Sucesso (200):**
```json
{
    "message": "Quantidade atualizada com sucesso"
}
```

#### Finalizar carrinho
```http
POST /carrinhos/{id}/finalizar
```

**Resposta de Sucesso (200):**
```json
{
    "message": "Carrinho finalizado com sucesso"
}
```

---

## Códigos de Status HTTP

| Código | Descrição |
|--------|-----------|
| 200 | Sucesso |
| 201 | Criado com sucesso |
| 204 | Sem conteúdo (usado em exclusões) |
| 400 | Erro na requisição |
| 404 | Recurso não encontrado |
| 500 | Erro interno do servidor |

## Tratamento de Erros

Todas as respostas de erro seguem o formato:
```json
{
    "error": "Mensagem de erro descritiva"
}
```

## Validações

### Categoria
- `nome`: obrigatório, string, máximo 100 caracteres
- `descricao`: opcional, string, máximo 1000 caracteres

### Produto
- `nome`: obrigatório, string
- `descricao`: opcional, string
- `preco`: obrigatório, decimal, deve ser maior que 0
- `categoria_id`: obrigatório, deve existir na tabela categorias

### Carrinho
- `usuario_id`: obrigatório, deve existir na tabela users
- `produto_id`: obrigatório para operações com produtos, deve existir na tabela produtos
- `quantidade`: obrigatório para adição/atualização, inteiro maior que 0

## Regras de Negócio

### Categorias
- Não é possível excluir uma categoria que possui produtos associados
- Soft delete é aplicado nas exclusões (dados não são removidos fisicamente)

### Produtos
- Deve estar associado a uma categoria válida
- Preço deve ser sempre maior que zero
- Soft delete é aplicado nas exclusões

### Carrinhos
- Apenas carrinhos com status "ativo" podem receber produtos
- Não é possível finalizar um carrinho vazio
- Ao finalizar, o status muda para "finalizado"
- O total é recalculado automaticamente ao adicionar/remover produtos

## Testando a API

### Ambiente Docker
Para executar a API em ambiente Docker:

```bash
# Subir containers
docker-compose up -d

# Executar migrations e seeders
docker exec setup-laravel_php php artisan migrate:fresh --seed

# Verificar se API está funcionando
curl http://localhost:8080/api/categorias
```

### Testando com Postman

#### Importar Collection Pronta
1. **Baixe o arquivo**: `postman_collection.json` (na raiz do projeto)
2. **No Postman**: File → Import → Selecione o arquivo
3. **Configure a variável**: `base_url` = `http://localhost:8080/api`
4. **Execute os requests** na ordem sugerida

#### Passo a Passo Manual

**Passo 1: Configuração Inicial**
1. Abra o Postman e crie uma nova Collection "Shopping Cart API"
2. Configure variável `base_url`: `http://localhost:8080/api`
3. Verifique containers: `docker-compose up -d`

**Passo 2: Fluxo de Testes Completo**

```
📋 SEQUÊNCIA RECOMENDADA:
1. GET /categorias              → Listar categorias (seeders)
2. POST /categorias             → Criar nova categoria
3. GET /produtos                → Listar produtos existentes  
4. POST /produtos               → Criar produto na nova categoria
5. POST /carrinhos              → Criar carrinho
6. POST /carrinhos/1/produtos   → Adicionar produto
7. GET /carrinhos/1             → Verificar carrinho
8. PUT /carrinhos/1/produtos/1  → Alterar quantidade
9. POST /carrinhos/1/finalizar  → Finalizar compra
```

**Exemplo de Request - Criar Categoria:**
- **Método**: `POST`
- **URL**: `{{base_url}}/categorias`  
- **Headers**: `Content-Type: application/json`
- **Body**:
```json
{
    "nome": "Games", 
    "descricao": "Jogos e consoles"
}
```

**Exemplo de Request - Adicionar ao Carrinho:**
- **Método**: `POST`
- **URL**: `{{base_url}}/carrinhos/1/produtos`
- **Body**:
```json
{
    "produto_id": 1,
    "quantidade": 2
}
```

### Testando com Insomnia

#### Configuração do Workspace
1. **Crie um novo Workspace** chamado "Shopping Cart API"
2. **Configure Environment**:
   - `base_url`: `http://localhost:8080/api`
   - `content_type`: `application/json`

#### Fluxo de Testes Sequencial

**Sequência Recomendada:**
1. ✅ `GET` `/categorias` → Verificar dados dos seeders
2. ✅ `POST` `/categorias` → Criar nova categoria
3. ✅ `GET` `/produtos` → Listar produtos existentes
4. ✅ `POST` `/produtos` → Criar produto na nova categoria
5. ✅ `POST` `/carrinhos` → Criar carrinho para usuário
6. ✅ `POST` `/carrinhos/1/produtos` → Adicionar produto
7. ✅ `GET` `/carrinhos/1` → Verificar carrinho atualizado
8. ✅ `PUT` `/carrinhos/1/produtos/1` → Alterar quantidade
9. ✅ `POST` `/carrinhos/1/finalizar` → Finalizar compra

#### Cenários de Erro para Testar

**Teste de Validações:**
- Criar categoria sem nome (erro 400)
- Criar produto com preço negativo (erro 400)
- Buscar categoria inexistente (erro 404)
- Adicionar produto inexistente ao carrinho (erro 400)
- Finalizar carrinho vazio (erro 400)

<!-- ### Testes Automatizados (Opcional) -->


<!-- --- -->

## 🚀 Guia Rápido de Uso

### 1. Preparar Ambiente
```bash
# Clonar repositório e subir containers
docker-compose up -d
docker exec setup-laravel_php php artisan migrate:fresh --seed
```

### 2. Importar no Postman
- Arquivo: `postman_collection.json`
- Variável: `base_url` = `http://localhost:8080/api`

### 3. Testar Fluxo Principal
```
GET /categorias             → Ver dados dos seeders
POST /carrinhos             → Criar carrinho (usuario_id: 1)  
POST /carrinhos/1/produtos  → Adicionar produto (produto_id: 1, quantidade: 2)
GET /carrinhos/1            → Ver carrinho atualizado
POST /carrinhos/1/finalizar → Finalizar compra
```

### 4. Arquivos Importantes
- **Postman**: `Shopping_Cart_API.postman_collection.json`
- **Testes**: `./test-specific.sh all`
- **Logs**: `laravel/storage/logs/laravel.log`

---

**Documentação gerada em:** 14/08/2025 10:30  
**Versão da API:** 1.0  
**Laravel:** 12.x  
**PHP:** 8.4+
