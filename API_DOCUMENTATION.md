# API Documentation - Gestão de Notas

## Base URL
```
http://127.0.0.1:8000/api
```

---

## Endpoints - Notes

### 1. Listar todas as notas
**GET** `/api/notes`

**Query Parameters:**
- `per_page` (opcional): Número de itens por página (padrão: 15)

**Exemplo de requisição:**
```
GET http://127.0.0.1:8000/api/notes?per_page=10
```

**Resposta (200 OK):**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "title": "Minha primeira nota",
      "content": "Conteúdo da nota aqui",
      "category": "Work",
      "is_favorite": false,
      "user_id": 1,
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/api/notes?page=1",
  "last_page": 1,
  "per_page": 15,
  "total": 12
}
```

---

### 2. Criar uma nova nota
**POST** `/api/notes`

**Headers:**
```
Content-Type: application/json
```

**Body (JSON):**
```json
{
  "title": "Título da nota",
  "content": "Conteúdo da minha nota",
  "category": "Personal",
  "is_favorite": false,
  "user_id": 1
}
```

**Resposta (201 Created):**
```json
{
  "id": 13,
  "title": "Título da nota",
  "content": "Conteúdo da minha nota",
  "category": "Personal",
  "is_favorite": false,
  "user_id": 1,
}
```

---

### 3. Ver uma nota específica
**GET** `/api/notes/{id}`

**Exemplo de requisição:**
```
GET http://127.0.0.1:8000/api/notes/1
```

**Resposta (200 OK):**
```json
{
  "id": 1,
  "title": "Minha primeira nota",
  "content": "Conteúdo da nota aqui",
  "category": "Work",
  "is_favorite": false,
  "user_id": 1,
}
```

**Resposta (404 Not Found):**
```json
{
  "message": "Nota não encontrada"
}
```

---

### 4. Atualizar uma nota
**PUT** `/api/notes/{id}` ou **PATCH** `/api/notes/{id}`

**Headers:**
```
Content-Type: application/json
```

**Body (JSON):**
```json
{
  "title": "Título atualizado",
  "content": "Conteúdo atualizado",
  "category": "Work",
  "is_favorite": true
}
```

**Resposta (200 OK):**
```json
{
  "id": 1,
  "title": "Título atualizado",
  "content": "Conteúdo atualizado",
  "category": "Work",
  "is_favorite": true,
  "user_id": 1,
}
```

---

### 5. Deletar uma nota
**DELETE** `/api/notes/{id}`

**Exemplo de requisição:**
```
DELETE http://127.0.0.1:8000/api/notes/1
```

**Resposta (204 No Content)**
```
(sem conteúdo no body)
```

---



##  Campos das Notas

| Campo | Tipo | Obrigatório | Descrição |
|-------|------|-------------|-----------|
| `title` | string | Sim | Título da nota |
| `content` | text | Sim | Conteúdo da nota |
| `category` | string | Não | Categoria (Personal, Work, Ideas, etc) |
| `is_favorite` | boolean | Não | Marcar como favorita (padrão: false) |
| `user_id` | integer | Sim | ID do usuário dono da nota |

---

## Testando no Postman

### Importar Collection
1. Abra o Postman
2. Clique em **Import**
3. Cole as requisições abaixo ou crie manualmente

### Teste Rápido

**1. Listar todas as notas:**
- Método: `GET`
- URL: `http://127.0.0.1:8000/api/notes`

**2. Criar uma nota:**
- Método: `POST`
- URL: `http://127.0.0.1:8000/api/notes`
- Body > raw > JSON:
```json
{
  "title": "Minha nota de teste",
  "content": "Este é um teste do Postman",
  "category": "Personal",
  "is_favorite": false,
  "user_id": 1
}
```

**3. Ver a nota criada:**
- Método: `GET`
- URL: `http://127.0.0.1:8000/api/notes/13` (use o ID retornado)

**4. Atualizar a nota:**
- Método: `PUT`
- URL: `http://127.0.0.1:8000/api/notes/13`
- Body > raw > JSON:
```json
{
  "title": "Título atualizado",
  "content": "Conteúdo atualizado",
  "category": "Work",
  "is_favorite": true
}
```

**5. Deletar a nota:**
- Método: `DELETE`
- URL: `http://127.0.0.1:8000/api/notes/13`

---

## Notas Importantes

- O servidor deve estar rodando: `php artisan serve`
- Todas as respostas são em formato JSON
- A paginação padrão é de 15 itens por página

---

## Status Codes

| Código | Significado |
|--------|-------------|
| 200 | OK - Requisição bem-sucedida |
| 201 | Created - Recurso criado com sucesso |
| 204 | No Content - Recurso deletado com sucesso |
| 400 | Bad Request - Erro na validação dos dados |
| 404 | Not Found - Recurso não encontrado |
| 500 | Internal Server Error - Erro no servidor |
