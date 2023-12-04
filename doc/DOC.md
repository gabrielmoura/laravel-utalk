# Documentation

## Activity Log

### Activity Log - List

```php
$organizationId = 123AAA;
app('Utalk')->activityLog()->get($organizationId);
```

## Communication Channels

### List of Communication Channels

```php
$organizationId = 123AAA;
app('Utalk')->channel()->channels($organizationId);
```

## Chat

### Chat - Get a Chat

```php
$organizationId = 123AAA;
$idChat = 123BBB;
app('Utalk')->chat()->get($idChat, $organizationId);
```

### Chat - Search Chat

```php
$organizationId = 123AAA;
$idChat = 123BBB;
$searchText = 'search text';
$stateOpen = true;
app('Utalk')->chat()->search($organizationId, $searchText, $stateOpen);
```

### Chat - List All Chats

```php
$organizationId = 123AAA;
app('Utalk')->chat()->getAll($organizationId);
```

### Chat - Put in Waiting Queue

```php
$organizationId = 123AAA;
$idChat = 123BBB;
app('Utalk')->chat()->setWaiting($idChat, $organizationId);
```

### Chat - Mark Chat as Unread

```php
$organizationId = 123AAA;
$idChat = 123BBB;
app('Utalk')->chat()->setUnread($idChat, $organizationId);
```

## Contact

### Contact - Get a Contact

```php
$organizationId = 123AAA;
$contactId = 123BBB;
app('Utalk')->contact()->get($organizationId, $contactId);
```

### Contact - List All Contacts

```php
$organizationId = 123AAA;
app('Utalk')->contact()->getAll($organizationId);
```

### Contact - Get Chats of a Contact

```php
$take = 25;
$skip = 0;
$organizationId = 123AAA;
$contactId = 123BBB;
app('Utalk')->contact()->getChats($organizationId, $contactId, $skip, $take);
```

## Member

### Member - Get Logged-in User Data

```php
app('Utalk')->member()->getMe();
```

### Member - Get Online Users

```php
$organizationId = 123AAA;
app('Utalk')->member()->getOnline($organizationId);
```

## Message

### Message - Send a Message to a Phone Number

```php
$organizationId = 123AAA;
$toPhone = "5511999999999";
$fromPhone = "5511999999999";
$message = 'Test message';
app('Utalk')->message()->set($toPhone, $fromPhone, $organizationId, $message);
```

### Message - Get a Message

```php
$organizationId = 123AAA;
$messageId = 123BBB;
app('Utalk')->message()->get($messageId, $organizationId);
```

### Message - Delete a Message

```php
$organizationId = 123AAA;
$messageId = 123BBB;
$deleteForEveryone = true;
app('Utalk')->message()->delete($organizationId, $messageId, $deleteForEveryone);
```
