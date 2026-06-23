---
name: laravel-testing
description: "Use ao rodar ou escrever testes — PHPUnit, testes Unit/Feature, testes de rota, testes de componente Blade. Acionar por 'test', 'teste', 'phpunit', 'PHPUnit', 'Unit', 'Feature', 'assertStatus', 'assertSee', 'RefreshDatabase'."
---

# PHPUnit Testing

## Comando para Rodar Testes

```bash
vendor/bin/phpunit                         # Rodar todos os testes
vendor/bin/phpunit --testsuite=Unit        # Apenas testes unitários
vendor/bin/phpunit --testsuite=Feature     # Apenas testes de funcionalidade
vendor/bin/phpunit --filter=nome_do_teste  # Filtrar por nome
vendor/bin/phpunit --colors=always         # Com cores
```

## Configuração (`phpunit.xml`)

- **Bootstrap**: `vendor/autoload.php`
- **Testsuites**: `Unit` (`tests/Unit/`) e `Feature` (`tests/Feature/`)
- **APP_ENV**: `testing`
- **CACHE_DRIVER**: `array` (cache em memória, não persiste)
- **SESSION_DRIVER**: `array` (sem sessão real)

## Estrutura

```
tests/
├── Unit/
│   └── ExampleTest.php      # Teste unitário básico (assertTrue)
├── Feature/
│   └── ExampleTest.php      # Teste de funcionalidade (GET /)
├── TestCase.php             # Classe base para testes Feature
└── CreatesApplication.php   # Bootstrap do app Laravel
```

### Teste Unitário

Estende `PHPUnit\Framework\TestCase` — sem Laravel, sem banco:

```php
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_example()
    {
        $this->assertTrue(true);
    }
}
```

### Teste de Funcionalidade

Estende `Tests\TestCase` (que estende `Illuminate\Foundation\Testing\TestCase`) — com Laravel, roteamento, banco:

```php
namespace Tests\Feature;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
```

## Testando este Projeto

### Rotas a testar

| Rota | Controller | View |
|------|-----------|------|
| `GET /` | `App\Http\Controllers\WelcomeController@index` | `welcome` |
| `GET /map` | `Ginocampra\LaravelLeaflet\Http\Controllers\MapController@index` | `LaravelLeaflet::map` |

### Exemplo: testar se a rota `/` carrega o componente Leaflet

```php
public function test_welcome_page_contains_map()
{
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('laravel-map');
}
```

### Exemplo: testar se a rota `/map` retorna JSON de marcadores no HTML

```php
public function test_map_page_has_markers()
{
    $response = $this->get('/map');
    $response->assertStatus(200);
    $response->assertSee('initialMarkers');
}
```

### Exemplo: testar o componente Blade isoladamente

Componentes Blade podem ser testados via `$this->blade()` ou `$this->component()` (Laravel 8+):

```php
public function test_laravel_map_component_renders()
{
    $view = $this->component(LaravelMap::class, [
        'title' => 'Test Map',
        'options' => ['center' => ['lat' => 0, 'lng' => 0]],
    ]);
    $view->assertSee('Test Map');
}
```

Assertions comuns do Laravel TestResponse:

| Método | Descrição |
|--------|-----------|
| `assertStatus(200)` | Status HTTP |
| `assertSee('texto')` | Contém texto no HTML |
| `assertSeeInOrder([...])` | Texto em ordem |
| `assertDontSee('texto')` | Não contém texto |
| `assertViewHas('key')` | View recebeu variável |
| `assertViewHas('key', $value)` | View recebeu variável com valor específico |
