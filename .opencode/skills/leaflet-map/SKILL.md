---
name: leaflet-map
description: "Use ao trabalhar com mapas Leaflet — opções do mapa, marcadores, polígonos, polilinhas, retângulos, círculos, controle de camadas (OSM/Google), geocoding (Nominatim), e eventos de clique/arrasto. Acionar por 'leaflet', 'mapa', 'L.map', 'L.marker', 'L.polygon', 'L.polyline', 'L.rectangle', 'L.circle', 'tileLayer', 'geocoder', 'Nominatim'."
---

# Leaflet Map

## Dependências (CDN)

Carregadas nas views via CDN — não passam pelo Laravel Mix:

```html
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
```

## Opções do Mapa (`$options`)

Array associativo PHP passado para a view. Valores padrão usados quando a chave não é definida:

| Chave | Tipo | Padrão | Descrição |
|-------|------|--------|-----------|
| `center` | `['lat' => float, 'lng' => float]` | `-23.3475, -47.8475` | Centro inicial do mapa |
| `zoom` | `int` | `18` | Nível de zoom inicial |
| `zoomControl` | `bool` | `true` | Exibir controle de zoom |
| `minZoom` | `int` | `13` | Zoom mínimo permitido |
| `maxZoom` | `int` | `18` | Zoom máximo permitido |
| `googleview` | `bool` | `true` | Habilitar alternância OSM/Google Maps |
| `width` | `string` | `'100%'` | Largura CSS do `#map` |
| `height` | `string` | `'600px'` | Altura CSS do `#map` |

### Uso no Controller

```php
$options = [
    'center' => ['lat' => -23.3475, 'lng' => -47.8475],
    'zoom' => 18,
    'googleview' => true,
    'minZoom' => 13,
    'maxZoom' => 18,
    'width' => '100%',
    'height' => '600px',
];
```

## Shapes

### Marcadores (`$initialMarkers`)

Array de objetos. Cada objeto:

```php
[
    'position' => ['lat' => -23.3475, 'lng' => -47.8475],
    'draggable' => true,
    'title' => 'Tatuí - SP',  // usado no bindPopup
]
```

No JS: `L.marker(data.position, { draggable: data.draggable })` com eventos `click` e `dragend`.

### Polígonos (`$initialPolygons`)

Array de arrays de coordenadas:

```php
[
    [
        [-23.3460, -47.8481],
        [-23.3457, -47.8475],
        [-23.3461, -47.8472],
        [-23.3465, -47.8479],
    ],
]
```

No JS: `L.polygon(data).addTo(map)`.

### Polilinhas (`$initialPolylines`)

Array de arrays de coordenadas (mesmo formato do polígono):

```php
[
    [
        [-23.3489, -47.8501],
        [-23.3478, -47.8481],
        [-23.3492, -47.8472],
        [-23.3478, -47.8446],
    ],
]
```

No JS: `L.polyline(data).addTo(map)`.

### Retângulos (`$initialRectangles`)

Array de bounds (dois pontos: NE e SW):

```php
[
    [
        [-23.3476, -47.8506],  // ponto 1
        [-23.3467, -47.8487],  // ponto 2
    ],
]
```

No JS: `L.rectangle(data).addTo(map)`.

### Círculos (`$initialCircles`)

Array de objetos com `position` e `radius`:

```php
[
    [
        'position' => ['lat' => -23.3465, 'lng' => -47.8437],
        'radius' => 80.68,  // metros
    ],
]
```

No JS: `L.circle(data.position, {radius: data.radius}).addTo(map)`.

## Controle de Camadas

Quando `googleview` é `true`, o mapa exibe um controle de camadas que alterna entre:

- **Google Maps** (satélite): `http://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}`
- **OpenStreetMap**: `https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`

A camada Google é adicionada primeiro (ativa por padrão). OSM é adicionada em seguida como fallback.

## Geocoding (Nominatim)

Usado no `initMarkers()` para fazer reverse geocoding do centro do mapa:

```js
const geocoder = L.Control.Geocoder.nominatim();
geocoder.reverse({ lat, lng }, zoom, (results) => {
    if (results.length) {
        console.log("formatted_address", results[0].name);
    }
});
```

## Eventos

| Evento | Função | Disparado por |
|--------|--------|---------------|
| `click` | `mapClicked($event)` | Clique no mapa |
| `click` | `markerClicked($event, index)` | Clique no marcador |
| `dragend` | `markerDragEnd($event, index)` | Arrasto do marcador |

Os eventos atuais apenas logam no console. Para adicionar comportamento real, edite as funções nos templates Blade.

## Onde Editar

- Componente reutilizável: `packages/laravel-leaflet/src/views/components/laravel-map.blade.php`
- Full-page: `packages/laravel-leaflet/src/views/map.blade.php`
- Controller de exemplo do pacote: `packages/laravel-leaflet/src/Http/Controllers/MapController.php`
- Controller do app: `app/Http/Controllers/WelcomeController.php`
