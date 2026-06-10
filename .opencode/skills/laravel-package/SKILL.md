---
name: laravel-package
description: "Use ao desenvolver ou publicar este pacote Laravel reutilizável — service provider, auto-discovery, PSR-4, Blade components, namespace de views, e registro de rotas. Acionar por 'composer.json', 'ServiceProvider', 'auto-discovery', 'PSR-4', 'Blade::component', 'loadViewsFrom', 'loadRoutesFrom', 'pacote', 'package'."
---

# Laravel Package Development

Este pacote (`ginocampra/laravel-leaflet`) segue as convenções oficiais de desenvolvimento de pacotes Laravel.

## Estrutura

```
packages/laravel-leaflet/
├── composer.json
├── src/
│   ├── LaravelLeafletServiceProvider.php
│   ├── Http/Controllers/MapController.php
│   ├── View/Components/LaravelMap.php
│   ├── views/
│   │   ├── map.blade.php
│   │   └── components/laravel-map.blade.php
│   └── routes/web.php
└── images/
```

## composer.json

```json
{
    "name": "ginocampra/laravel-leaflet",
    "type": "library",
    "autoload": {
        "psr-4": {
            "Ginocampra\\LaravelLeaflet\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "Ginocampra\\LaravelLeaflet\\LaravelLeafletServiceProvider"
            ]
        }
    }
}
```

### Pontos importantes

- **`type`**: `"library"` — pacote Composer comum.
- **`autoload.psr-4`**: Namespace `Ginocampra\LaravelLeaflet\` mapeia para `src/`.
- **`extra.laravel.providers`**: Registra o Service Provider para **auto-discovery** — o usuário não precisa adicionar manualmente em `config/app.php`.

## Service Provider

`src/LaravelLeafletServiceProvider.php` estende `Illuminate\Support\ServiceProvider`:

```php
public function boot()
{
    $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    $this->loadViewsFrom(__DIR__ . '/views', 'LaravelLeaflet');

    Blade::component('laravel-map', LaravelMap::class);
    Blade::componentNamespace('LaravelLeaflet\\Views\\Components', 'laravel-map');
}
```

### Métodos disponíveis no `boot()`:

| Método | Uso |
|--------|-----|
| `$this->loadRoutesFrom(__DIR__.'/routes/web.php')` | Registrar rotas do pacote |
| `$this->loadViewsFrom(__DIR__.'/views', 'Namespace')` | Registrar views com namespace |
| `$this->loadMigrationsFrom(__DIR__.'/database/migrations')` | Registrar migrations (se houver) |
| `$this->loadTranslationsFrom(__DIR__.'/lang', 'Namespace')` | Registrar traduções (se houver) |
| `$this->publishes([...], 'laravel-leaflet-config')` | Publicar config/views/assets |
| `Blade::component('nome', Classe::class)` | Registrar Blade component |
| `Blade::componentNamespace('Namespace', 'prefix')` | Registrar namespace de componentes |

## Blade Components

### Classe do Componente

`src/View/Components/LaravelMap.php`:

- Estende `Illuminate\View\Component`
- Construtor recebe `$options`, `$title`, `$initialMarkers`, `$initialPolygons`, `$initialPolylines`, `$initialRectangles`, `$initialCircles` (todos opcionais, padrão `null`)
- `render()` retorna `view('LaravelLeaflet::components.laravel-map', [...])`
- Propriedades públicas são automaticamente passadas para a view (mas o `render()` também as passa explicitamente)

### Uso no Blade

```blade
<x-laravel-map
    :title="$title"
    :options="$options"
    :initialMarkers="$initialMarkers"
    :initialPolygons="$initialPolygons"
    :initialPolylines="$initialPolylines"
    :initialRectangles="$initialRectangles"
    :initialCircles="$initialCircles"
/>
```

### Namespace de Views

- **Chave**: `LaravelLeaflet` (definida em `loadViewsFrom`)
- **Localização**: `packages/laravel-leaflet/src/views/`
- **Uso**: `view('LaravelLeaflet::map')`, `view('LaravelLeaflet::components.laravel-map')`

## Rotas do Pacote

`src/routes/web.php`:

```php
Route::get('/map', [MapController::class, 'index']);
```

A rota é registrada automaticamente no grupo `web` quando o Service Provider é carregado.

## Desenvolvimento Local

O pacote é carregado via `composer.json` do app principal. Edite os arquivos em `packages/laravel-leaflet/` e teste via `php artisan serve` — não é necessário rodar `composer update` a cada alteração (por ser path repository ou estar no monorepo).

## Publicação (para nova versão no Packagist)

1. Atualize o código em `packages/laravel-leaflet/`
2. Atualize `composer.json` (versão, se aplicável)
3. Commit e tag: `git tag v1.0.1 && git push --tags`
4. O Packagist atualiza automaticamente (webhook configurado)
