# Documentação em português do Brasil

## Log de Atividades

### Log de Atividades - Listar

```php
$organizationId = 123AAA;
app('Utalk')->activityLog()->get($organizationId);
```

## Canais de Comunicação

### Lista de Canais de Comunicação

```php
$organizationId = 123AAA;
app('Utalk')->channel()->channels($organizationId);
```

## Chat

### Chat - Pegar um Chat

```php
$organizationId = 123AAA;
$idChat = 123BBB;
app('Utalk')->chat()->get($idChat,$organizationId);
```

### Chat - Buscar Chat

```php
$organizationId = 123AAA;
$idChat = 123BBB;
$searchText = 'texto de busca';
$stateOpen = true;
app('Utalk')->chat()->search( $organizationId,  $searchText,$stateOpen);
```

### Chat - Listar todos os Chats

```php
$organizationId = 123AAA;
app('Utalk')->chat()->getAll( $organizationId);
```

### Chat - Põe na fila de espera

```php
$organizationId = 123AAA;
$idChat = 123BBB;
app('Utalk')->chat()->setWaiting($idChat,$organizationId);
```

### Chat - Marca Chat como não lido

```php
$organizationId = 123AAA;
$idChat = 123BBB;
app('Utalk')->chat()->setUnread($idChat,$organizationId);
```

## Contato

### Contato - Pegar um Contato

```php
$organizationId = 123AAA;
$contactId = 123BBB;
app('Utalk')->contact()->get( $organizationId,  $contactId);
```

### Contato - Listar todos os Contatos

```php
$organizationId = 123AAA;
app('Utalk')->contact()->getAll($organizationId);
```

### Contato - Retorna os chats de um contato

```php
$take = 25;
$skip = 0;
$organizationId = 123AAA;
$contactId = 123BBB;
app('Utalk')->contact()->getChats( $organizationId,  $contactId,  $skip, $take);
```

## Membro

### Membro - Retorna os dados do usuário logado

```php
app('Utalk')->member()->getMe();
```

### Membro - Retorna os usuários online

```php
$organizationId = 123AAA;
app('Utalk')->member()->getOnline($organizationId);
```

## Mensagem

### Mensagem - Envia uma mensagem para um número de telefone

```php
$organizationId = 123AAA;
$toPhone "5511999999999";
$fromPhone "5511999999999"
$message = 'Mensagem de teste';
app('Utalk')->message()->set($toPhone,$fromPhone,$organizationId, $message);
```

### Mensagem - Retorna uma mensagem

```php
$organizationId = 123AAA;
$messageId = 123BBB;
app('Utalk')->message()->get($messageId,$organizationId);
```

### Mensagem - Deleta uma mensagem

```php
$organizationId = 123AAA;
$messageId = 123BBB;
$deleteForEveryone = true;
app('Utalk')->message()->delete($organizationId,$messageId,$deleteForEveryone);
```
